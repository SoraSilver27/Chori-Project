<template>
  <v-card-text class="pt-5">
    <v-card>
      <v-row>
        <v-col cols="10">
          <v-tabs v-model="tab" fixed-tabs color="primary">
            <v-tab :value="1" prepend-icon="mdi-alert">Paso 1</v-tab>
            <v-tab v-if="visibleTab2" :value="2" prepend-icon="mdi-message-text">Paso 2</v-tab>
            <v-tab v-if="visibleTab3" :value="3" prepend-icon="mdi-tools">Paso 3</v-tab>
          </v-tabs>
        </v-col>
        <v-col>
          <v-container>
            <h3>ID: {{ idMaquina }}</h3>
          </v-container>
        </v-col>
      </v-row>
      <v-card-text class="pa-2" style="overflow: auto; width: auto; height: 85vh;">
        <v-tabs-window v-model="tab">

          <v-tabs-window-item :value="1">
            <v-container class="bg-surface-light">
              <v-card-title>Nuevo registro de Mantenimiento</v-card-title>
              <v-row>
                <v-col cols="7">
                  <Formulario :filas="filasUno" :form="form" />
                </v-col>
                <v-col>
                  <Formulario :filas="filasTres" :form="form" />
                </v-col>
              </v-row>
              <v-card-title>Tipo de Mantenimiento</v-card-title>
              <FormularioDos :filas="filasDos" :form="form" />
            </v-container>
            <v-container style="display: flex; align-items: center; justify-content: center; gap: 50%;">
              <v-btn style="width: 20%;" size="large" color="blue" to="/">Cancelar</v-btn>
              <v-btn style="width: 20%;" size="large" color="blue" @click="goToStep2">Siguiente</v-btn>
            </v-container>
          </v-tabs-window-item>

          <v-tabs-window-item :value="2">
            <PasoDosCorrectivo v-if="form.tipoMantenimiento !== 'preventivo'"
              :valorID="idMaquina"
              :form="formDos"
              :filas="filasParteDos"
              :myIP="myIP"
            />
            <PasoDosPreventivo v-else
              :valorID="idMaquina"
              :myIP="myIP"
              :form="form"
            />
            <v-container style="display: flex; align-items: center; justify-content: center; gap: 50%;">
              <v-btn style="width: 20%;" size="large" color="blue" @click="goToStep1">Volver</v-btn>
              <v-btn style="width: 20%;" size="large" color="blue" @click="goToStep3">Siguiente</v-btn>
            </v-container>
          </v-tabs-window-item>

          <v-tabs-window-item :value="3">
            <PasoTres/>
            <v-container style="display: flex; align-items: center; justify-content: center; gap: 50%;">
              <v-btn style="width: 20%;" size="large" color="blue" @click="goToStep2">Volver</v-btn>
              <v-btn style="width: 20%;" size="large" color="blue" >Guardar</v-btn>
            </v-container>
          </v-tabs-window-item>
        </v-tabs-window>
      </v-card-text>
    </v-card>
  </v-card-text>
</template>

<script setup>
import { ref, onMounted, computed } from 'vue';
import axios from 'axios';
import { direccionIP } from '@/global';
import { VCheckbox, VSelect, VTextarea, VTextField, VRadio } from 'vuetify/components';
import Formulario from '@/components/Planilla/Formulario.vue';
import FormularioDos from '@/components/Planilla/FormularioDos.vue';
import PasoDosCorrectivo from '@/components/Planilla/PasoDosCorrectivo.vue';
import PasoDosPreventivo from '@/components/Planilla/PasoDosPreventivo.vue';
import PasoTres from '@/components/Planilla/PasoTres.vue';

const myIP = direccionIP;
const tab = ref(1);
const visibleTab2 = ref(false);
const visibleTab3 = ref(false);
const maquinas = ref([]);
const nombres = ref([]);
const seriesFiltradas = computed(() => {
  return maquinas.value
    .filter((maquina) => maquina.nombre === form.value.nombre)
    .filter((maquina) => form.value.modelo ? maquina.modelo === form.value.modelo : true)
    .map((maquina) => maquina.numero_de_serie);
});
const modelosFiltrados = computed(() => {
  return maquinas.value
    .filter((maquina) => maquina.nombre === form.value.nombre)
    .filter((maquina) => form.value.numero_de_serie ? maquina.numero_de_serie === form.value.numero_de_serie : true)
    .map((maquina) => maquina.modelo);
});
// Computed property para la ID de la máquina seleccionada
const idMaquina = computed(() => {
  const { nombre, numero_de_serie, modelo } = form.value;
  if (!nombre) {
    return 'No encontrada';
  }
  const coincidencias = maquinas.value.filter((maquina) => {
    const coincideNombre = maquina.nombre === nombre;
    const coincideSerie = numero_de_serie ? maquina.numero_de_serie === numero_de_serie : true;
    const coincideModelo = modelo ? maquina.modelo === modelo : true;

    return coincideNombre && coincideSerie && coincideModelo;
  });

  if (coincidencias.length === 1) {
    const id = coincidencias[0].id;
    console.log('Valor de id', id)
    // Verificamos que id sea un número
    if (typeof id === 'number') {
      return id;

    }
  } else {
    return 'No encontrada';
  }
});

// Función para cargar las máquinas desde la API
const cargarMaquinas = async () => {
  try {
    const response = await axios.get(`${myIP}/api/maquinarias`);
    maquinas.value = response.data.data;
    nombres.value = [...new Set(maquinas.value.map((maquina) => maquina.nombre))];
    console.log('maquinas', maquinas)
  } catch (error) {
    console.error('Error al cargar las máquinas:', error);
  }
};

// Llama a la función cargarMaquinas cuando el componente se monta
onMounted(() => {
  cargarMaquinas();
});

const form = ref({
  nombre: null,
  numero_de_serie: null,
  modelo: null,
  ultimo_mantenimiento: '',
  encargado: null,
  telefono: '',
  tipoMantenimiento: null,
  aclaracion: '',
  periodoSeleccionado: null,
});
const formDos = ref({
  problema_detectado: '',
  solucion_encontrada: '',
  actividad_realizada: '',
  tercerizacion: false,
  seguimiento: false,
  observaciones: '',
  repuestos_utilizados: [],
  componentes_correct: [],
});
const formularios_enviar = ref([]);

const filasUno = ref([
  {model: 'nombre', component: VSelect, size: 8, props: { label: 'Nombre', items: nombres, } },
  {model: 'numero_de_serie', component: VSelect, size: 4, props: { label: 'Identificador', items: seriesFiltradas, } },
  {model: 'modelo', component: VSelect, size: 4, props: { label: 'Modelo', items: modelosFiltrados, } },
  {model: 'ultimo_mantenimiento', component: VTextField, size: 4, props: { label: 'Fecha', type: 'date' } },
]);
const filasDos = [
  {model: 'tipoMantenimiento', component: VRadio, value: 'preventivo', size: 2, props: { label: 'Preventivo' }, },
  {model: 'tipoMantenimiento', component: VRadio, value: 'correctivo', size: 2, props: { label: 'Correctivo' }, },
  {model: 'tipoMantenimiento', component: VRadio, value: 'otro', size: 1, props: { label: 'Otro' }, },
  {model: 'aclaracion', component: VTextarea, size: 5, ocultar: 'auto', props: { label: 'Aclarar', rows: 1 }, },
];
const filasTres = [
  {model: 'encargado', component: VSelect, size: 10, props: { label: 'Encargado' }, },
  {model: 'telefono', component: VTextField, size: 10, props: { label: 'Telefono' }, },
];
const filasParteDos = [
  {model: 'problema_detectado', component: VTextarea, size: 12, props: { label: 'Problemas Detectados', rows: 2 } },
  {model: 'solucion_encontrada', component: VTextarea, size: 12, props: { label: 'Solucion Encontrada', rows: 2 } },
  {model: 'actividad_realizada', component: VTextarea, size: 12, props: { label: 'Actividad Realizada', rows: 2 } },
  {model: 'tercerizacion', component: VCheckbox, size: 12, text: 'Se requirio tercerizacion' },
  {model: 'seguimiento', component: VCheckbox, size: 12, text: 'Amerita seguimiento' },
  {model: 'observaciones', component: VTextarea, size: 12, props: { label: 'Observaciones', rows: 2 } },
];

const goToStep1 = () => {
  tab.value = 1;
};
const goToStep2 = () => {
  if (idMaquina.value === 'No encontrada') {
    alert('Maquina o componente no encontrado');
  } else if (form.value.tipoMantenimiento === null) {
    alert('Por favor, seleccione un tipo de mantenimiento')
  } else {
    visibleTab2.value = true;
    tab.value = 2;
  }
};
const goToStep3 = () => {
  if (form.value.periodoSeleccionado !== null && form.value.periodoSeleccionado !== false) {
    visibleTab3.value = true;
    tab.value = 3;
  } else {
    alert('Por favor, seleccione uno de los mantenimientos')
  }
};
</script> 