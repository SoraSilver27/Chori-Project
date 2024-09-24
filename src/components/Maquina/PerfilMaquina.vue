<template>
  <v-card class="bg-surface-light">
    <v-card-title style="display: flex; align-items: center;" class="px-3 py-0">
      Perfil de la máquina
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
          <!-- Importamos y usamos el componente hijo aquí -->
          <v-col cols="8" class="pa-0">
            <PerfilInfo
              :filas="filas"
              :localMaquina="localMaquina"
              :localDetalles="localDetalles"
              :isEditing="isEditing"
            />
          </v-col>
          
          <v-col cols="4" class="pa-0">
              <MaquinaComp/>
              {{ localDetalles }}
              {{ localMaquina }}
          </v-col>
        </v-row>
      </v-form>
    </v-card-text>
  </v-card>
</template>

<script setup>
import axios from 'axios';
import { useRoute } from "vue-router";
import { ref, watch, defineProps, defineEmits } from 'vue';
import { VCheckbox, VSelect, VTextarea, VTextField } from 'vuetify/components';
import { direccionIP } from '@/global';
import MaquinaComp from './PerfilMaquina/MaquinaComp.vue';
import PerfilInfo from './PerfilMaquina/PerfilInfo.vue';

const props = defineProps({
  maquina: {
    type: Object,
    required: true,
  },
  detalles: {
    type: Object,
    required: true,
  }
});

const emit = defineEmits(['update']);
const route = useRoute();
const myIP = direccionIP;
const localMaquina = ref(props.maquina?.data ? { ...props.maquina.data } : {});
const localDetalles = ref(props.detalles?.data? { ...props.detalles.data } : {});
const isEditing = ref(false);

// Función para guardar los datos
const saveData = async () => {
  try {
    const payload = {
      ...localMaquina.value,
    };

    const response = await axios.put(`${myIP}/api/maquinarias/${route.params.id}`, payload);

    if (response.status === 200) {
      console.log('Datos guardados correctamente');
      alert('Datos guardados correctamente');
      isEditing.value = false;
    } else {
      console.error('Error al guardar los datos');
      alert('Error al guardar los datos');
    }
  } catch (error) {
    console.error('Error en la peticiónUno:', error);
    alert('Error en la petición');
  }
};
const saveDataDos = async () => {
  try {
    const payload = {
      ...localDetalles.value,
    };

    const response = await axios.put(`${myIP}/api/detalles/${route.params.id}`, payload);

    if (response.status === 200) {
      console.log('Datos guardados correctamente');
      alert('Datos guardados correctamente dos');
      isEditing.value = false;
    } else {
      console.error('Error al guardar los datos');
      alert('Error al guardar los datos dos');
    }
  } catch (error) {
    console.error('Error en la peticiónDos:', error);
    alert('Error en la petición dos');
  }
};


// Función para alternar el modo de edición y guardar cambios
const toggleEditMode = () => {
  if (isEditing.value) {
    saveData();
    emit('update', localMaquina.value);
    saveDataDos();
    emit('update', localDetalles.value);
  }
  isEditing.value = !isEditing.value;
};

const cancel = () => {
  localMaquina.value = { ...props.maquina.data };
  localDetalles.value = { ...props.detalles.data };
  isEditing.value = false;
};

watch(
  () => props.maquina,
  (newValue) => {
    if (newValue) {
      localMaquina.value = { ...newValue.data }; // Asignamos una copia de props.maquina a localMaquina
    }
  },
  { immediate: true }
);

watch(
  () => props.detalles,
  (newValue) => {
    if (newValue) {
      localDetalles.value = { ...newValue.data }; // Asignamos una copia de props.detalles a localDetalles
    }
  },
  { immediate: true }
);


const filas = ref([
  { clasificacion: 'objeto', model: 'nombre', component: VTextField, size: 9, props: { label: 'Nombre' } },
  { clasificacion: 'objeto', model: 'estado', component: VSelect, size: 3, props: { label: 'Estado', items: ['En uso', 'Disponible', 'Indisponible'] } },
  { clasificacion: 'objeto', model: 'numero_de_serie', component: VTextField, size: 4, props: { label: 'Identificador' } },
  { clasificacion: 'objeto', model: 'modelo', component: VTextField, size: 4, props: { label: 'Modelo' } },
  { clasificacion: 'objeto', model: 'fecha_adquisicion', component: VTextField, size: 4, props: { label: 'Fecha de Adquisición', type: 'date' } },
  { clasificacion: 'array', model: 'tipo', component: VTextField, size: 4, ocultar: 'auto', props: { label: 'Tipo' } },
  { clasificacion: 'array', model: 'voltaje', component: VTextField, size: 4, ocultar: 'auto', props: { label: 'Voltaje' } },
  { clasificacion: 'array', model: 'peso', component: VTextField, size: 4, ocultar: 'auto', props: { label: 'Peso' } },
  { clasificacion: 'array', model: 'velocidad_ajustable', component: VCheckbox, size: 4, ocultar: 'auto', text: 'Velocidad ajustable', props: {} },
  { clasificacion: 'array', model: 'facil_desmontaje', component: VCheckbox, size: 6, ocultar: 'auto', text: 'Facilidad de desmontaje' },
  { clasificacion: 'array', model: 'pantalla_digital', component: VCheckbox, size: 4, ocultar: 'auto', text: 'Pantalla digital' },
  { clasificacion: 'array', model: 'garantia', component: VCheckbox, size: 3, ocultar: 'auto', text: 'Garantía' },
  { clasificacion: 'array', model: 'garantia_cantidad', component: VTextField, size: 5, ocultar: 'auto', props: { label: 'Cantidad' } },
  { clasificacion: 'objeto', model: 'en_seguimiento', component: VCheckbox, size: 12, text: 'Requiere seguimiento', ocultar: 'auto' },
  { clasificacion: 'objeto', model: 'seguimiento', component: VTextarea, size: 12, ocultar: 'auto', props: { label: 'Aclaracion', rows: 2 } },
  { clasificacion: 'array', model: 'problemas_recurrentes', component: VTextarea, size: 12, ocultar: 'auto', props: { label: 'Problemas recurrentes', rows: 2 } },
  { clasificacion: 'objeto', model: 'observaciones_generales', component: VTextarea, size: 12, ocultar: 'auto', props: { label: 'Observaciones Generales', rows: 2 } },
]);


</script>
