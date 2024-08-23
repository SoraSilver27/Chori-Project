<template>
  <div class="contenedor">
      <div class="notificaciones">
        <v-card>
          <v-tabs v-model="tab" bg-color="">
            <v-tab value="1">Maquina</v-tab>
            <v-tab value="2">Componentes</v-tab>
            <v-tab value="3">Mantenimiento</v-tab>
          </v-tabs>

          <v-card-text class="caja pa-2">
            <v-tabs-window v-model="tab">

              <v-tabs-window-item value="1">
                <NMaquinaInf @update-tab="updateTab"/>
              </v-tabs-window-item>

              <v-tabs-window-item value="2">
                <NMaquinaComp @update-tab="updateTab"/>
              </v-tabs-window-item>

              <v-tabs-window-item value="3">
                Three
              </v-tabs-window-item>

            </v-tabs-window>
          </v-card-text>
        </v-card>
      </div>

    <div class="historial pr-3">
      <h3>Componentes e insumos</h3>
      <v-divider :thickness="2" class="border-opacity-50" color="red"></v-divider>
      <div class="listado">
      </div>
      <v-divider :thickness="2" class="border-opacity-50" color="red"></v-divider>
      <h3>Ver mas</h3>
    </div>
  </div>
</template>



<script>
import NMaquinaInf from "@/components/NMaquinaInf.vue"
import NMaquinaComp from "@/components/NMaquinaComp.vue"

export default {
  components: {
    NMaquinaInf,
    NMaquinaComp,
  },
  data() {
    return {
      tab: 0,
    }
  },
  methods: {
    updateTab(newTabValue) {
      this.tab = newTabValue;
    }
  },
}
</script>


<style scoped>
  .contenedor{
    padding: 0;
    width: 100%;
    height: 100%;
    display: flex;
  }
  .contenido{
    width: 75%;
    height: 100%;
    /* background-color: burlywood; */
  }
  .caja{
    overflow: auto;
    width: auto;
    height: 83vh;
  }
  .historial{
    padding-top: 1%;
    width: 25%;
    height: 100%;
    /* background-color: rgb(60, 60, 60); */
    h1,h3 {
      text-align: center;
    }
  }
  .listado{
    width: 100%;
    height: 80%;
    /* background-color: darkgreen; */
  }
  .notificaciones{
    padding: 2%;
    width: 100%;
    height: 100%;
    /* background-color: darkgoldenrod; */
  }
</style>
