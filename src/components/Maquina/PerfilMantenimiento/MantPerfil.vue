<template>
  <v-card class="bg-grey pa-4">
    <!-- Recorre cada grupo de periodos -->
    <v-row v-for="(grupo, periodo) in agrupadoPorPeriodo" :key="periodo">
      <v-col cols="4">
        <!-- Muestra el periodo -->
        <v-text-field :value="periodoTexto(periodo)" readonly hide-details class="bg-blue-darken-4"></v-text-field>
        <v-text-field type="date" label="Último mat." v-model="grupo.ultimo_mantenimiento" hide-details class="bg-grey-darken-4" disabled></v-text-field>
        <v-text-field type="date" label="Próximo mat." v-model="grupo.proximo_mantenimiento" hide-details class="bg-grey-darken-4" disabled></v-text-field>
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
import { computed, defineProps } from 'vue';

const props = defineProps({
  maquinaComp: {
    type: Array,
    required: true,
  },
});

const periodosTextos = {
  0: 'Sin mantenimiento',
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
  const hoy = new Date(); // Obtenemos la fecha actual
  const agrupado = props.maquinaComp.reduce((acc, componente) => {
    const { periodo_mantenimiento, ultimo_mantenimiento, proximo_mantenimiento } = componente;

    // Convertir las fechas a objetos Date para compararlas
    const fechaProximoMantenimiento = new Date(proximo_mantenimiento);
    const fechaUltimoMantenimiento = new Date(ultimo_mantenimiento);

    // Si no existe el grupo para este periodo, lo creamos
    if (!acc[periodo_mantenimiento]) {
      acc[periodo_mantenimiento] = {
        componentes: [],
        ultimo_mantenimiento: null,
        proximo_mantenimiento: null,
        componenteSeleccionado: null // Inicialmente no hay componente seleccionado
      };
    }

    // Añadimos el componente a la lista del periodo
    acc[periodo_mantenimiento].componentes.push(componente);

    // Comparar la fecha de último mantenimiento de este componente con el último mantenimiento seleccionado
    if (acc[periodo_mantenimiento].ultimo_mantenimiento === null || 
        fechaUltimoMantenimiento > new Date(acc[periodo_mantenimiento].ultimo_mantenimiento)) {
      // Si es el primero o es más reciente, actualizamos
      acc[periodo_mantenimiento].ultimo_mantenimiento = ultimo_mantenimiento;
    }

    // Comparar la fecha de próximo mantenimiento de este componente con el componente seleccionado
    if (acc[periodo_mantenimiento].componenteSeleccionado === null || 
        (fechaProximoMantenimiento < new Date(acc[periodo_mantenimiento].componenteSeleccionado.proximo_mantenimiento))) 
    {
      // Si es el primero o es más cercano a la fecha actual, lo seleccionamos
      acc[periodo_mantenimiento].componenteSeleccionado = componente;
      acc[periodo_mantenimiento].proximo_mantenimiento = proximo_mantenimiento;
    }

    return acc;
  }, {});

  return agrupado;
});

</script>
