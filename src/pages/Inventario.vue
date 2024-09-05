<template>
  <v-card>
    <v-card-title>
      <v-row style="display: flex; align-items: center;">
        <v-col cols="3">
          <v-text-field label="Buscar" hide-details="auto"></v-text-field>
        </v-col>
        <v-col cols="3">
          <v-select :items="uniqueFabricante" v-model="selectedFabricante" label="Fabricante" hide-details="auto"></v-select>
        </v-col>
        <v-col cols="6" class="text-end">
          <v-btn prepend-icon="mdi-plus" color="primary" :to="'/nuevo_repuesto'" text="Nuevo"></v-btn>
        </v-col>
      </v-row>
    </v-card-title>
    <v-card-text>
      <v-container fluid>
        <v-data-table
          :headers="headers"
          :items="categories"
          class="elevation-1 bg-surface-light"
        >
          <template v-slot:item.name="{ item }">
            <v-expansion-panels>
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
                    :headers="partHeaders"
                    :items="item.parts"
                    hide-default-footer
                  >
                    <template v-slot:item.cantidad="{ item }">
                      <v-chip color="red">{{ item.cantidad }}</v-chip>
                    </template>
                    <template v-slot:item.actions>
                      <v-btn color="primary">Accion</v-btn>
                    </template>
                  </v-data-table>
                </v-expansion-panel-text>
              </v-expansion-panel>
            </v-expansion-panels>
          </template>
        </v-data-table>
      </v-container>
    </v-card-text>
  </v-card>
  
</template>

<script>
export default {
  data() {
    return {
      headers: [{ title: 'Categorias de repuestos', value: 'name' }],
      partHeaders: [
        { title: 'Nombre', value: 'nombre', align: 'start' },
        { title: 'Modelo', value: 'modelo', align: 'start' },
        { title: 'Fabricante', value: 'fabricante', align: 'start' },
        { title: 'Cantidad', value: 'cantidad', align: 'center' },
        { title: '', value: 'actions', sortable: false, align: 'end' },
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
