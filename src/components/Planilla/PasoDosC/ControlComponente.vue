<template>
  <v-form>
    <v-data-table
      :headers="headers"
      :items="componentes"
      item-key="id"
      class="elevation-1"
    >
      <template v-slot:item.seleccionar="{ item }">
        <v-checkbox
          v-model="seleccionados[item.id]"
       
          :value="item.id"
        ></v-checkbox>
      </template>
    </v-data-table>
  </v-form>
</template>

<script setup>
import { ref, defineProps, watch } from 'vue';

const props = defineProps({
componentes: {
  type: Array,
  required: true,
},
form: {
  type: Object,
  required: true,
},
});

const headers = [
  { title: 'Correccion', align: 'start', value: 'seleccionar', sortable: false },
  { title: 'Nombre', align: 'start', value: 'nombre' },
  { title: 'Modelo', value: 'modelo' },
  { title: 'Número de Serie', value: 'numero_de_serie' },
];


// Mapa para almacenar el estado de selección de cada componente
const seleccionados = ref({});

// Rellenar el estado inicial de seleccionados si ya hay elementos en componentesSeleccionados
props.form.componentes_correct.forEach((comp) => {
  seleccionados.value[comp.id] = true;
});

// Watch para mantener sincronizados `componentesSeleccionados` con `seleccionados`
watch(
  seleccionados,
  (nuevoSeleccionados) => {
    // Filtramos componentes que están seleccionados
    const seleccionadosIds = Object.keys(nuevoSeleccionados).filter(
      (id) => nuevoSeleccionados[id]
    );

    // Actualizamos componentesSeleccionados con los componentes seleccionados
    props.form.componentes_correct.length = 0; // Limpiamos el array original
    seleccionadosIds.forEach((id) => {
      const componente = props.componentes.find((comp) => comp.id === parseInt(id));
      if (componente) {
        props.form.componentes_correct.push(componente);
      }
    });
  },
  { deep: true, immediate: true }
);

// Sincronizar el estado del mapa `seleccionados` cuando cambie `componentes`
watch(
  () => props.componentes,
  (newComponentes) => {
    newComponentes.forEach((comp) => {
      if (!seleccionados.value.hasOwnProperty(comp.id)) {
        seleccionados.value[comp.id] = false;
      }
    });
  },
  { immediate: true }
);

</script>
