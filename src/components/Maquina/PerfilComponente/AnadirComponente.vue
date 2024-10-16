<template>
  <v-card class="bg-surface-light">
    <v-card-title>Agregar componente</v-card-title>
    <v-card-text>
      <v-select
        label="Nombre"
        :items="uniqueNombres"
        v-model="selectedName"
      ></v-select>

      <v-select
        label="Numero de serie"
        :items="uniqueNumeroSeries"
        v-model="selectedSerial"
        @change="onFieldChange"
      ></v-select>

      <v-select
        label="Modelo"
        :items="filteredModels"
        v-model="selectedModel"
        @change="onFieldChange"
      ></v-select>
    </v-card-text>
    <v-card-actions>
      <v-btn @click="resetFields">Cancelar</v-btn>
      <v-btn @click="anadirComponente">Anadir</v-btn>
    </v-card-actions>
  </v-card>
</template>

<script setup>
import { ref, computed, defineProps } from 'vue';

const props = defineProps({
  actualCompSelector: {
    type: Array,
    required: true,
  },
});

const selectedName = ref(null);
const selectedSerial = ref(null);
const selectedModel = ref(null);

const uniqueNombres = computed(() => {
  const nombres = props.actualCompSelector.map((item) => item.nombre);
  return [...new Set(nombres)];  // Nombres únicos
});

// Filtrar números de serie basados en el nombre seleccionado
const uniqueNumeroSeries = computed(() => {
  if (selectedName.value && !selectedModel.value) {
    const serieList = props.actualCompSelector
      .filter((item) => item.nombre === selectedName.value)
      .map((item) => item.numero_de_serie);
    return [...new Set(serieList)];
  } else if (selectedModel.value && !selectedName.value) {
    const serieList = props.actualCompSelector
      .filter((item) => item.modelo === selectedModel.value)
      .map((item) => item.numero_de_serie);
    return [...new Set(serieList)];
  } else if (selectedName.value && selectedModel.value) {
    const serieList = props.actualCompSelector
      .filter((item) => item.nombre === selectedName.value)
      .filter((item) => item.modelo === selectedModel.value)
      .map((item) => item.numero_de_serie);
    return [...new Set(serieList)];
  } else if (!selectedName.value && !selectedModel) {
    const serieList = props.actualCompSelector.map((item) => item.numero_de_serie);
    return [...new Set(serieList)];
  }
});
console.log(uniqueNumeroSeries);
// // Filtrar números de serie basados en las selecciones actuales
// const filteredSerials = computed(() => {
//   let filtered = props.componentesNU;
//   // Filtra por nombre seleccionado
//   if (selectedName.value) {
//     filtered = filtered.filter((item) => item.nombre === selectedName.value);
//   }
//   // Filtra por modelo seleccionado
//   if (selectedModel.value) {
//     filtered = filtered.filter((item) => item.modelo === selectedModel.value);
//   }
//   // Obtén números de serie únicos
//   return [...new Set(filtered.map((item) => item.numero_serie))];
// });

// // Filtrar modelos basados en las selecciones actuales
// const filteredModels = computed(() => {
//   let filtered = props.componentesNU;
//   // Filtra por nombre seleccionado
//   if (selectedName.value) {
//     filtered = filtered.filter((item) => item.nombre === selectedName.value);
//   }
//   // Filtra por número de serie seleccionado
//   if (selectedSerial.value) {
//     filtered = filtered.filter((item) => item.numero_serie === selectedSerial.value);
//   }
//   // Obtén modelos únicos
//   return [...new Set(filtered.map((item) => item.modelo))];
// });

// // Método para manejar cambios en cualquier campo
// const onFieldChange = () => {
//   // Actualiza las selecciones dependiendo de lo que se ha seleccionado
// };

const resetFields = () => {
  selectedName.value = null;
  selectedSerial.value = null;
  selectedModel.value = null;
};

// // Computed para obtener el componente seleccionado
// const selectedComponent = computed(() => {
//   const filteredComponents = props.componentesNU.filter((item) => {
//     return (
//       item.nombre === selectedName.value &&
//       item.numero_serie === selectedSerial.value &&
//       item.modelo === selectedModel.value
//     );
//   });
//   // Si hay más de un componente con los mismos datos seleccionados, muestra un mensaje
//   if (filteredComponents.length > 1) {
//     console.warn('Hay más de un componente con los mismos datos seleccionados.');
//   }
//   // Retorna el único componente o null si no hay ninguno
//   return filteredComponents.length === 1 ? filteredComponents[0] : null;
// });


// // Función para añadir componente (actualizar la ubicación)
// const anadirComponente = async () => {
//   if (!selectedComponent.value) {
//     console.log('Selecciona un componente válido');
//     return;
//   }
//   try {
//     // Envía la solicitud para actualizar el componente con la nueva ubicación
//     await axios.put(`/api/componentes/${selectedComponent.value.id}`, {
//       ubicacion: props.maquinaId,
//     });
//     console.log('Componente actualizado exitosamente');
//     // Opcionalmente, puedes mostrar un mensaje de éxito o resetear los campos
//     resetFields();
//   } catch (error) {
//     console.error('Error actualizando el componente:', error);
//   }
// };

</script>
