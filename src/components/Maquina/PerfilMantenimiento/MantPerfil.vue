<template>
  <v-card class="bg-grey pa-4">
    <!-- Recorre cada grupo de periodos -->
    <v-row v-for="(grupo, periodo) in agrupadoPorPeriodo" :key="periodo">
      <v-col cols="4">
        <!-- Muestra el periodo -->
        <v-text-field :value="periodoTexto(periodo)" readonly hide-details class="bg-blue-darken-4"></v-text-field>
        <v-text-field type="date" label="Último mat." v-model="grupo.ultimo" hide-details class="bg-grey-darken-4" disabled></v-text-field>
        <v-text-field type="date" label="Próximo mat." v-model="grupo.proximo" hide-details class="bg-grey-darken-4" disabled></v-text-field>
      </v-col>
      <v-col cols="8" class="pl-0">
        <!-- Muestra los componentes asociados al periodo actual -->
        <v-expansion-panels>
          <v-expansion-panel class="mt-0"
            v-for="(componente, index) in grupo.componentes"
            :key="index"
            :title="componente.nombre"
            :text="componente.descripcion"
          >
          </v-expansion-panel>
        </v-expansion-panels>
      </v-col>
      <v-divider :thickness="5" class="border-opacity-100" color=""></v-divider>
    </v-row>
  </v-card>
</template>

<script setup>
import { computed } from 'vue';

const props = defineProps({
  componentesMaquina: {
    type: Array,
    required: true,
  },
  localMaquinaComp: {
    type: Object, 
    required: true,
  },
});


const periodosTextos = {
  7: 'Semanal',
  15: 'Quincenal',
  30: 'Mensual',
  60: 'Bimestral',
  90: 'Trimestral',
  180: 'Semestral',
  360: 'Anual',
  720: 'Bienal',
};

// Función que devuelve el texto correspondiente al periodo
const periodoTexto = (periodo) => {
  return periodosTextos[periodo] || 'Periodo no definido';
};

// Computed que agrupa los componentes por el campo "periodo"
const agrupadoPorPeriodo = computed(() => {
  const agrupado = props.componentesMaquina.reduce((acc, componente) => {
    const { periodo, ultimo, proximo } = componente;

    // Si no existe el grupo para este periodo, lo creamos
    if (!acc[periodo]) {
      acc[periodo] = {
        componentes: [],
        // Guardamos las primeras fechas encontradas
        ultimo,
        proximo,
      };
    }

    // Añadimos el componente a la lista del periodo
    acc[periodo].componentes.push(componente);
    return acc;
  }, {});

  return agrupado;
});
</script>
