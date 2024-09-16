<template>
  <v-col cols="8" class="pa-0">
    <v-card class="pa-4 mx-2 mb-2">
      <v-row>
        <v-col v-for="(fila, n) in filas" :key="n" :cols="fila.size">
          <!-- Clasificación 'objeto' -->
          <component
            v-if="fila.clasificacion === 'objeto' && fila.component.name !== 'VCheckbox'"
            :is="fila.component"
            v-model="localMaquina[fila.model]"
            v-bind="fila.props"
            :hide-details="fila.ocultar"
            :disabled="getDisabled(fila) || isDisabled(fila)"
            density="compact"
          />
          <component
            v-else-if="fila.clasificacion === 'objeto' && fila.component.name === 'VCheckbox'"
            :is="fila.component"
            v-model="localMaquina[fila.model]"
            v-bind="fila.props"
            :hide-details="fila.ocultar"
            :model-value="localMaquina[fila.model] === 1"
            @update:modelValue="(val) => localMaquina[fila.model] = val ? 1 : 0"
            :disabled="getDisabled(fila) || isDisabled(fila)"
            density="compact"
          >
            <!-- Mostrar el slot de label solo si el componente es VCheckbox -->
            <template v-if="fila.component.name === 'VCheckbox'" v-slot:label>
              {{ fila.text }}
            </template>
          </component>

          <!-- Clasificación 'array' -->
          <component
            v-else-if="fila.clasificacion === 'array' && fila.component.name !== 'VCheckbox' && localDetalles.length > 0"
            :is="fila.component"
            v-model="localDetalles[0][fila.model]"
            v-bind="fila.props"
            :hide-details="fila.ocultar"
            :disabled="getDisabled(fila) || isDisabled(fila)"
            density="compact"
          />
          <component
            v-else-if="fila.clasificacion === 'array' && fila.component.name === 'VCheckbox' && localDetalles.length > 0"
            :is="fila.component"
            v-model="localDetalles[0][fila.model]"
            v-bind="fila.props"
            :hide-details="fila.ocultar"
            :model-value="localDetalles[0][fila.model] === 1"
            @update:modelValue="(val) => localDetalles[0][fila.model] = val ? 1 : 0"
            :disabled="getDisabled(fila) || isDisabled(fila)"
            density="compact"
          >
            <!-- Mostrar el slot de label solo si el componente es VCheckbox -->
            <template v-if="fila.component.name === 'VCheckbox'" v-slot:label>
              {{ fila.text }}
            </template>
          </component>
        </v-col>
      </v-row>
    </v-card>
  </v-col>
</template>

<script setup>
import { ref } from 'vue';
import { VCheckbox, VTextField, VTextarea, VSelect } from 'vuetify/components';
import { defineProps } from 'vue';

// Recibimos las props desde el componente padre
const props = defineProps({
  filas: {
    type: Array,
    required: true,
  },
  localMaquina: {
    type: Object,
    required: true,
  },
  localDetalles: {
    type: Array,
    required: true,
  },
  isEditing: {
    type: Boolean,
    required: true,
  },
});

// Función para determinar si un campo está deshabilitado
const getDisabled = (fila) => {
  if (fila.model === 'garantia_cantidad') {
    return !props.localDetalles[0]?.garantia;
  } else if (fila.model === 'seguimiento') {
    return !props.localMaquina.en_seguimiento;
  }
  return false;
};
// Función para verificar si un campo está deshabilitado según el estado de edición
const isDisabled = () => {
  return !props.isEditing;
};
</script>
