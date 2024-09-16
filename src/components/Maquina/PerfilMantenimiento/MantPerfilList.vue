<template>
  <v-container class="pa-4">
    <v-form>
      <v-row v-for="(comp, index) in componentesMaquina" :key="index">
        <v-col cols="2" class="d-flex align-center pr-1">
          {{ comp.nombre }}
        </v-col>
        <v-col cols="2" class="px-1">
          <v-select
          v-model="comp.periodo"
          :items="periodoOptions"
          item-value="value"
          item-text="text"
          label="Periodo"
          hide-details="auto"
          @change="updatePeriodo"
          >
        </v-select>
        </v-col>
        <v-col cols="1" class="px-1">
          <v-text-field
            v-model="comp.horasUso"
            label="Hs uso"
            hide-details="auto"
          ></v-text-field>
        </v-col>
        <v-col cols="6" class="px-1">
          <v-text-field
          v-model="comp.descripcion"
          label="Descripcion"
          hide-details="auto"
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
import { computed } from 'vue';

const props = defineProps({
  componentesMaquina: {
    type: Object,
    required: true,
  },
});

</script>
