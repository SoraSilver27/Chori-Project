<template>
  <v-card class="bg-surface-light">
    <v-card-title style="display: flex; align-items: center;" class="px-3 py-0">
      Perfil del componente
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
            <PerfilInfoComp 
              :localComponente="localComponente"
              :filas="filas"
              :isEditing="isEditing"
            />
          </v-col>
          <v-col cols="4" class="pa-0">
            <v-card>
              <PerfilImagenComp :localComponente="localComponente"/>
            </v-card>
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
import PerfilInfoComp from './PerfilInfoComp.vue';
import PerfilImagenComp from './PerfilImagenComp.vue';

const props = defineProps({
  componenteUnico: {
    type: Object,
    required: true,
  },
});

const emit = defineEmits(['update']);
const ipComp = useRoute();
const myIP = direccionIP;
const localComponente = ref(props.componenteUnico? { ...props.componenteUnico } : {});
const isEditing = ref(false);


// Función para guardar los datos
const saveData = async () => {
  try {
    const payload = {
      ...localComponente.value,
    };

    const response = await axios.put(`${myIP}/api/componentes/${ipComp.params.id}`, payload);

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

// Función para alternar el modo de edición y guardar cambios
const toggleEditMode = () => {
  if (isEditing.value) {
    saveData();
    emit('update', localComponente.value);
  }
  isEditing.value = !isEditing.value;
};

const cancel = () => {
  localComponente.value = { ...props.componenteUnico };
  isEditing.value = false;
};

watch(
  () => props.componenteUnico,
  (newValue) => {
    if (newValue) {
      localComponente.value = { ...newValue}; // Asignamos una copia 
    }
  },
  { immediate: true }
);

const filas = ref([
  { model: 'nombre', component: VTextField, size: 8, props: { label: 'Nombre' } },
  { model: 'estado', component: VSelect, size: 4, props: { label: 'Estado', items: ['En uso', 'Disponible', 'Indisponible'] } },
  { model: 'numero_de_serie', component: VTextField, size: 4, props: { label: 'N de Serie' } },
  { model: 'modelo', component: VTextField, size: 4, props: { label: 'Modelo' } },
  { model: 'created_at', component: VTextField, size: 4, props: { label: 'Fecha de Adquisición', type: 'date' } },
  { model: 'ubicacion', component: VTextField, size: 4, props: { label: 'Actualmente en:' } },
  { model: 'descripcion', component: VTextarea, size: 12, ocultar: 'auto', props: { label: 'Descripcion', rows: 2 } },
]);

</script>