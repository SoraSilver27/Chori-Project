<template>
  <v-container class="ma-1 pa-1">
    <v-row>
      <v-col cols="10">
        <v-card>
          <v-tabs v-model="tab" bg-color="">
            <v-tab value="1">Detalles</v-tab>
            <v-tab value="2">Mantenimiento</v-tab>
          </v-tabs>

          <v-card-text class="caja pa-2">
            <v-tabs-window v-model="tab">

              <v-tabs-window-item value="1">
                <PerfilComponente :componenteUnico="componenteUnico"/>
              </v-tabs-window-item>

              <v-tabs-window-item value="2">
                <PerfilCompMant :componenteUnico="componenteUnico"/>
              </v-tabs-window-item>

            </v-tabs-window>
          </v-card-text>
        </v-card>
      </v-col>
      <v-col cols="2">
        <v-card class="bg-surface-light">
          aqui ira el historial y un monton de cosas mas
        </v-card>
      </v-col>
    </v-row>
  </v-container>

</template>

<script setup>
import { useRoute } from "vue-router";
import { ref, onMounted } from 'vue';
import axios from 'axios';
import { direccionIP } from '@/global';

import PerfilComponente from '@/components/Componente/PerfilComponente.vue';
import PerfilCompMant from "@/components/Componente/PerfilCompMant.vue";

const ipComp = useRoute();
const myIP = direccionIP;
const tab = ref(0);
const componenteUnico = ref([]);

// Función para obtener los componentes
const fetchComponente = async () => {
  try {
    const respuesta = await axios.get(`${myIP}/api/componentes/${ipComp.params.id}`);
    componenteUnico.value = respuesta.data.data;
    console.log(respuesta.data);
  } catch (error) {
    console.error('Hubo un error al obtener los datos:', error);
  }
};

// Ejecutar la función cuando el componente se monte
onMounted(() => {
  fetchComponente();
});
</script>
