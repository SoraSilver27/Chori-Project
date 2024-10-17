<template>
  <v-container class="bg-surface-light">
    <v-row>
      <v-col cols="6">
        <v-card>
          {{ proximo_mantenimiento }}

          <v-card-title>Proximo mantenimiento</v-card-title>
          <v-card-text>
            <v-divider thickness="3" color="blue" class="pb-5" opacity="3"></v-divider>
            <h3>El proximo mantenimiento {{ periodoElegidoTexto }} sera el:</h3>
            <v-col class="pa-0" cols="5">
              <v-text-field
                v-model="proximo_mantenimiento"
                type="date"
                readonly
              />
            </v-col>
            <v-divider thickness="3" color="blue" class="pb-5" opacity="3"></v-divider>
            <v-textarea
              v-model="formDos.observacion_final"
              label="Observacion final"
              rows="3"
            />
          </v-card-text>
        </v-card>
      </v-col>
      <v-col cols="6">
        <v-card>
          <v-card-title>Repuestos utilizados:</v-card-title>
          <v-card-text>Aqui va la tabla</v-card-text>
          <v-card-actions>
            <v-btn prepend-icon="mdi-plus" color="blue">Buscar</v-btn>
          </v-card-actions>
        </v-card>
      </v-col>
    </v-row>
  </v-container>
</template>

<script setup>
import { ref, computed, defineProps, watch } from 'vue';
import { addDays, format } from 'date-fns';

const props = defineProps({
  form: {
    type: Object,
    required: true,
  },
  formDos: {
    type: Object,
    required: true,
  }
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

// Computed para que se actualice automáticamente cuando props.form.periodoSeleccionado cambie
const periodoElegidoTexto = computed(() => {
  return periodoTexto(props.formDos.periodoSeleccionado);
});

const proximo_mantenimiento = ref('');

// Función para calcular la fecha del próximo mantenimiento
const calcularProximoMantenimiento = () => {
  const fechaMantenimiento = props.form.fecha_mantenimiento
    ? new Date(props.form.fecha_mantenimiento + 'T00:00:00Z')
    : new Date(); // Si fecha_mantenimiento está vacía, toma la fecha actual

  // Verifica si fechaMantenimiento es una fecha válida
  if (isNaN(fechaMantenimiento.getTime())) {
    console.error('La fecha de mantenimiento no es válida:', fechaMantenimiento);
    return;
  }

  console.log('fecha de hoy', fechaMantenimiento);
  const diasPeriodo = props.formDos.periodoSeleccionado || 0;
  // Cálculo manual de la fecha sumando los días
  const proximaFecha = new Date(
    fechaMantenimiento.getUTCFullYear(),
    fechaMantenimiento.getUTCMonth(),
    fechaMantenimiento.getUTCDate() + diasPeriodo
  );
  console.log('periodo', diasPeriodo);
  console.log('prox fecha', proximaFecha);

  // Formatea la fecha en un formato adecuado (yyyy-MM-dd) para mostrar en el input de tipo "date"
  proximo_mantenimiento.value = format(proximaFecha, 'yyyy-MM-dd');
};

// Watch para actualizar automáticamente el valor cuando cambie el periodo o la fecha de mantenimiento
watch(
  () => [props.form.fecha_mantenimiento, props.formDos.periodoSeleccionado],
  calcularProximoMantenimiento,
  { immediate: true } // Se ejecuta inmediatamente para calcular el valor inicial
);
</script>