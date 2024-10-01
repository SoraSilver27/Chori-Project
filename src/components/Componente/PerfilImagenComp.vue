<template>
  <div>
    <v-card-title>Imagen</v-card-title>
    <v-card-text class="pb-0">
      <v-img 
        :src="localComponente.imagen || defaultImage" 
        alt="Imagen subida" max-width="300"
      ></v-img>
    </v-card-text>
    <v-card-actions>
      <template v-if="!isInputVisible">
        <v-btn color="primary" @click="showInput">Cambiar imagen</v-btn>
      </template>
      <template v-else>
        <v-file-input
          label="Selecciona una nueva imagen"
          v-model="imagen"
          accept="image/*"
          prepend-icon="mdi-camera"
          @change="updateImage"
          required
          density="compact"
          hide-details
        ></v-file-input>
        <v-btn @click="offInput" color="blue">Cancelar</v-btn>
      </template>
    </v-card-actions>
  </div>
</template>

<script setup>
import { ref, watch, defineProps, defineEmits } from 'vue';
import { useRoute } from "vue-router";
import { direccionIP } from '@/global';

const props = defineProps({
  localComponente: {
    type: Object,
    required: true,
  },
});

const ipComp = useRoute();
const myIP = direccionIP;
const imagen = ref(null); // Aquí almacenaremos la nueva imagen seleccionada
const isInputVisible = ref(false); // Estado para mostrar o esconder el input
const defaultImage = 'https://www.its.ac.id/tmesin/wp-content/uploads/sites/22/2022/07/no-image.png'; // Cambia esta ruta a la URL de tu imagen predeterminada


// Función para mostrar el input de archivo
const showInput = () => {
  isInputVisible.value = true;
};
const offInput = () => {
  isInputVisible.value = false;
};


// Función para actualizar la imagen
const updateImage = async () => {
  if (imagen.value) {
    const formData = new FormData();
    formData.append('image', imagen.value); // Adjuntamos la imagen seleccionada

    try {
      const response = await axios.put(`${myIP}/api/componentes/${ipComp.params.id}`, formData, {
        headers: {
          'Content-Type': 'multipart/form-data',
        },
      });

      if (response.status === 200) {
        console.log('Imagen actualizada correctamente');
        alert('Imagen actualizada correctamente');
        // Actualizar la imagen en localComponente
        localComponente.value.imagen = response.data.imagenUrl; // La URL de la nueva imagen devuelta por la API
        isInputVisible.value = false; // Esconder el input nuevamente después de la actualización
      } else {
        console.error('Error al actualizar la imagen');
        alert('Error al actualizar la imagen');
        isInputVisible.value = false;
      }
    } catch (error) {
      console.error('Error en la petición al actualizar la imagen:', error);
      alert('Error al actualizar la imagen');
      isInputVisible.value = false;
    }
  } else {
    alert('Por favor selecciona una imagen primero');
    isInputVisible.value = false;
  }
};


</script>