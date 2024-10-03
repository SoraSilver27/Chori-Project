<template>
  <v-container class="pa-4">
    <v-form>
      <v-row v-for="(comp, index) in maquinaComp" :key="index">
        <v-col cols="3" class="d-flex align-center pr-1">
          <v-text-field
            v-model="comp.nombre"
            hide-details
            disabled
          ></v-text-field>
        </v-col>
        <v-col cols="2" class="px-1">
          <v-select
            v-model="comp.periodo_mantenimiento"
            :items="periodoOptions"
            label="Periodo"
            hide-details
            >
          </v-select>
        </v-col>
        <v-col cols="6" class="px-1">
          <v-text-field
          v-model="comp.descripcion"
          label="Descripcion general"
          hide-details
        ></v-text-field>
        </v-col>
        <v-col class="d-flex align-center justify-center px-1">
          <v-btn icon="mdi-file-document-edit" color="success">
            <v-icon>mdi-file-document-edit</v-icon>
            <v-tooltip activator="parent" location="top">
              Modificar mantenimiento del componente
            </v-tooltip>
          </v-btn>
        </v-col>
      </v-row>
    </v-form>
  </v-container>
</template>

<script setup>
import { defineProps, defineEmits } from 'vue';
const props = defineProps({
  maquinaComp: {
    type: Array,
    required: true,
  },
});

const periodoOptions = [
  0, 7, 15, 30, 60, 90, 180, 360, 720
];

// Emitir los datos actualizados
const emit = defineEmits(['updateData']);

function emitirCambios() {
  emit('updateData', props.maquinaComp); // Emite los datos modificados
}
</script>
