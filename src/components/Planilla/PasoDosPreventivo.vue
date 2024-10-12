<template>
  <v-container>
    <v-card class="bg-surface-light pa-4">
      <v-row v-for="(grupo, periodo) in agrupadoPorPeriodo" :key="periodo">
        <v-col cols="1">
          <v-checkbox
            v-model="form.periodoSeleccionado" 
            :value="periodo" 
            @change="onCheckboxChange(periodo)"
          ></v-checkbox>
        </v-col>
        <v-col cols="3">
          <v-text-field :value="periodoTexto(periodo)" 
            readonly hide-details class="bg-blue-darken-4"/>
        </v-col>
        <v-col cols="8" class="pl-0">
          <v-expansion-panels>
            <v-expansion-panel class="mt-0"
              v-for="(componente, index) in grupo.componentes"
              :key="index"
              :title="componente.nombre"
              :text="componente.descripcion"
            />
          </v-expansion-panels>
        </v-col>
        <v-divider :thickness="5" class="border-opacity-100" color=""/>
      </v-row>
    </v-card>
  </v-container>
</template>

<script setup>
import { ref, computed, defineProps, onMounted } from 'vue';
import axios from 'axios';

const props = defineProps({
  valorID: {
    type: Number,
    required: true,
  },
  myIP: {
    type: String,
    required: true,
  },
  form: {
    type: Object,
    requiered: true,
  },
});

const componentesCorrectivo = ref([]);

const cargarComponentes = async () => {
  try {
    const response = await axios.get(`${props.myIP}/api/componentes?ubicacion[eq]=${props.valorID}`);
    componentesCorrectivo.value = response.data.data;
    console.log('componentes', componentesCorrectivo);
  } catch (error) {
    console.error('Error al cargar las máquinas:', error);
  }
};
onMounted(() => {
  cargarComponentes();
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

const agrupadoPorPeriodo = computed(() => {
  if (!componentesCorrectivo.value || componentesCorrectivo.value.length === 0) {
    return {};
  }
  const agrupado = componentesCorrectivo.value.reduce((acc, componente) => {
    const { periodo_mantenimiento } = componente;

    if (!acc[periodo_mantenimiento]) {
      acc[periodo_mantenimiento] = {
        componentes: []
      };
    }
    acc[periodo_mantenimiento].componentes.push(componente);

    return acc;
  }, {});
  return agrupado;
});

// Función para manejar el cambio de checkbox
const onCheckboxChange = (periodo) => {
  if (props.form.periodoSeleccionado === periodo) {
    props.form.periodoSeleccionado = periodo;
  } else {
    props.formperiodoSeleccionado = periodo;
  }
};
</script>