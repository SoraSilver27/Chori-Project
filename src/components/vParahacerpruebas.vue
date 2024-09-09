<template>
  <v-container>
    <v-card>
      <v-card-title style="display: flex; align-items: center;" class="px-3 py-0">
        <v-autocomplete
          label="Buscar"
          clearable
          :items="titleList"
          v-model="titleSelected"
        ></v-autocomplete>
        <v-col class="text-end">
          <v-btn prepend-icon="mdi-plus" style="height: 56px;" :to="'/nueva_maquina'">Añadir</v-btn>
        </v-col>
      </v-card-title>
      <v-card-text>
        <v-card>
          <v-tabs v-model="tab" fixed-tabs color="primary">
            <v-tab :value="1" prepend-icon="mdi-alert">Todo</v-tab>
            <v-tab :value="2" prepend-icon="mdi-message-text">En uso</v-tab>
            <v-tab :value="3" prepend-icon="mdi-tools">Disponible</v-tab>
            <v-tab :value="4" prepend-icon="mdi-archive-alert">Indisponible</v-tab>
          </v-tabs>

          <v-card-text class="caja pa-2">
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


<script>
import FilteredMac from '@/components/FilteredMac.vue';
import { direccionIP } from '@/global';
import axios from 'axios';

export default {
  components: {
    FilteredMac,
  },
  data() {
    return {
      tab: 1,
      titleSelected: '',
      maquinarias: [],
      myIP: direccionIP,
    };
  },
  computed: {
    filteredMac() {
      let filteredList = this.maquinarias?.data || [];

      if (this.titleSelected) {
        filteredList = filteredList.filter(item => item.nombre.includes(this.titleSelected));
      }

      if (this.tab === 1) return filteredList;
      return filteredList.filter(item => {
        if (this.tab === 2) return item.estado === "En uso";
        if (this.tab === 3) return item.estado === "Disponible";
        if (this.tab === 4) return item.estado === "Indisponible";
      }); 
    },
    titleList() {
      return [...new Set(this.maquinarias?.data?.map(item => item.nombre) || [])];
    }
  },
  mounted() {
    this.fetchMaquinarias();
  },
  methods: {
    async fetchMaquinarias() {
      try {
        const response = await axios.get(`${this.myIP}/api/maquinarias`);
        this.maquinarias = response.data;
      } catch (error) {
        console.error("Hubo un error al obtener los datos:", error);
      }
    }
  } 
};
</script>