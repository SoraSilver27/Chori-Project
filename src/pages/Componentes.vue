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

//para probar de ejemplo mientras se tiene la BD desactivada
const componentes = ref([
  {
    id: 1,
    nombre: "A probar cosas",
    numeroSerie: "ABC12345",
    modelo: "Mod-001",
    descripcion: "Componente utilizado para pruebas de rendimiento.",
    estado: "Disponible"
  },
  {
    id: 2,
    nombre: "veremos que pasa cuando el nombre es demasiado largo para ver que tanto ocupa de espacio",
    numeroSerie: "DEF67890",
    modelo: "Mod-002",
    descripcion: "Dispositivo utilizado en producción.",
    estado: "En uso"
  },
  {
    id: 3,
    nombre: "Para poner a prueba",
    numeroSerie: "GHI54321",
    modelo: "Mod-003",
    descripcion: "Componente en revisión técnica.",
    estado: "Indisponible"
  },
  {
    id: 4,
    nombre: "Motores ultra",
    numeroSerie: "JKL09876",
    modelo: "Mod-004",
    descripcion: "Componente reservado para nuevos proyectos.",
    estado: "Disponible"
  },
  {
    id: 5,
    nombre: "No tengo ni idea de que poner",
    numeroSerie: "MNO34567",
    modelo: "Mod-005",
    descripcion: "Dispositivo obsoleto en espera de ser reciclado.",
    estado: "Indisponible"
  },
  {
    id: 6,
    nombre: "Hay que funcionar",
    numeroSerie: "PQR98765",
    modelo: "Mod-006",
    descripcion: "Componente en uso para pruebas de integración.",
    estado: "En uso"
  },
  {
    id: 7,
    nombre: "Que tal todo chaval",
    numeroSerie: "STU87654",
    modelo: "Mod-007",
    descripcion: "Unidad de reemplazo en inventario.",
    estado: "Disponible"
  }
]);

const fetchComponentes = async () => {
  try {
    const response = await axios.get(`${myIP}/api/componentes`);
    componentesBD.value = response.data;
  } catch (error) {
    console.error("Hubo un error al obtener los datos:", error);
  }
};

// Computed para filtrar componentes según el estado y la búsqueda
// para BD:  let filteredList = componentes.value?.data || [];
const filteredComp = computed(() => {
  let filteredList = componentes.value || [];

  // Filtro por búsqueda (case insensitive)
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
