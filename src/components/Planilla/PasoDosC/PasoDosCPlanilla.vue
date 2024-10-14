<template>
  <v-form>
    <v-card class="pa-4 mx-2 mb-2">
      <v-row>
        <v-col v-for="(fila, n) in filas" :key="n" :cols="fila.size">
          <component
            v-if="fila.component.name !== 'VCheckbox'"
            :is="fila.component"
            v-model="form[fila.model]"
            v-bind="fila.props"
            hide-details
            density="compact"
            :disabled="getDisabled(fila)"
          />
          <component
            v-else-if="fila.component.name === 'VCheckbox'"
            :is="fila.component"
            v-model="form[fila.model]"
            v-bind="fila.props"
            hide-details
            :model-value="form[fila.model] === 1"
            @update:modelValue="(val) => form[fila.model] = val ? 1 : 0"
            density="compact"
            :disabled="getDisabled(fila)"
          >
            <!-- Mostrar el slot de label solo si el componente es VCheckbox -->
            <template v-if="fila.component.name === 'VCheckbox'" v-slot:label>
              {{ fila.text }}
            </template>
          </component>
        </v-col>
      </v-row>
    </v-card>
  </v-form>
</template>

<script setup>
import { defineProps } from 'vue';

const props = defineProps({
filas: {
  type: Array,
  required: true,
},
form: {
  type: Array,
  required: true,
},
});

// Función para determinar si un campo está deshabilitado
const getDisabled = (fila) => {
if (fila.model === 'observaciones') {
  return !props.form.seguimiento;
} 
return false;
};
</script>