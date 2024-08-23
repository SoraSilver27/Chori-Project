<template>
  <div class="contenedor">
    <div class="barra_sup">
      <div class="buscador">
        <v-container fluid class="pa-0">
          <v-autocomplete
            label="Buscar"
            clearable
            :items="titleList"
            v-model="titleSelected"
          ></v-autocomplete>
        </v-container>
      </div>
      <div class="boton">
        <v-btn prepend-icon="mdi-plus" style="height: 56px;" :to="'/NuevaMaquina'">Añadir</v-btn>
      </div>
    </div>
    <div class="aparatos">
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
    </div>
  </div>
</template>

<script>
import FilteredMac from '@/components/FilteredMac.vue';
import NuevaMaquina from './NuevaMaquina.vue';


import PerfilMaquina from '@/components/PerfilMaquina.vue';

export default {
  components: {
    FilteredMac,
  },
  data() {
    return {
      tab: 1,
      titleSelected: '',
      maquinaList: [
        { title: "Compresor", serie: "25624631", type: "maquina", state: "en_uso", descripcion: 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Cumque saepe sunt nam dolore,' },
        { title: "Cadenas X", serie: "55768155", type: "maquina", state: "en_uso", descripcion: 'sequi provident iste reiciendis ab officia! Earum veniam qui iure obcaecati reiciendis nobis tempore explicabo mollitia porro?' },
        { title: "Ruedas", serie: "w75tw54", type: "maquina", state: "en_uso", descripcion: 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Cumque saepe sunt nam dolore,' },
        { title: "Embutidora", serie: "55725863", type: "maquina", state: "en_uso", descripcion: 'sequi provident iste reiciendis ab officia! Earum veniam qui iure obcaecati reiciendis nobis tempore explicabo mollitia porro?' },
        { title: "Cadenas Y", serie: "57372541", type: "maquina", state: "disponible",descripcion: 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Cumque saepe sunt nam dolore,' },
        { title: "Motor", serie: "2948752", type: "maquina", state: "en_uso", descripcion:'sequi provident iste reiciendis ab officia! Earum veniam qui iure obcaecati reiciendis nobis tempore explicabo mollitia porro?' },
        { title: "Turbina", serie: "6829041", type: "maquina", state: "indisponible", descripcion: 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Cumque saepe sunt nam dolore,' },
        { title: "Piston", serie: "5862742", type: "maquina", state: "disponible", descripcion: 'sequi provident iste reiciendis ab officia! Earum veniam qui iure obcaecati reiciendis nobis tempore explicabo mollitia porro?' },
        { title: "Transformador", serie: "1479897", type: "maquina", state: "disponible", descripcion: 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Cumque saepe sunt nam dolore,' },
        { title: "Embasadora", serie: "09347158", type: "maquina", state: "en_uso", descripcion: 'sequi provident iste reiciendis ab officia! Earum veniam qui iure obcaecati reiciendis nobis tempore explicabo mollitia porro?' },
        { title: "Generador", serie: "q984587u9y", type: "maquina", state: "indisponible", descripcion: 'sequi provident iste reiciendis ab officia! Earum veniam qui iure obcaecati reiciendis nobis tempore explicabo mollitia porro?' },
      ],
    };
  },
  computed: {
    filteredMac() {
      let filteredList = this.maquinaList;

      if (this.titleSelected) {
        filteredList = filteredList.filter(item => item.title.includes(this.titleSelected));
      }

      if (this.tab === 1) return filteredList;
      return filteredList.filter(item => {
        if (this.tab === 2) return item.state === "en_uso";
        if (this.tab === 3) return item.state === "disponible";
        if (this.tab === 4) return item.state === "indisponible";
      });
    },
    titleList() {
      return [...new Set(this.maquinaList.map(item => item.title))];
    }
  },
};
</script>



<style scoped>
  .contenedor{
    padding: 0;
    width: 100%;
    height: 100%;
    display: flex;
    flex-direction: column;
    /* background-color: aqua; */
  }
  .barra_sup{
    width: 100%;
    height: 12%;
    /* background-color: rgb(41, 29, 13); */
    display: flex;
  }
  .buscador{
    width: 70%;
    padding: 1% 0% 1% 1%;
  }
  .boton{
    padding: 1% 1% 1% 0%;
    width: 30%;
    display: flex;
    justify-content: center;
  }
  .aparatos{
    padding: 1% 1% 0 1%;
    width: 100%;
    height: 88%;
    /* background-color: darkgoldenrod; */
  }
  .caja{
    overflow: auto;
    width: auto;
    height: 76vh;
  }
</style>

<!-- <template></template>
<script></script> -->
