<template>
  <v-container>
    <v-row>
      <v-col v-for="item in lista" :key="item.id" cols="6">
        <v-card class="bg-surface-light pa-2" @click="enviar(item.id)">
          <v-list-item>
            <!-- Estructura diferente según el tipo de item -->
            <v-list-item class="text-h6 py-0" :title="`${item.nombre}`"
              :subtitle="`Numero de serie: ${item.numero_de_serie}. `">
            </v-list-item>
            <v-list-item>{{ item.observaciones_generales }}</v-list-item>
            <template v-slot:append>
              <v-chip v-if="item.estado === 'En uso'" color="blue">En uso</v-chip>
              <v-chip v-else-if="item.estado === 'Disponible'" color="yellow">Disponible</v-chip>
              <v-chip v-else-if="item.estado === 'Indisponible'" color="red">Indisponible</v-chip>
            </template>
          </v-list-item>
        </v-card>
      </v-col>
    </v-row>
  </v-container>
</template>

<script setup>
import { defineProps } from 'vue';
import { useRouter } from "vue-router"
const router = useRouter()
const props = defineProps({
  lista: {
    type: Array,
    required: true
  }
});
const enviar =(e)=>{
  router.push(`/maquinas/${e}`)
}
</script>

<style>

</style>
