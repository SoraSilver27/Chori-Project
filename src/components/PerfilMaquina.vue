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
                  <v-col v-for="(fila, n) in carta.filas" :key="n" :cols="fila.size" :class="fila.class">
                    <v-text-field v-if="fila.component === 'textField'"
                      v-model="form[fila.model]"
                      v-bind="fila.props"
                      :disabled="getDisabled(fila) || isDisabled(fila)"
                      density="compact"
                    ></v-text-field>
                    <v-select v-else-if="fila.component === 'select'"
                      v-model="form[fila.model]"
                      :items="getItems(fila)"
                      :disabled="isDisabled(fila)"
                      v-bind="fila.props"
                      density="compact"
                    ></v-select>
                    <v-textarea v-else-if="fila.component === 'textArea'"
                      v-model="form[fila.model]"
                      :disabled="getDisabled(fila) || isDisabled(fila)"
                      v-bind="fila.props"
                    ></v-textarea>
                    <v-text v-else-if="fila.component === 'text'">{{ fila.text }}</v-text>
                    <v-checkbox v-else 
                      v-model="form[fila.model]" 
                      hide-details="auto" 
                      :disabled="isDisabled(fila)">
                      <template v-slot:label>{{ fila.text }}</template>
                    </v-checkbox>
                  </v-col>
                </v-row>
              </v-card>
            </v-col>
            <v-col cols="4" class="pa-0">
              <v-card class="mb-2 mr-2">
                <v-card-title>Repuestos requeridos:</v-card-title>
                <v-card-text>
                    <v-row>
                    <v-col cols="6" v-for="(componente, i) in componentes" :key="i" class="pa-0">
                      <v-list-item>{{ componente }}</v-list-item>
                    </v-col>
                  </v-row>
                </v-card-text>
                <v-divider></v-divider>
                <v-card-actions>
                  <v-btn color="primary" :disabled="!isEditing">Modificar</v-btn>
                </v-card-actions>
              </v-card>
              <v-card class="mr-2">
                <v-card-title>Insumos requeridos:</v-card-title>
                <v-card-text>
                    <v-row>
                    <v-col cols="6" v-for="(componente, i) in componentes" :key="i" class="pa-0">
                      <v-list-item>{{ componente }}</v-list-item>
                    </v-col>
                  </v-row>
                </v-card-text>
                <v-divider></v-divider>
                <v-card-actions>
                  <v-btn color="primary" :disabled="!isEditing">Modificar</v-btn>
                </v-card-actions>
              </v-card>
            </v-col>
          </v-row>
        </v-form>
      </v-card-text>
    </v-card>
  </v-container>
</template>


<script setup>
import { ref, computed } from 'vue';
import { defineProps } from 'vue';

const props = defineProps({
  maquina: {
    type: Array,
    required: true,
  },
});

const isEditing = ref(false);
const form = ref({
  nombre: '',
  numero_de_serie: '',
  modelo: '',
  fecha_adquisicion: '',
  fechaUMantM: '',
  fechaPMantM: '',
  selectEstado: null,
  selectTipo: null,
  voltaje: '',
  peso: '',
  checkbox1: false,
  checkbox2: false,
  checkbox3: false,
  checkbox4: false,
  checkbox5: false,
  cantidad: '',
  seguimiento: '',
  seguridad: '',
  ubicacionM: '',
  problemasM: '',
  recomenM: '',
  observaciones_generales: '',
});

const tipos = ['Hidraulica', 'Electrica', 'Neumatica', 'Mecanica', 'Termica', 'Electronica', 'Quimica', 'Alimentaria'];

const estados = ['En uso', 'Disponible', 'Indisponible'];

const cartas = ref([
  {
    filas: [
      { model: 'nombre', component: 'textField', size: 9, class: 'pb-0', props: { label: 'Nombre' } },
      { model: 'selectEstado', component: 'select', size: 3, class: 'pb-0 pl-0', props: { label: 'Estado' } },
      { model: 'numero_de_serie', component: 'textField', size: 5, class: 'py-0', props: { label: 'Identificador' } },
      { model: 'modelo', component: 'textField', size: 4, class: 'pa-0', props: { label: 'Modelo' } },
      { model: 'selectTipo', component: 'select', size: 4, class: 'py-0', props: { label: 'Tipo' } },
      { model: 'voltaje', component: 'textField', size: 4, class: 'pa-0', props: { label: 'Voltaje' } },
      { model: 'peso', component: 'textField', size: 4, class: 'py-0', props: { label: 'Peso' } },
      { component: 'text', size: 3, text: 'Fecha de adquisicion:', class: 'py-0' },
      { model: 'fecha_adquisicion', component: 'textField', size: 4, class: 'pa-0', props: { label: 'Fecha de adquisicion', type: 'date' } },
      { component: 'text', size: 4 },
      { component: 'text', size: 3, text: 'Mantenimiento:', class: 'py-0' },
      { model: 'fechaUMantM', component: 'textField', size: 4, class: 'pa-0', props: { label: 'Ultimo', type: 'date' } },
      { model: 'fechaPMantM', component: 'textField', size: 5, class: 'py-0', props: { label: 'Proximo', type: 'date' } },
      { model: 'checkbox1', component: 'checkbox', size: 4, text: 'Velocidad ajustable', class: 'py-0' },
      { model: 'checkbox2', component: 'checkbox', size: 8, text: 'Facilidad de desmontaje', class: 'py-0' },
      { model: 'checkbox3', component: 'checkbox', size: 4, text: 'Pantalla digital', class: 'py-0' },
      { model: 'checkbox4', component: 'checkbox', size: 3, text: 'Garantia', class: 'py-0' },
      { model: 'cantidad', component: 'textField', size: 5, class: 'py-0', props: { label: 'Cantidad' } },
      { model: 'checkbox5', component: 'checkbox', size: 12, text: 'Requiere seguimiento', class: 'py-0' },
      { model: 'seguimiento', component: 'textArea', size: 12, class: 'py-0', props: { label: 'Aclaracion', rows: 1 } },
    ],
  },
  {
    filas: [
      { component: 'text', size: 12, text: 'Observaciones generales' },
      { component: 'text', size: 12, text: 'Ubicacion:', class: 'py-0' },
      { model: 'ubicacionM', component: 'textArea', size: 12, class: 'py-0', props: { label: 'Descripcion', rows: 1 } },
      { component: 'text', size: 12, text: 'Problemas recurrentes:', class: 'py-0' },
      { model: 'problemasM', component: 'textArea', size: 12, class: 'py-0', props: { label: 'Descripcion', rows: 2 } },
      { component: 'text', size: 12, text: 'Recomendaciones:', class: 'py-0' },
      { model: 'recomenM', component: 'textArea', size: 12, class: 'py-0', props: { label: 'Descripcion', rows: 2 } },
      { component: 'text', size: 12, text: 'Comentarios adicionales:', class: 'py-0' },
      { model: 'observaciones_generales', component: 'textArea', size: 12, class: 'py-0', props: { label: 'Descripcion', rows: 2 } },
      { component: 'text', size: 12, text: 'Sistema de seguridad:', class: 'py-0' },
      { model: 'seguridad', component: 'textArea', size: 12, class: 'py-0', props: { label: 'Descripcion', rows: 2 } },
    ],
  },
]);

const componentes = ref(['una', 'dos', 'tres', 'cuatro', 'cinco', 'seis', 'siete', 'ocho', 'nueve']);

// Función para obtener los ítems según el modelo de la fila
const getItems = (fila) => {
  if (fila.model === 'selectTipo') {
    return tipos;
  } else if (fila.model === 'selectEstado') {
    return estados;
  }
  return [];
};

// Función para determinar si un campo está deshabilitado
const getDisabled = (fila) => {
  if (fila.model === 'cantidad') {
    return !form.value.checkbox4;
  } else if (fila.model === 'seguimiento') {
    return !form.value.checkbox5;
  }
  return false;
};

// Función para verificar si un campo está deshabilitado según el estado de edición
const isDisabled = () => {
  return !isEditing.value;
};

// Alterna el modo de edición
const toggleEditMode = () => {
  if (isEditing.value) {
    guardarCambios();
  }
  isEditing.value = !isEditing.value;
};

// Cancela la edición
const cancel = () => {
  isEditing.value = false;
};

// Función ficticia para simular el guardado de cambios
const guardarCambios = () => {
  // Implementar lógica de guardado
};





// // Función para inicializar los datos del formulario con los valores de `maquina`
// const initializeForm = () => {
//   if (props.maquina && props.maquina.length > 0) {
//     const maquinaData = props.maquina[0]; // Asumo que 'maquina' es un array y toma el primer elemento
//     form.value.nombre = maquinaData.nombre || '';
//     form.value.numero_de_serie = maquinaData.numero_de_serie || '';
//     form.value.modelo = maquinaData.modelo || '';
//     form.value.fecha_adquisicion = maquinaData.fecha_adquisicion || '';
//     form.value.fechaUMantM = maquinaData.fechaUMantM || '';
//     form.value.fechaPMantM = maquinaData.fechaPMantM || '';
//     form.value.selectEstado = maquinaData.selectEstado || 'Disponible';
//     form.value.selectTipo = maquinaData.selectTipo || null;
//     form.value.voltaje = maquinaData.voltaje || '';
//     form.value.peso = maquinaData.peso || '';
//     form.value.checkbox1 = maquinaData.checkbox1 || false;
//     form.value.checkbox2 = maquinaData.checkbox2 || false;
//     form.value.checkbox3 = maquinaData.checkbox3 || false;
//     form.value.checkbox4 = maquinaData.checkbox4 || false;
//     form.value.checkbox5 = maquinaData.checkbox5 || false;
//     form.value.cantidad = maquinaData.cantidad || '';
//     form.value.seguimiento = maquinaData.seguimiento || '';
//     form.value.seguridad = maquinaData.seguridad || '';
//     form.value.ubicacionM = maquinaData.ubicacionM || '';
//     form.value.problemasM = maquinaData.problemasM || '';
//     form.value.recomenM = maquinaData.recomenM || '';
//     form.value.observaciones_generales = maquinaData.observaciones_generales || '';
//   }
// };

// // Llama a `initializeForm` cuando el componente es montado para inicializar los datos
// initializeForm();

// // Usar watch para reaccionar a cualquier cambio en el prop 'maquina'
// watch(
//   () => props.maquina,
//   (newMaquina) => {
//     if (newMaquina && newMaquina.length > 0) {
//       initializeForm(); // Vuelve a cargar el formulario cuando 'maquina' cambie
//     }
//   }
// );
</script>
