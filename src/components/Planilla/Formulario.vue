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
            :hide-details="fila.ocultar"
            density="compact"
            :disabled="getDisabled(fila)"
          />
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
if (fila.model === 'modelo') {
  return !props.form.nombre;
} else if (fila.model === 'numero_de_serie') {
  return !props.form.nombre;
} 
return false;
};

</script>