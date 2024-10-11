<template>
  <v-form>
    <v-data-table
      :headers="headers"
      :items="componentes"
      item-key="id"
      class="elevation-1"
    >
          <!-- Checkbox para selección -->
      <template v-slot:item.seleccionar="{ item }">
        <v-checkbox
          v-model="item.seleccionado"
          @change="toggleSeleccionado(item)"
          :value="item.id"
        ></v-checkbox>
      </template>
    </v-data-table>
  </v-form>
</template>

<script setup>
import { ref, defineProps } from 'vue';

const props = defineProps({
form: {
  type: Array,
  required: true,
},
componentes: {
  type: Array,
  required: true,
}
});

const headers = [
  { title: 'Correccion', align: 'start', value: 'seleccionar', sortable: false },
  { title: 'Nombre', align: 'start', value: 'nombre' },
  { title: 'Modelo', value: 'modelo' },
  { title: 'Número de Serie', value: 'numero_de_serie' },
];

// Array que contendrá los componentes seleccionados
const componentesSeleccionados = ref([]);

// Función para manejar la selección de un componente
const toggleSeleccionado = (componente) => {
  // Si se selecciona, lo agregamos a componentesSeleccionados
  if (componente.seleccionado) {
    componentesSeleccionados.value.push(componente);
  } else {
    // Si se deselecciona, lo removemos de componentesSeleccionados
    componentesSeleccionados.value = componentesSeleccionados.value.filter(
      (comp) => comp.id !== componente.id
    );
  }
};

// // Función para manejar la selección de un componente
// const toggleSeleccionado = (componente) => {
//   if (componente.seleccionado) {
//     // Si el componente está seleccionado, agregarlo a 'form.componentes_correct'
//     if (!props.form.componentes_correct.find((comp) => comp.id === componente.id)) {
//       props.form.componentes_correct.push(componente);
//     }
//   } else {
//     // Si se deselecciona, removerlo de 'form.componentes_correct'
//     props.form.componentes_correct = props.form.componentes_correct.filter(
//       (comp) => comp.id !== componente.id
//     );
//   }
// };

</script>
