<template>
  <v-container>
    <v-row>
      <v-col cols="10">
        <v-card-text class="pt-0">
          <v-card>
            <v-tabs v-model="tab" fixed-tabs color="primary">
              <v-tab :value="1" prepend-icon="mdi-alert">Todo</v-tab>
              <v-tab :value="2" prepend-icon="mdi-message-text">Ordenes</v-tab>
              <v-tab :value="3" prepend-icon="mdi-tools">Mantenimiento</v-tab>
              <v-tab :value="4" prepend-icon="mdi-archive-alert">Stock</v-tab>
            </v-tabs>

            <v-card-text class="pa-2" style="overflow: auto; width: auto; height: 76vh;">
              <v-tabs-window v-model="tab">
                <v-tabs-window-item :value="1">
                  uno
                </v-tabs-window-item>

                <v-tabs-window-item :value="2">
                  dos
                </v-tabs-window-item>

                <v-tabs-window-item :value="3">
                  tres
                </v-tabs-window-item>

                <v-tabs-window-item :value="4">
                  cuatro
                </v-tabs-window-item>
              </v-tabs-window>
            </v-card-text>
          </v-card>
        </v-card-text>
        <v-container style="display: flex; align-items: center; justify-content: center; gap: 10%;">
          <v-btn style="width: 30%;" prepend-icon="mdi-plus" size="large" to="/planilla">
            Nuevo Registro
          </v-btn>
          <v-btn style="width: 30%;" prepend-icon="mdi-plus" size="large">
            Nueva Orden
          </v-btn>
        </v-container>
      </v-col>

      <v-col cols="2">
        <p>Aqui va el historial</p>
      </v-col>
    </v-row>
    
  </v-container>
</template>



<script>
import { ref, computed, onMounted } from 'vue';

import FilteredList from '@/components/index/FilteredList.vue';
import NotHistorial from '@/components/index/NotHistorial.vue';

const tab = ref(1);

</script>