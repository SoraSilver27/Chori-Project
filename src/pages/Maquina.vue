<template>
  <v-container class="ma-1 pa-1">
    <v-row>
      <v-col cols="10">
        <v-card>
          <v-tabs v-model="tab" bg-color="">
            <v-tab value="1">Detalles</v-tab>
            <v-tab value="2">Componentes</v-tab>
            <v-tab value="3">Mantenimiento</v-tab>
          </v-tabs>

          <v-card-text class="caja pa-2">
            <v-tabs-window v-model="tab">

              <v-tabs-window-item value="1">
                <PerfilMaquina :maquina="maquina"/>
              </v-tabs-window-item>

              <v-tabs-window-item value="2">
                <PerfilMComponente/>
              </v-tabs-window-item>

              <v-tabs-window-item value="3">
                <PerfilMMantenimiento :maquinaComp="maquinaComp" />
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


import PerfilMaquina from '@/components/Maquina/PerfilMaquina.vue';
import PerfilMMantenimiento from '@/components/Maquina/PerfilMMantenimiento.vue';
import PerfilMComponente from '@/components/Maquina/PerfilMComponente.vue';
import VPruebaDos from "@/components/vPruebaDos.vue";

const route = useRoute();
const myIP = direccionIP;
const tab = ref(0);
const maquina = ref([]);
const maquinaComp = ref([]);


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

// Función para obtener los componentes de la maquina
// const fetchMaquinaComp = async () => {
  // try {
  //   const respuesta = await axios.get(`${myIP}/api/maquinarias/${route.params.id}?includeComponentes=true`);
  //   maquinaComp.value = respuesta.data;
  //   console.log(respuesta.data);
  // } catch (error) {
  //   console.error('Hubo un error al obtener los datos:', error);
  // }

  // Buscar la ruta de los componentes de la maquina
// };

// Ejecutar la función cuando el componente se monte
onMounted(() => {
  fetchMaquina();
  // ferchMaquinaComp();
});
</script>
