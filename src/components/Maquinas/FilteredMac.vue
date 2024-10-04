<template>
  <v-container>
    <v-row>
      <v-col v-for="item in paginatedItems" :key="item.id" cols="6">
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
    <v-pagination
      v-model="currentPage"
      :length="pageCount"
      :total-visible="5"
      class="my-4"
    ></v-pagination>
  </v-container>
</template>

<script setup>
import { defineProps, ref, computed } from 'vue';
import { useRouter } from "vue-router"
const router = useRouter()
const props = defineProps({
  items: {
    type: Array,
    required: true
  }
});

// Estado reactivo para la página actual y elementos por página
const currentPage = ref(1);
const itemsPerPage = 10;

// Computed para obtener los ítems paginados
const paginatedItems = computed(() => {
  const start = (currentPage.value - 1) * itemsPerPage;
  const end = start + itemsPerPage;
  return props.items.slice(start, end);
});

// Computed para obtener el número total de páginas
const pageCount = computed(() => {
  return Math.ceil(props.items.length / itemsPerPage);
});

const enviar =(e)=>{
  router.push(`/maquinas/${e}`)
}
</script>