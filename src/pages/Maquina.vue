<template>
  <div class="contenedor">
    <div class="informacion">
      <v-card>
        <v-tabs v-model="tab" bg-color="">
          <v-tab value="1">Detalles</v-tab>
          <v-tab value="2">Componentes</v-tab>
          <v-tab value="3">Mantenimiento</v-tab>
        </v-tabs>

        <v-card-text class="caja pa-2">
          <v-tabs-window v-model="tab">

            <v-tabs-window-item value="1">
              <PerfilMaquina/>
            </v-tabs-window-item>

            <v-tabs-window-item value="2">
              twooo
            </v-tabs-window-item>

            <v-tabs-window-item value="3">
              <PerfilMMantenimiento/>
            </v-tabs-window-item>

          </v-tabs-window>
        </v-card-text>
      </v-card>
    </div>
    <div class="historial">

    </div>
  </div>
</template>

<script>
import PerfilMaquina from '@/components/PerfilMaquina.vue';
import PerfilMMantenimiento from '@/components/PerfilMMantenimiento.vue';

export default {
  components: {
    PerfilMaquina,
  },
  data() {
    return {
      tab: 0,
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
  .informacion{
    padding: 0%;
    width: 80%;
    height: 100%;
    /* background-color: aqua */
  }
  .caja{
    overflow: auto;
    width: auto;
    height: 90vh;
  }
  .historial{
    width: 20%;
    height: 100%;
    background-color: brown;
  }
</style>
