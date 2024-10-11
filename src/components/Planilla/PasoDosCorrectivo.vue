<template>
  <v-container class="bg-surface-light">
    <v-row>
      <v-col cols="6">
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
      </v-col>
      <v-col cols="6">
        <v-card>
          <v-tabs v-model="tab" fixed-tabs color="primary">
            <v-tab :value="1" prepend-icon="mdi-alert">Control de componentes</v-tab>
            <v-tab :value="2" prepend-icon="mdi-message-text">Repuestos utilizados</v-tab>
          </v-tabs>

          <v-card-text class="pa-2" style="overflow: auto; width: auto; height: 67vh;">
            <v-tabs-window v-model="tab">

              <v-tabs-window-item :value="1">
                <ControlComponente :componentes="componentes"/>
              </v-tabs-window-item>

              <v-tabs-window-item :value="2">
                dos
              </v-tabs-window-item>

            </v-tabs-window>
          </v-card-text>

          <v-card-actions>
            <v-btn v-if="tab === 1" color="blue">Comenzar regtistros</v-btn>
            <v-btn v-else-if="tab === 2" color="blue">Buscar</v-btn>
          </v-card-actions>

        </v-card>
      </v-col>
    </v-row>
  </v-container>

</template>

<script setup>
import { ref, defineProps, onMounted } from 'vue';
import axios from 'axios';
import ControlComponente from './PasoDosC/ControlComponente.vue';

const props = defineProps({
filas: {
  type: Array,
  required: true,
},
form: {
  type: Array,
  required: true,
},
valorID: {
  type: Number,
  required: true,
},
myIP: {
  type: String,
  required: true,
},
});

const tab = ref(1);
const componentes = ref([]);

// Función para determinar si un campo está deshabilitado
const getDisabled = (fila) => {
if (fila.model === 'observaciones') {
  return !props.form.seguimiento;
} 
return false;
};

const cargarComponentes = async () => {
  try {
    const response = await axios.get(`${props.myIP}/api/componentes?ubicacion[eq]=${props.valorID}`);
    componentes.value = response.data.data;
    console.log('componentes', componentes);
  } catch (error) {
    console.error('Error al cargar las máquinas:', error);
  }
};
onMounted(() => {
  cargarComponentes();
});
</script>