<template>
  <v-card>
    <v-card-title>Agregar componente</v-card-title>
    <v-card-text>
      <v-select
        label="Nombre"
        :items="filteredNames"
        v-model="selectedName"
        @change="onFieldChange"
      ></v-select>

      <v-select
        label="Numero de serie"
        :items="filteredSerials"
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
      <v-btn>Anadir</v-btn>
    </v-card-actions>
  </v-card>
</template>

<script setup>
import { ref, computed, defineProps } from 'vue';

const props = defineProps({
  componentesNU: {
    type: Array,
    required: true,
  },
});

const selectedName = ref(null);
const selectedSerial = ref(null);
const selectedModel = ref(null);

// Filtrar nombres únicos de la lista de componentes
const filteredNames = computed(() => {
  let filtered = props.componentesNU;

  // Filtra por nombre seleccionado
  if (selectedSerial.value) {
    filtered = filtered.filter((item) => item.numero_serie === selectedSerial.value);
  }

  // Filtra por modelo seleccionado
  if (selectedModel.value) {
    filtered = filtered.filter((item) => item.modelo === selectedModel.value);
  }

  // Obtén números de serie únicos
  return [...new Set(filtered.map((item) => item.nombre))];
});

// Filtrar números de serie basados en las selecciones actuales
const filteredSerials = computed(() => {
  let filtered = props.componentesNU;

  // Filtra por nombre seleccionado
  if (selectedName.value) {
    filtered = filtered.filter((item) => item.nombre === selectedName.value);
  }

  // Filtra por modelo seleccionado
  if (selectedModel.value) {
    filtered = filtered.filter((item) => item.modelo === selectedModel.value);
  }

  // Obtén números de serie únicos
  return [...new Set(filtered.map((item) => item.numero_serie))];
});

// Filtrar modelos basados en las selecciones actuales
const filteredModels = computed(() => {
  let filtered = props.componentesNU;

  // Filtra por nombre seleccionado
  if (selectedName.value) {
    filtered = filtered.filter((item) => item.nombre === selectedName.value);
  }

  // Filtra por número de serie seleccionado
  if (selectedSerial.value) {
    filtered = filtered.filter((item) => item.numero_serie === selectedSerial.value);
  }

  // Obtén modelos únicos
  return [...new Set(filtered.map((item) => item.modelo))];
});

// Método para manejar cambios en cualquier campo
const onFieldChange = () => {
  // Actualiza las selecciones dependiendo de lo que se ha seleccionado
};

const resetFields = () => {
  selectedName.value = null;
  selectedSerial.value = null;
  selectedModel.value = null;
};
</script>
