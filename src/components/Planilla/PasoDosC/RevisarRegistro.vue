<template>
  <v-form>
    <v-card class="pa-4">
      <v-card-title>Control de componentes</v-card-title>
      <v-card-text>
        <v-row>
          <v-col v-for="(fila, n) in filasDos" :key="n" :cols="fila.size">
            <component
              v-if="fila.component.name !== 'VCheckbox'"
              :is="fila.component"
              v-model="formularios_componentes[currentIndexRevisar][fila.model]"
              v-bind="fila.props"
              hide-details
              density="compact"
            />
            <component
              v-else-if="fila.component.name === 'VCheckbox'"
              :is="fila.component"
              v-model="formularios_componentes[currentIndexRevisar][fila.model]"
              v-bind="fila.props"
              hide-details
              :model-value="formularios_componentes[currentIndexRevisar][fila.model] === 1"
              @update:modelValue="(val) => formularios_componentes[currentIndexRevisar][fila.model] = val ? 1 : 0"
              density="compact"
            >
              <!-- Mostrar el slot de label solo si el componente es VCheckbox -->
              <template v-if="fila.component.name === 'VCheckbox'" v-slot:label>
                {{ fila.text }}
              </template>
            </component>
          </v-col>
        </v-row>
      </v-card-text>
      <v-card-actions>
        <v-btn @click="closeDialog" color="green">Cancelar</v-btn>
        <v-btn v-if="currentIndexRevisar > 0" @click="handleAnteriorRevisar" color="blue">Anterior</v-btn>
        <v-btn v-if="currentIndexRevisar < formularios_componentes.length - 1" @click="handleSiguienteRevisar" color="blue">Siguiente</v-btn>
      </v-card-actions>
    </v-card>
  </v-form>
</template>

<script setup>
import { ref, defineProps, computed, defineEmits } from 'vue';

const props = defineProps({
  form: {
    type: Object,
    required: true,
  },
  dialog: {
    type: Boolean,
    required: true,
  },
  formularios_componentes: {
    type: Object,
    required: true,
  },
  filasDos: {
    type: Array,
    required: true,
  }
});

// Index para rastrear en cuál estamos
const currentIndexRevisar = ref(0);
const emit = defineEmits(['update:dialogRevisar']);

const handleSiguienteRevisar = () => {
  if (props.formularios_componentes[currentIndexRevisar.value + 1]) {
    currentIndexRevisar.value++;
  } else {
    console.log('No hay mas elementos en formularios');
    console.log('Revisar', currentIndexRevisar.value);
  }
}
const handleAnteriorRevisar = () => {
  if (props.formularios_componentes[currentIndexRevisar.value - 1]) {
    currentIndexRevisar.value--;
  } else {
    console.log('No hay mas elementos en formularios');
    console.log('Revisar', currentIndexRevisar.value);
  }
}

// Función para cerrar el diálogo manualmente
const closeDialog = () => {
  emit('update:dialogRevisar', false);
};

</script>