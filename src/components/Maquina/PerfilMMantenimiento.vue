<template>
  <v-container class="ma-0 py-0 px-1">
    <v-card class="bg-surface-light pa-1 ma-0">
      <v-card-title style="display: flex; align-items: center;" class="pa-1">
        Mantenimiento de los componentes
        <v-col class="pa-2 text-end">
          <v-btn v-if="isEditing" color="primary" @click="cancel" class="mr-3">Cancelar</v-btn>
          <v-btn color="primary" prepend-icon="mdi-pencil" @click="toggleEditMode">
            {{ isEditing ? 'Guardar' : 'Editar' }}
          </v-btn>
        </v-col>
      </v-card-title>
      <v-container class="pa-0">
        <v-container class="pa-0" v-if="!isEditing">
            <MantPerfil :maquinaComp="maquinaComp"/>
        </v-container>

        <v-container v-else class="pa-0">
          <v-card>
            <MantPerfilList :maquinaComp="copiaMaquinaComp"/>
          </v-card>
        </v-container>

      </v-container>
    </v-card>
  </v-container>
</template>


<script setup>
import { ref, defineProps, computed } from 'vue';
import axios from 'axios';
import { direccionIP } from '@/global';
import MantPerfil from './PerfilMantenimiento/MantPerfil.vue';
import MantPerfilList from './PerfilMantenimiento/MantPerfilList.vue';

const props = defineProps({
  maquinaComp: {
    type: Array,
    required: true,
  },
});
 
// Variables reactivas
const isEditing = ref(false);
const myIP = direccionIP;
const copiaMaquinaComp = ref(
  props.maquinaComp.map(({ ubicacion, ...resto }) => resto)
);

// Función que se llama cuando MantPerfilList emite datos actualizados (solo al guardar)
function actualizar(datosActualizados) {
  copiaMaquinaComp.value = datosActualizados; // Actualiza los datos modificados
}

// Methods
function toggleEditMode() {
  if (isEditing.value) {
    guardarCambios();
  }
  isEditing.value = !isEditing.value;
}

async function guardarCambios() {
  try {
    // Emitir los datos modificados antes de guardar
    const respuesta = await axios.put(`${myIP}/api/componentes`, 
    copiaMaquinaComp.value);
    console.log('Datos guardados:', respuesta.data);

  } catch (error) {
    console.error('Error al guardar los datos:', error);
  }
}

function cancel() {
  copiaMaquinaComp.value = { ...props.maquinaComp };
  isEditing.value = !isEditing.value;
}
</script>
