<template>
  <v-card class="pa-4 mx-2 mb-2">
    <v-row>
      <v-col v-for="(fila, n) in filas" :key="n" :cols="fila.size">
        <!-- Clasificación 'objeto' -->
        <component
          v-if="fila.component.name !== 'VCheckbox'"
          :is="fila.component"
          v-model="localComponente[fila.model]"
          v-bind="fila.props"
          :hide-details="fila.ocultar"
          :disabled="isDisabled(fila)"
          density="compact"
        />
        <component
          v-else-if="fila.component.name === 'VCheckbox'"
          :is="fila.component"
          v-model="localComponente[fila.model]"
          v-bind="fila.props"
          :hide-details="fila.ocultar"
          :model-value="localMaquina[fila.model] === 1"
          @update:modelValue="(val) => localMaquina[fila.model] = val ? 1 : 0"
          :disabled="isDisabled(fila)"
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
</template>

<script setup>
import { VCheckbox, VTextField, VTextarea, VSelect } from 'vuetify/components';
import { defineProps } from 'vue';

// Recibimos las props desde el componente padre
const props = defineProps({
filas: {
  type: Array,
  required: true,
},
localComponente: {
  type: Object,
  required: true,
},
isEditing: {
  type: Boolean,
  required: true,
},
});

// Función para determinar si un campo está deshabilitado
// const getDisabled = (fila) => {
// if (fila.model === 'garantia_cantidad') {
//   return !props.localComponente.garantia;
// } else if (fila.model === 'seguimiento') {
//   return !props.localComponente.en_seguimiento;
// }
// return false;
// };
// Función para verificar si un campo está deshabilitado según el estado de edición
const isDisabled = () => {
return !props.isEditing;
};
</script>