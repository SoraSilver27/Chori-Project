<template>
  <h1>hola {{ route.params.id }}</h1>
  <p>{{ maquina }}</p>
</template>

<script setup>
import { useRoute } from "vue-router";
import { ref, onMounted } from 'vue';
import axios from 'axios';
import { direccionIP } from '@/global';

const route = useRoute();
const maquina = ref([]);
const myIP = direccionIP;

// Función para obtener las maquinarias
const fetchMaquina = async () => {
  try {
    const respuesta = await axios.get(`${myIP}/api/maquinarias/${route.params.id}?includeDetalles=true`);
    maquina.value = respuesta.data;
    console.log(respuesta.data);
  } catch (error) {
    console.error('Hubo un error al obtener los datos:', error);
  }
};

// Ejecutar la función cuando el componente se monte
onMounted(() => {
  fetchMaquina();
});
</script>
