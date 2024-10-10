<template>
  <v-form>
    <v-card class="px-4 pt-5 mx-2">
      <v-row>
        <v-col v-for="(fila, n) in filas" :key="n" :cols="fila.size">
          <v-radio-group v-model="form.tipoMantenimiento" row>
            <component
              v-if="fila.component.name === 'VRadio'"
              :is="fila.component"
              :value="fila.value"
              v-bind="fila.props"
              :hide-details="fila.ocultar"
              density="compact"
              :disabled="getDisabled(fila)"
            />
            <component
              v-else-if="fila.component.name !== 'VRadio'"
              :is="fila.component"
              v-model="form[fila.model]"
              v-bind="fila.props"
              :hide-details="fila.ocultar"
              density="compact"
              :disabled="getDisabled(fila)"
            />
          </v-radio-group>
        </v-col>
      </v-row>
    </v-card>
  </v-form>
</template>

<script setup>
import { ref, defineProps } from 'vue';

const props = defineProps({
filas: {
  type: Array,
  required: true,
},
form: {
  type: Array,
  required: true,
}
});

// Función para determinar si un campo está deshabilitado
const getDisabled = (fila) => {
if (fila.model === 'aclaracion') {
  return props.form.tipoMantenimiento !== 'otro';
}
return false;
};
</script>

