<template>
  <div>
    hola
    {{ componente }}
  </div>
</template>

<script setup>
import { ref, computed, onMounted } from 'vue';
import axios from 'axios';
import { direccionIP } from '@/global';
import Maquinas from './Maquinas.vue';
const myIP = direccionIP;


const componente = ref();
const fetchData = async () => {
  try {
    const response = await axios.get(`${myIP}/api/componente_evento`);
    componente.value = response.data;
  } catch (error) {
    console.error(error);
  }
};
fetchData();

</script>