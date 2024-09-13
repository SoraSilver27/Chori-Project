<template>
  <v-container class="ma-0 py-0 px-1">
    <v-card class="bg-surface-light">
      <v-card-title style="display: flex; align-items: center;" class="px-3 py-0">
        Perfil de la maquina
        <v-col class="text-end">
          <v-btn v-if="isEditing" color="primary" @click="cancel" class="mr-3" text="Cancelar"></v-btn>
          <v-btn color="primary" @click="toggleEditMode" class="ma-0" prepend-icon="mdi-pencil">
            {{ isEditing ? 'Guardar' : 'Editar' }}
          </v-btn>
        </v-col>
      </v-card-title>
      <v-card-text class="pt-3">
        <v-form style="width: 100%; height: 100%;">
          <v-row>
            <v-col cols="8" class="pa-0">
              <v-card v-for="(carta, i) in cartas" :key="i" class="pa-4 mx-2 mb-2">
                <v-row>
                  <v-col v-for="(fila, n) in carta.filas" :key="n" :cols="fila.size">
                    <component
                      :is="fila.component"
                      v-model="localMaquina[fila.model]"
                      v-bind="fila.props"
                      density="compact"
                    >
                    <template v-slot:label>
                      {{ fila.text }}
                    </template>
                    </component>
                  </v-col>
                </v-row>
              </v-card>
            </v-col>
            <v-col cols="4">
              <p>Aqui van cosas</p>
              <p>{{ localMaquina }}</p>
            </v-col>
          </v-row>
        </v-form>
      </v-card-text>
    </v-card>
  </v-container>
</template>

<script setup>
import { ref, computed, watch } from 'vue';
import { defineProps, defineEmits } from 'vue';
import { VCheckbox, VSelect, VTextarea, VTextField } from 'vuetify/components';

const props = defineProps({
  maquina: {
    type: Object, // Cambié de Array a Object según la estructura que describes
    required: true,
  },
});

const emit = defineEmits(['update']);

// Crear una copia local de 'maquina' que puedas modificar
const localMaquina = ref({ ...props.maquina.data });

// Estado de edición
const isEditing = ref(false);

// Alternar modo de edición
const toggleEditMode = () => {
  isEditing.value = !isEditing.value;

  if (!isEditing.value) {
    // Emitir el evento para notificar que el objeto ha sido actualizado
    emit('update', localMaquina.value);
  }
};

// Cancelar edición
const cancel = () => {
  localMaquina.value = { ...props.maquina.data };
  isEditing.value = false;
};

// Sincronizar cambios si 'maquina' cambia desde el padre
watch(() => props.maquina, (newVal) => {
  localMaquina.value = { ...newVal.data };
});


const cartas = ref([
  {
    filas: [
      { model: 'nombre', component: VTextField, size: 9, class: 'pb-0', props: { label: 'Nombre' } },
      { model: 'estado', component: VSelect, size: 3, class: 'pb-0 pl-0', props: { label: 'Estado', items: ['En uso', 'Mantenimiento', 'Disponible'] } },
      { model: 'numero_de_serie', component: VTextField, size: 5, class: 'py-0', props: { label: 'Identificador' } },
      { model: 'modelo', component: VTextField, size: 4, class: 'pa-0', props: { label: 'Modelo' } },
      { model: 'detalles.tipo', component: VTextField, size: 4, class: 'py-0', props: { label: 'Tipo' } },
      { model: 'detalles.voltaje', component: VTextField, size: 4, class: 'pa-0', props: { label: 'Voltaje' } },
      { model: 'detalles.peso', component: VTextField, size: 4, class: 'py-0', props: { label: 'Peso' } },
      { model: 'fecha_adquisicion', component: VTextField, size: 4, class: 'pa-0', props: { label: 'Fecha de Adquisición', type: 'date' } },
      { model: 'detalles.velocidad_ajustable', component: VCheckbox, size: 4, text: 'Velocidad ajustable', class: 'py-0', props: {} },
      { model: 'detalles.pantalla_digital', component: VCheckbox, size: 4, text: 'Pantalla digital', class: 'py-0' },
      { model: 'detalles.facil_desmontaje', component: VCheckbox, size: 4, text: 'Facilidad de desmontaje', class: 'py-0' },
      { model: 'detalles.garantia', component: VCheckbox, size: 4, text: 'Garantía', class: 'py-0' },
      { model: 'observaciones_generales', component: VTextarea, size: 12, class: 'py-0', props: { label: 'Observaciones Generales', rows: 1 } },
    ],
  },
]);



</script>
