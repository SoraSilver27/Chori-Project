<template>
  <v-container>
    <v-card>
      <v-card-title style="display: flex; align-items: center;" class="px-3 pt-3 pb-0">
        <v-text-field
          label="Buscador"
          clearable
          v-model="titleSelected"
          placeholder="Escribe para buscar"
        ></v-text-field>
        <v-col class="text-end">
          <v-btn prepend-icon="mdi-plus" :to="'/nueva_maquina'" color="blue">Añadir</v-btn>
        </v-col>
      </v-card-title>
      <v-card-text class="pt-0">
        <v-card>
          <v-tabs v-model="tab" fixed-tabs color="primary">
            <v-tab :value="1" prepend-icon="mdi-alert">Todo</v-tab>
            <v-tab :value="2" prepend-icon="mdi-message-text">En uso</v-tab>
            <v-tab :value="3" prepend-icon="mdi-tools">Disponible</v-tab>
            <v-tab :value="4" prepend-icon="mdi-archive-alert">Indisponible</v-tab>
          </v-tabs>

          <v-card-text class="pa-2" style="overflow: auto; width: auto; height: 76vh;">
            <v-tabs-window v-model="tab">
              <v-tabs-window-item :value="1">
                <FilteredMac :lista="filteredMac" />
              </v-tabs-window-item>

              <v-tabs-window-item :value="2">
                <FilteredMac :lista="filteredMac" />
              </v-tabs-window-item>

              <v-tabs-window-item :value="3">
                <FilteredMac :lista="filteredMac" />
              </v-tabs-window-item>

              <v-tabs-window-item :value="4">
                <FilteredMac :lista="filteredMac" />
              </v-tabs-window-item>
            </v-tabs-window>
          </v-card-text>
        </v-card>
      </v-card-text>
    </v-card>
  </v-container>
</template>


<script setup>
import { ref, computed, onMounted } from 'vue';
import axios from 'axios';
import FilteredMac from '@/components/Maquinas/FilteredMac.vue';
import { direccionIP } from '@/global';

const tab = ref(1);
const titleSelected = ref('');
const maquinarias = ref([]);
const myIP = direccionIP;

const fetchMaquinarias = async () => {
  try {
    const response = await axios.get(`${myIP}/api/maquinarias`);
    maquinarias.value = response.data;
  } catch (error) {
    console.error("Hubo un error al obtener los datos:", error);
  }
};


// Computed para filtrar maquinas según el estado y la búsqueda
const filteredMac = computed(() => {
  let filteredList = maquinarias.value?.data || [];

  if (titleSelected.value) {
    filteredList = filteredList.filter(item => 
      item.nombre.toLowerCase().includes(titleSelected.value.toLowerCase())
    );
  }

  if (tab.value === 1) return filteredList;
  return filteredList.filter(item => {
    if (tab.value === 2) return item.estado === "En uso";
    if (tab.value === 3) return item.estado === "Disponible";
    if (tab.value === 4) return item.estado === "Indisponible";
  });
});

onMounted(() => {
  fetchMaquinarias();
});
</script>