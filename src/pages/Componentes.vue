<template>
  <v-container>
    <v-card>
      <v-card-title style="display: flex; align-items: center;" class="px-3 pt-3 pb-0">
        <!-- Input de texto que reemplaza a v-autocomplete -->
        <v-text-field
          label="Buscador"
          clearable
          v-model="searchQuery"
          placeholder="Escribe para buscar"
        ></v-text-field>
        <v-col class="text-end">
          <v-btn prepend-icon="mdi-plus" :to="'/nuevo_componente'" color="blue">Añadir</v-btn>
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
                <FilteredComp :lista="filteredComp" />
              </v-tabs-window-item>

              <v-tabs-window-item :value="2">
                <FilteredComp :lista="filteredComp" />
              </v-tabs-window-item>

              <v-tabs-window-item :value="3">
                <FilteredComp :lista="filteredComp" />
              </v-tabs-window-item>

              <v-tabs-window-item :value="4">
                <FilteredComp :lista="filteredComp" />
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
import { direccionIP } from '@/global';
import FilteredComp from '@/components/Componentes/FilteredComp.vue';

const tab = ref(1);
const searchQuery = ref(''); // Este será el campo para la búsqueda
const componentesBD = ref([]); //para la base de datos
const myIP = direccionIP;



const fetchComponentes = async () => {
  try {
    const response = await axios.get(`${myIP}/api/componentes`);
    componentesBD.value = response.data.data;
  } catch (error) {
    console.error("Hubo un error al obtener los datos:", error);
  }
};

// Computed para filtrar componentes según el estado y la búsqueda
// para BD:  let filteredList = componentes.value?.data || [];
const filteredComp = computed(() => {
  let filteredList = componentesBD.value || [];

  // Filtro por búsqueda
  if (searchQuery.value) {
    filteredList = filteredList.filter(item =>
      item.nombre.toLowerCase().includes(searchQuery.value.toLowerCase())
    );
  }

  // Filtro por el estado según la pestaña activa
  if (tab.value === 1) return filteredList;
  return filteredList.filter(item => {
    if (tab.value === 2) return item.estado === "En uso";
    if (tab.value === 3) return item.estado === "Disponible";
    if (tab.value === 4) return item.estado === "Indisponible";
  });
});

onMounted(() => {
  fetchComponentes();
});
</script>
