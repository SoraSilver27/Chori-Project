<template>
  <div>
    <v-btn @click="saveData" color="primary">Guardar</v-btn>
    <v-form @submit.prevent="saveData">
      <v-text-field v-model="formData.nombre" label="Nombre" required />
      <v-text-field v-model="formData.numero_de_serie" label="No de Serie" required />
      <v-text-field v-model="formData.modelo" label="Modelo" />
      <v-text-field v-model="formData.descripcion" label="Descripción" required />
      
      <v-select
        v-model="formData.estado"
        :items="estados"
        label="Estado"
        required
        placeholder="Seleccione un estado"
      />
      
      <v-text-field v-model="formData.ubicacion" label="Ubicación" type="number" required />
    </v-form>
  </div>
</template>

<script setup>
import axios from "axios";
import { ref } from 'vue';
import { direccionIP } from "@/global";

const myIP = direccionIP;

// Datos del formulario
const formData = ref({
  nombre: '',
  numero_de_serie: '',
  modelo: '',
  descripcion: '',
  estado: '',
  ubicacion: '',
});

// Opciones del estado
const estados = ['En uso', 'Disponible', 'Indisponible'];

// Función para guardar los datos
const saveData = async () => {
  const payload = {
    nombre: formData.value.nombre,
    numero_de_serie: formData.value.numero_de_serie,
    modelo: formData.value.modelo,
    descripcion: formData.value.descripcion,
    estado: formData.value.estado,
    ubicacion: formData.value.ubicacion,
  };
  console.log('Payload:', payload);

  try {
    const response = await axios.post(`${myIP}/api/componentes`, payload);
    console.log("Datos enviados con éxito:", response.data);
  } catch (error) {
    console.error("Error al enviar los datos:", error.response.data);
  }
};

// Función para reiniciar el formulario
const resetForm = () => {
  formData.value = {
    nombre: '',
    numero_de_serie: '',
    modelo: '',
    descripcion: '',
    estado: '',
    ubicacion: '',
  };
};
</script>