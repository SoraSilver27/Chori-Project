<template>
  <v-container fluid>
    <v-data-table
      :headers="headers"
      :items="categories"
      class="elevation-1 bg-surface-light"
    >
      <template v-slot:item.name="{ item }">
        <v-expansion-panels multiple>
          <v-expansion-panel v-model="item.expanded">
            <v-expansion-panel-title>
              <v-row>
                <v-col cols="4">{{ item.name }}</v-col>
                <v-col cols="7">{{ item.description }}</v-col>
                <v-col cols="1">
                  <v-chip color="green">{{ getTotal(item) }}</v-chip>
                </v-col>
              </v-row>
            </v-expansion-panel-title>
            <v-expansion-panel-text>
              <v-data-table
                :items="item.parts"
                class="elevation-1"
                hide-default-footer
              >
                <template v-slot:item.cantidad="{ item }">
                  <v-chip color="red">{{ item.cantidad }}</v-chip>
                </template>
              </v-data-table>
            </v-expansion-panel-text>
          </v-expansion-panel>
        </v-expansion-panels>
      </template>
    </v-data-table>
  </v-container>
</template>

<script>
export default {
  data() {
    return {
      headers: [{ text: 'Categoria', value: 'name' }],
      partHeaders: [
        { text: 'Nombre', value: 'nombre', align: 'start' },
        { text: 'Modelo', value: 'modelo', align: 'start' },
        { text: 'Fabricante', value: 'fabricante', align: 'start' },
      ],
      categories: [
        {
          name: "Categoría 1",
          description: "Descripción de la categoría 1",
          total: 10,
          expanded: false,  // Estado de expansión
          parts: [
            { nombre: "Repuesto A", modelo: "A123", fabricante: "Fabricante A", cantidad: 1 },
            { nombre: "Repuesto B", modelo: "B456", fabricante: "Fabricante B", cantidad: 8 },
          ],
        },
        {
          name: "Categoría 2",
          description: "Descripción de la categoría 2",
          total: 5,
          expanded: false,  // Estado de expansión
          parts: [
            { nombre: "Repuesto C", modelo: "C789", fabricante: "Fabricante C", cantidad: 3 },
            { nombre: "Repuesto D", modelo: "D012", fabricante: "Fabricante D", cantidad: 2 },
          ],
        },
      ],
    };
  },
  methods: {
    getTotal(category) {
      return category.parts.reduce((sum, part) => sum + part.cantidad, 0);
    },
  },
};
</script>
