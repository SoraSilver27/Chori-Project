<template>
  <v-container>
    <v-row>
      <v-col v-for="item in lista" :key="item.id" cols="6">
        <v-card class="bg-surface-light pa-2" @click="enviar(item.id)">
          <v-list-item>
            <!-- Estructura diferente según el tipo de item -->
            <v-list-item class="text-h6 py-0">
              <v-list-item-title>
                {{ item.nombre }}
              </v-list-item-title>
              <v-list-item-subtitle class="d-flex" style="gap: 20px;">
                <span>No de serie: {{ item.numero_de_serie }}</span>
                <span>Modelo: {{ item.modelo }}</span>
              </v-list-item-subtitle>
            </v-list-item>
            <v-list-item>{{ item.descripcion}}</v-list-item>
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

const idComp = useRouter()

const props = defineProps({
  lista: {
    type: Array,
    required: true
  }
});
const enviar =(c)=>{
  idComp.push(`/componentes/${c}`)
}
</script>