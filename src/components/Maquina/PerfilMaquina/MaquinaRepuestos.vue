<template>
  <v-card class="my-0 mr-2">
    <v-card-title class="pb-0">
      Repuestos requeridos
    </v-card-title>
    <v-card-text class="pb-0">
      <v-list class="py-0">
        <v-list-item
          v-for="(item, index) in visibleItems"
          :key="index"
        >
          {{ item }}
        </v-list-item>
      </v-list>
    </v-card-text>
    <v-card-actions>
      <v-btn text @click="toggleExpand" color="blue">
        {{ isExpanded ? 'Ver menos' : 'Ver más' }}
      </v-btn>
    </v-card-actions>
  </v-card>
</template>

<script setup>
import { ref, computed } from 'vue';

const items = ref([
  'Componente 1',
  'Componente 2',
  'Componente 3',
  'Componente 4',
  'Componente 5',
  'Componente 6',
  'Componente 7',
  'Componente 8',
  'Componente 9',
  'Componente 10',
]);

const isExpanded = ref(false);

const visibleItems = computed(() => {
  return isExpanded.value ? items.value : items.value.slice(0, 5);
});

const toggleExpand = () => {
  isExpanded.value = !isExpanded.value;
};

const edit = () => {
  console.log('Editar componentes');
};
</script>

<style scoped>
.v-card {
  margin-top: 20px;
}
</style>
