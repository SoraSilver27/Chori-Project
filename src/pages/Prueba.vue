<template>
  <v-container>
    <v-form>
      <!-- Primer botón y diálogo (Buscar) -->
      <v-dialog v-model="dialog" max-width="1000">
        <template v-slot:activator="{ props: activatorProps }">
          <v-btn v-bind="activatorProps"
            text="Buscar"
            prepend-icon="mdi-plus"
            color="primary">
          </v-btn>
        </template>
        <template v-slot:default> 
          <v-card class="pa-4">
            <v-card-title>Control de componentes</v-card-title>
            <v-card-text>
              <v-row>
                <v-col v-for="(fila, n) in filasDos" :key="n" :cols="fila.size">
                  <component
                    v-if="fila.tipo === 'dato' && fila.component.name !== 'VCheckbox'"
                    :is="fila.component"
                    v-model="deEjemplo[currentIndex][fila.model]"
                    v-bind="fila.props"
                    hide-details
                    density="compact"
                  />
                  <component
                    v-if="fila.tipo === 'nuevo' && fila.component.name !== 'VCheckbox'"
                    :is="fila.component"
                    v-model="form[fila.model]"
                    v-bind="fila.props"
                    hide-details
                    density="compact"
                  />
                  <component
                    v-else-if="fila.component.name === 'VCheckbox'"
                    :is="fila.component"
                    v-model="form[fila.model]"
                    v-bind="fila.props"
                    hide-details
                    :model-value="form[fila.model] === 1"
                    @update:modelValue="(val) => form[fila.model] = val ? 1 : 0"
                    density="compact"
                  >
                    <!-- Mostrar el slot de label solo si el componente es VCheckbox -->
                    <template v-if="fila.component.name === 'VCheckbox'" v-slot:label>
                      {{ fila.text }}
                    </template>
                  </component>
                </v-col>
              </v-row>
            </v-card-text>
            <v-card-actions>
              <v-btn @click="closeDialog" color="blue">Cancelar</v-btn>
              <v-btn v-if="!isLastItem" @click="handleSiguiente" color="blue">Siguiente</v-btn>
              <v-btn v-else @click="handleGuardar" color="green">Guardar</v-btn>
            </v-card-actions>
          </v-card>
        </template>
      </v-dialog>

      <!-- Segundo botón y diálogo (Revisar) -->
      <v-dialog v-model="dialogRevisar" max-width="1000">
        <template v-slot:activator="{ props: activatorProps }">
          <v-btn v-if="formularios.length > 0" v-bind="activatorProps"
            text="Revisar"
            prepend-icon="mdi-eye"
            color="secondary">
          </v-btn>
        </template>
        <template v-slot:default>
          <v-card class="pa-4">
            <v-card-title>Control de componentes</v-card-title>
            <v-card-text>
              <v-row>
                <v-col v-for="(fila, n) in filasDos" :key="n" :cols="fila.size">
                  <component
                    v-if="fila.component.name !== 'VCheckbox'"
                    :is="fila.component"
                    v-model="formularios[currentIndexRevisar][fila.model]"
                    v-bind="fila.props"
                    hide-details
                    density="compact"
                  />
                  <component
                    v-else-if="fila.component.name === 'VCheckbox'"
                    :is="fila.component"
                    v-model="formularios[currentIndexRevisar][fila.model]"
                    v-bind="fila.props"
                    hide-details
                    :model-value="formularios[currentIndexRevisar][fila.model] === 1"
                    @update:modelValue="(val) => formularios[currentIndexRevisar][fila.model] = val ? 1 : 0"
                    density="compact"
                  >
                    <!-- Mostrar el slot de label solo si el componente es VCheckbox -->
                    <template v-if="fila.component.name === 'VCheckbox'" v-slot:label>
                      {{ fila.text }}
                    </template>
                  </component>
                </v-col>
              </v-row>
            </v-card-text>
            <v-card-actions>
              <v-btn @click="closeDialog" color="blue">Cancelar</v-btn>
              <v-btn v-if="currentIndexRevisar > 0" @click="handleAnteriorRevisar" color="green">Anterior</v-btn>
              <v-btn v-if="currentIndexRevisar < formularios.length - 1" @click="handleSiguienteRevisar" color="blue">Siguiente</v-btn>
            </v-card-actions>
          </v-card>
        </template>
      </v-dialog>
    </v-form>
    {{ formularios }}
  </v-container>
</template>

<script setup>
import { ref, computed } from 'vue';
import { VCheckbox, VSelect, VTextarea, VTextField, VRadio } from 'vuetify/components';
import { deEjemplo } from '@/components/vListasDeRepuestosEjemplo';

const dialog = ref(false);
const dialogRevisar = ref(false);
const formularios = ref([]);
const form = ref({
  id: null,
  nombre: '',
  numero_serie: '',
  modelo: '',
  problema_detectado: '',
  solucion_encontrada: '',
  actividad_realizada: '',
  reemplazado: false,
  re_nombre: '',
  re_modelo: '',
  re_numero_serie: '',
});

const filasDos = [
  {tipo: 'dato', model: 'nombre', component: VTextField, size: 4, props: { label: 'Nombre' } },
  {tipo: 'dato', model: 'numero_serie', component: VTextField, size: 4, props: { label: 'Identificador' } },
  {tipo: 'dato', model: 'modelo', component: VTextField, size: 4, props: { label: 'Modelo' } },
  {tipo: 'nuevo', model: 'problema_detectado', component: VTextarea, size: 12, props: { label: 'Problema detectado', rows: 1 } },
  {tipo: 'nuevo', model: 'solucion_encontrada', component: VTextarea, size: 12, props: { label: 'Solucion encontrada', rows: 1 } },
  {tipo: 'nuevo', model: 'actividad_realizada', component: VTextarea, size: 12, props: { label: 'Actividad realizada', rows: 1 } },
  {tipo: 'check', model: 'reemplazo', component: VCheckbox, size: 12, text: 'Reemplazado por:' },
  {tipo: 'nuevo', model: 're_nombre', component: VTextField, size: 4, props: { label: 'Nombre' } },
  {tipo: 'nuevo', model: 're_modelo', component: VTextField, size: 4, props: { label: 'Modelo' } },
  {tipo: 'nuevo', model: 're_numero_serie', component: VTextField, size: 4, props: { label: 'Identificador' } },
];

// Index para rastrear en cuál estamos
const currentIndex = ref(0);
const currentIndexRevisar = ref(0);
// Computed para saber si estamos en el último elemento
const isLastItem = computed(() => currentIndex.value === deEjemplo.length - 1);

// Función que maneja el botón "Siguiente"
const handleSiguiente = () => {
  // Asignar valores de deEjemplo al form
  filasDos.forEach((fila) => {
    if (fila.tipo === 'dato') {
      form.value[fila.model] = deEjemplo[currentIndex.value][fila.model];
      form.value.id = deEjemplo[currentIndex.value].id;
    }
  });

  // Agregar el formulario al array de formularios
  formularios.value.push({ ...form.value });

  // Limpiar el formulario
  for (let key in form.value) {
    form.value[key] = ''; // resetear datos o dejar vacío
  }

  // Avanzar al siguiente índice si existe
  if (deEjemplo[currentIndex.value + 1]) {
    currentIndex.value++;
  } else {
    console.log('No hay más elementos en deEjemplo');
  }
};
const handleSiguienteRevisar = () => {
  if (formularios.value[currentIndexRevisar.value + 1]) {
    currentIndexRevisar.value++;
  } else {
    console.log('No hay mas elementos en formularios');
    console.log('Revisar', currentIndexRevisar.value);
  }
}
const handleAnteriorRevisar = () => {
  if (formularios.value[currentIndexRevisar.value - 1]) {
    currentIndexRevisar.value--;
  } else {
    console.log('No hay mas elementos en formularios');
    console.log('Revisar', currentIndexRevisar.value);
  }
}

const handleGuardar = () => {
  // Guardar el último formulario
  filasDos.forEach((fila) => {
    if (fila.tipo === 'dato') {
      form.value[fila.model] = deEjemplo[currentIndex.value][fila.model];
      form.value.id = deEjemplo[currentIndex.value].id;
    }
  });
  formularios.value.push({ ...form.value });
  console.log('Datos guardados:', formularios.value);
  
  dialog.value = false;

  // Resetear el formulario y el índice si se desea comenzar de nuevo
  currentIndex.value = 0;
  for (let key in form.value) {
    form.value[key] = '';
  }
};

// Función para cerrar el diálogo manualmente
const closeDialog = () => {
  dialog.value = false;
  dialogRevisar.value = false;
};

</script>