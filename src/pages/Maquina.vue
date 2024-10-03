<template>
  <v-container class="ma-1 pa-1">
    <v-row>
      <v-col cols="10">
        <v-card>
          <v-row>
            <v-col cols="10">
              <v-tabs v-model="tab" color="blue">
                <v-tab value="1">Detalles</v-tab>
                <v-tab value="2">Componentes</v-tab>
                <v-tab value="3">Mantenimiento</v-tab>
              </v-tabs>
            </v-col>
            <v-col cols="2" class="text-end">
              <v-container class="pr-5">
                <p>ID: {{ ipMaquina.params.id }}</p>
              </v-container>
            </v-col>
          </v-row>
          <v-card-text class="caja pa-2">
            <v-tabs-window v-model="tab">

              <v-tabs-window-item value="1">
                <PerfilMaquina :maquina="maquina" :detalles="detalles"/>
              </v-tabs-window-item>

              <v-tabs-window-item value="2">
                <PerfilMComponente 
                  :componentesActuales="actualComp"
                  :componentesOpcionales="actualCompSelector"
                />
              </v-tabs-window-item>

              <v-tabs-window-item value="3">
                <PerfilMMantenimiento :maquinaComp="actualComp" />
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
import { ref, onMounted, watch } from 'vue';
import axios from 'axios';
import { direccionIP } from '@/global';


import PerfilMaquina from '@/components/Maquina/PerfilMaquina.vue';
import PerfilMMantenimiento from '@/components/Maquina/PerfilMMantenimiento.vue';
import PerfilMComponente from '@/components/Maquina/PerfilMComponente.vue';

const ipMaquina = useRoute();
const myIP = direccionIP;
const tab = ref(0);
const maquina = ref([]);
const detalles = ref([]);
const componentes = ref([]);
const actualComp = ref([]);
const actualCompSelector = ref([]);
const ID = ipMaquina.params.id;


// Función para obtener las maquinarias
const fetchMaquina = async () => {
  try {
    const respuesta = await axios.get(`${myIP}/api/maquinarias/${ipMaquina.params.id}`);
    maquina.value = respuesta.data;
    console.log(respuesta.data);
  } catch (error) {
    console.error('Hubo un error al obtener los datos de la maquina:', error);
  }
};
const fetchDetalles = async () => {
  try {
    const respuesta = await axios.get(`${myIP}/api/detalles/${ipMaquina.params.id}`);
    detalles.value = respuesta.data;
    console.log(respuesta.data);
  } catch (error) {
    console.error('Hubo un error al obtener los datos de los detalles:', error);
  }
};
const fetchComponentes = async () => {
  try {
    const respuesta = await axios.get(`${myIP}/api/componentes`);
    if (respuesta.data && respuesta.data.data) {
      componentes.value = respuesta.data.data; // Asegúrate de asignar correctamente los datos
      console.log('Componentes obtenidos:', respuesta.data);
    } else {
      console.error('La respuesta no contiene los datos esperados');
    }
  } catch (error) {
    console.error('Hubo un error al obtener los componentes:', error);
  }
};

watch(componentes, (newVal) => {
    if (newVal && Array.isArray(newVal) && newVal.length > 0) {
      actualComp.value = newVal.filter(componente => componente.ubicacion.id == ID);
      actualCompSelector.value = newVal.filter(componente => componente.ubicacion.id != ID);
    } else {
      console.error('Datos de componentes no disponibles o vacíos');
    }
  },

);


onMounted(() => {
  fetchMaquina();
  fetchDetalles();
  fetchComponentes();
});
</script>
