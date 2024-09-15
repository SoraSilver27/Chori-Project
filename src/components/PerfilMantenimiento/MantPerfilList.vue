<template>
  <v-container class="pa-0">
    <v-row no-gutters v-for="(horasArray, periodo) in agrupadoPorPeriodo" :key="periodo" class="pa-1">
      <v-card class="bg-teal">
        <v-row class="pa-1">
          <v-col cols="1" class="pr-1">
            <v-sheet class="pa-2 d-flex align-center fill-height">
              {{ periodo }}
            </v-sheet>
          </v-col>
          <v-divider vertical class="border-opacity-25" color="info"></v-divider>
          <v-col cols="9" class="px-1">
            <v-row no-gutters v-for="horaObj in horasArray" :key="horaObj.horasUso">
              <v-col cols="1">
                <v-sheet class="pa-2 d-flex align-center fill-height">
                  {{ horaObj.horasUso }} horas
                </v-sheet>
              </v-col>
              <v-divider vertical class="border-opacity-25" color="info"></v-divider>
              <v-col cols="11">
                <v-row no-gutters v-for="nombre in horaObj.nombres" :key="nombre">
                  <v-col cols="4">
                    <v-sheet class="pa-2 fill-height">
                      {{ nombre }}
                    </v-sheet>
                  </v-col>
                  <v-divider vertical class="border-opacity-25" color="info"></v-divider>
                  <v-col cols="8">
                    <v-sheet class="pa-2 d-flex align-center fill-height">
                      {{ getDescripcion(nombre) }}
                    </v-sheet>
                  </v-col>
                  <v-divider class="border-opacity-25" color="info"></v-divider>
                </v-row>
              </v-col>
              <v-divider class="border-opacity-25" color="info"></v-divider>
            </v-row>
          </v-col>
          <v-divider vertical class="border-opacity-25" color="info"></v-divider>
          <v-col cols="2" class="pl-1">
            <v-text-field density="compact" type="date" label="Ultimo Mant." hide-details="auto" class="bg-secondary"></v-text-field>
            <v-text-field density="compact" type="date" label="Proximo Mant." hide-details="auto" class="bg-error"></v-text-field>
          </v-col>
          <v-divider class="border-opacity-25" color="info"></v-divider>
        </v-row>
      </v-card>
    </v-row>
  </v-container>
</template>

<script setup>
import { computed, defineProps } from 'vue';

const props = defineProps({
  componentesMaquina: {
    type: Object,
    required: true,
  },
});

// const componentesMaquina = ref([]);

// const agrupadoPorPeriodo = computed(() => {
//   const agrupado = componentesMaquina.value.reduce((acc, componente) => {
//     const { periodo, horasUso, nombre } = componente;
//     if (!acc[periodo]) {
//       acc[periodo] = [];
//     }
//     let entry = acc[periodo].find(item => item.horasUso === horasUso);
//     if (entry) {
//       entry.nombres.push(nombre);
//     } else {
//       acc[periodo].push({
//         horasUso: horasUso,
//         nombres: [nombre]
//       });
//     }
//     return acc;
//   }, {});

//   for (const key in agrupado) {
//     agrupado[key].sort((a, b) => a.horasUso - b.horasUso);
//   }
//   return agrupado;
// });

// function getDescripcion(nombre) {
//   const componente = componentesMaquina.value.find(c => c.nombre === nombre);
//   return componente ? componente.descripcion : '';
// }


</script>
