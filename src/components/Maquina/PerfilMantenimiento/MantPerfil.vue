<template>
  <v-card class="bg-grey pa-4">
    <v-row v-for="(grupo, periodo) in agrupadoPorPeriodo" :key="periodo">
      <v-col cols="4">
        <v-text-field :value="periodoTexto(periodo)" 
          readonly hide-details class="bg-blue-darken-4"/>
        <v-text-field type="date" label="Último mat." v-model="grupo.ultimo_mantenimiento" 
          hide-details class="bg-grey-darken-4" disabled/>
        <v-text-field type="date" label="Próximo mat." v-model="grupo.proximo_mantenimiento" 
          hide-details class="bg-grey-darken-4" disabled/>
      </v-col>
      <v-col cols="8" class="pl-0">
        <v-expansion-panels>
          <v-expansion-panel class="mt-0"
            v-for="(componente, index) in grupo.componentes"
            :key="index"
            :title="componente.nombre"
            :text="componente.descripcion"
          />
        </v-expansion-panels>
      </v-col>
      <v-divider :thickness="5" class="border-opacity-100" color=""/>
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

const periodoTexto = (periodo) => {
  return periodosTextos[periodo] || 'Periodo no definido';
};

const agrupadoPorPeriodo = computed(() => {
  const hoy = new Date();
  const agrupado = props.maquinaComp.reduce((acc, componente) => {
    const { periodo_mantenimiento, ultimo_mantenimiento, proximo_mantenimiento } = componente;

    const fechaProximoMantenimiento = new Date(proximo_mantenimiento);
    const fechaUltimoMantenimiento = new Date(ultimo_mantenimiento);

    if (!acc[periodo_mantenimiento]) {
      acc[periodo_mantenimiento] = {
        componentes: [],
        ultimo_mantenimiento: null,
        proximo_mantenimiento: null,
        componenteSeleccionado: null
      };
    }

    acc[periodo_mantenimiento].componentes.push(componente);

    if (acc[periodo_mantenimiento].ultimo_mantenimiento === null || 
        fechaUltimoMantenimiento > new Date(acc[periodo_mantenimiento].ultimo_mantenimiento)) {
      acc[periodo_mantenimiento].ultimo_mantenimiento = ultimo_mantenimiento;
    }

    if (acc[periodo_mantenimiento].componenteSeleccionado === null || 
        (fechaProximoMantenimiento < new Date(acc[periodo_mantenimiento].componenteSeleccionado.proximo_mantenimiento))) 
    {
      acc[periodo_mantenimiento].componenteSeleccionado = componente;
      acc[periodo_mantenimiento].proximo_mantenimiento = proximo_mantenimiento;
    }

    return acc;
  }, {});
  return agrupado;
});

</script>
