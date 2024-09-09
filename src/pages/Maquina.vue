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
                <PerfilMaquina/>
              </v-tabs-window-item>

              <v-tabs-window-item value="2">
                <PerfilMComponente/>
              </v-tabs-window-item>

              <v-tabs-window-item value="3">
                <PerfilMMantenimiento/>
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

<script>
import PerfilMaquina from '@/components/PerfilMaquina.vue';
import PerfilMMantenimiento from '@/components/PerfilMMantenimiento.vue';
import PerfilMComponente from '@/components/PerfilMComponente.vue';

export default {
  components: {
    PerfilMaquina,
    PerfilMComponente,
    PerfilMMantenimiento,
  },
  data() {
    return {
      tab: 0,
    }
  },
}
</script>

