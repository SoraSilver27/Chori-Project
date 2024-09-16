<template>
  <v-card>
    <v-card-title>
      <v-autocomplete label="Buscar" clearable></v-autocomplete>
    </v-card-title>
    <v-divider></v-divider>
    <v-card-text>
      <v-data-table :headers="headers" :items="pruebaDeRepuestos">
        <template v-slot:item.nueva_cantidad="{ item }">
          <v-text-field type="number" hide-details="auto" v-model="item.nueva_cantidad"></v-text-field>
        </template>
        <template v-slot:item.actions="{ item }">
          <v-btn icon="mdi-transfer-down" color="orange" @click="transferirRepuesto(item)"></v-btn>
        </template>
      </v-data-table>
    </v-card-text>
  </v-card>
</template>

<script>
export default {
  props: {
    pruebaDeRepuestos: {
      type: Array,
      required: true
    }
  },
  data() {
    return {
      headers: [
        { title: 'Nombre', value: 'nombre' },
        { title: 'Categoria', value: 'categoria' },
        { title: 'N Serie', value: 'n_serie' },
        { title: 'Modelo', value: 'modelo' },
        { title: 'Fabricante', value: 'fabricante' },
        { title: 'Cantidad', value: 'nueva_cantidad' },
        { title: '', value: 'actions', sortable: false },
      ],
    }
  },
  methods: {
    transferirRepuesto(item) {
      if (item.nueva_cantidad > 0) {
        this.$emit('transferir-pruebaDeRepuestos', { ...item });
      } else {
        alert("Ingrese una cantidad válida antes de transferir.");
      }
    },
  },
}
</script>