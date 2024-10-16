<template>
  <v-container class="bg-surface-light">
    <v-row>
      <v-col cols="6">
        <v-card>
          <v-card-title>Proximo mantenimiento</v-card-title>
          <v-card-text>
            <v-divider thickness="3" color="blue" class="pb-5" opacity="3"></v-divider>
            <h3>El proximo mantenimiento {{ periodoElegidoTexto }} sera el:</h3>
            <v-col class="pa-0" cols="5">
              <v-text-field
                v-model="proximo_mantenimiento"
                type="date"
              />
            </v-col>
            <v-divider thickness="3" color="blue" class="pb-5" opacity="3"></v-divider>
            <v-textarea
              v-model="observacion_final"
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
import { ref, computed, defineProps } from 'vue';

const props = defineProps({
  form: {
    type: Object,
    requiered: true,
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

// Computed para que se actualice automáticamente cuando props.form.periodoSeleccionado cambie
const periodoElegidoTexto = computed(() => {
  return periodoTexto(props.form.periodoSeleccionado);
});
</script>