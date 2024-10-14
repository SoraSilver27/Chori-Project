<template>
  <v-container class="bg-surface-light">
    <v-row>
      <v-col cols="6">
        {{ formularios_componentes }}
        <PasoDosCPlanilla
          :form="form"
          :filas="filas"
        />
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
                <ControlComponente 
                  :componentes="componentes"
                  :form="form"
                />
              </v-tabs-window-item>

              <v-tabs-window-item :value="2">
                dos
              </v-tabs-window-item>

            </v-tabs-window>
          </v-card-text>

          <v-card-actions>

            <div v-if="tab === 1">
              <v-dialog v-model="dialog" max-width="1300">
                <template v-slot:activator="{ props: activatorProps }">
                  <v-btn v-if="formularios_componentes.length < form.componentes_correct.length" 
                    v-bind="activatorProps"
                    text="Comenzar Registro"
                    color="primary">
                  </v-btn>
                </template>
                <template v-slot:default> 
                  <ComenzarRegistro
                    :form="form"
                    :formLocal="formLocal"
                    :formularios_componentes="formularios_componentes"
                    :filasDos="filasDos"
                    v-model:dialog="dialog"
                    @update:dialog="dialog = $event"
                    @update:formularios="formularios_componentes = $event"
                  />
                </template>
              </v-dialog>



              <v-dialog v-model="dialogRevisar" max-width="1000">
                <template v-slot:activator="{ props: activatorProps }">
                  <v-btn v-if="formularios_componentes.length > 0" v-bind="activatorProps"
                    text="Revisar Registro"
                    prepend-icon="mdi-eye"
                    color="secondary">
                  </v-btn>
                </template>
                <template v-slot:default>
                  <RevisarRegistro
                    :form="formLocal"
                    :formularios_componentes="formularios_componentes"
                    :filasDos="filasDos"
                    v-model:dialogRevisar="dialogRevisar"
                    @update:dialogRevisar="dialogRevisar = $event"
                  />
                </template>
              </v-dialog>



            </div>

            <div v-else-if="tab === 2">
              <v-btn color="blue">Buscar</v-btn>
            </div>
            
          </v-card-actions>

        </v-card>
      </v-col>
    </v-row>
  </v-container>

</template>

<script setup>
import { ref, defineProps, onMounted } from 'vue';
import { VCheckbox, VSelect, VTextarea, VTextField, VRadio } from 'vuetify/components';
import axios from 'axios';
import PasoDosCPlanilla from './PasoDosC/PasoDosCPlanilla.vue';
import ControlComponente from './PasoDosC/ControlComponente.vue';
import ComenzarRegistro from './PasoDosC/ComenzarRegistro.vue';
import RevisarRegistro from './PasoDosC/RevisarRegistro.vue';

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
const formularios_componentes = ref([]);
const dialog = ref(false);
const dialogRevisar = ref(false);

const formLocal = ref({
  id: null,
  nombre: '',
  numero_serie: '',
  modelo: '',
  problema_detectado: '',
  solucion_encontrada: '',
  actividad_realizada: '',
  reemplazado: false,
  re_nombre: '',
  re_modelo: '',
  re_numero_serie: '',
});

const filasDos = [
  {tipo: 'dato', model: 'nombre', component: VTextField, size: 4, props: { label: 'Nombre' } },
  {tipo: 'dato', model: 'numero_serie', component: VTextField, size: 4, props: { label: 'Identificador' } },
  {tipo: 'dato', model: 'modelo', component: VTextField, size: 4, props: { label: 'Modelo' } },
  {tipo: 'nuevo', model: 'problema_detectado', component: VTextarea, size: 12, props: { label: 'Problema detectado', rows: 1 } },
  {tipo: 'nuevo', model: 'solucion_encontrada', component: VTextarea, size: 12, props: { label: 'Solucion encontrada', rows: 1 } },
  {tipo: 'nuevo', model: 'actividad_realizada', component: VTextarea, size: 12, props: { label: 'Actividad realizada', rows: 1 } },
  {tipo: 'check', model: 'reemplazo', component: VCheckbox, size: 12, text: 'Reemplazado por:' },
  {tipo: 'nuevo', model: 're_nombre', component: VTextField, size: 4, props: { label: 'Nombre' } },
  {tipo: 'nuevo', model: 're_modelo', component: VTextField, size: 4, props: { label: 'Modelo' } },
  {tipo: 'nuevo', model: 're_numero_serie', component: VTextField, size: 4, props: { label: 'Identificador' } },
];

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

// Debo verificar si quiero enviar a BD desde aqui los formularios_componentes
// O pasarlo a NuevaPlanilla y gestionar desde alli
</script>