<template>
  <v-container class="pa-0">
    <v-card>
      <v-card-title>
        <v-row>
          <v-col cols="3">
            <v-text-field type="date"></v-text-field>
          </v-col>
          <v-col cols="3">
            <v-select :items="uniqueProveedores" v-model="selectedProveedor" label="Proveedor"></v-select>
          </v-col>
          <v-col cols="2">
            <v-text-field v-model="numeroFactura" type="number" label="Numero"></v-text-field>
          </v-col>
          <v-spacer></v-spacer>
          <v-col cols="2">
            <v-btn prepend-icon="mdi-plus" color="primary" :to="'/Factura'">Nuevo</v-btn>
          </v-col>
        </v-row>
      </v-card-title>
      <v-card-text>
        <v-card class="bg-surface-light">
          <v-card-title>Lista de compras</v-card-title>
          <v-card-text>
            <v-data-table :items="filteredFacturas" :headers="headers">
              <template v-slot:item.originalEstado="{ item }">
                <v-checkbox v-model="item.originalEstado" :input-value="item.originalEstado === 'selected'" disabled></v-checkbox>
              </template>
              <template v-slot:item.actions="{ item }">
                <v-btn color="red" density="comfortable">Editar</v-btn>
              </template>
            </v-data-table>
          </v-card-text>
        </v-card>
      </v-card-text>
    </v-card>
  </v-container>
</template>

<script>
import Factura from './Factura.vue';

export default {
  data() {
    return {
      selectedProveedor: 'Todos',
      numeroFactura: 0,
      headers: [
        { title: 'Numero', value: 'numero' },
        { title: 'Proveedor', value: 'proveedor' },
        { title: 'Fecha', value: 'fechaCompra' },
        { title: 'Encargado', value: 'encargadoCompra' },
        { title: 'Original', value: 'originalEstado' },
        { title: '', value: 'actions', sortable: false },
      ],
      facturas: [
        {numero: '001', proveedor: 'La Tiendita', fechaCompra: '10/07/24', encargadoCompra: 'Xavier Lenoy', originalEstado: 'selected' },
        {numero: '002', proveedor: 'Albarrotes', fechaCompra: '06/07/24', encargadoCompra: 'Xavier Lenoy', originalEstado: 'selected' },
        {numero: '003', proveedor: 'Grupo Deltrol SA', fechaCompra: '01/07/24', encargadoCompra: 'Xavier Lenoy', originalEstado: 'selected' },
        {numero: '004', proveedor: 'La Tiendita', fechaCompra: '15/06/24', encargadoCompra: 'Xavier Lenoy', originalEstado: '' },
        {numero: '005', proveedor: 'Carlos', fechaCompra: '13/06/24', encargadoCompra: 'Xavier Lenoy', originalEstado: '' }
      ],
    }
  },
  computed: {
    uniqueProveedores() {
      // Crear un set para eliminar duplicados y luego convertirlo de nuevo a array
      return ['Todos', ...new Set(this.facturas.map(factura => factura.proveedor))];
    },
    filteredFacturas() {
      let filtered = this.facturas;

      // Filtrar por proveedor si no se selecciona "Todos"
      if (this.selectedProveedor !== 'Todos') {
        filtered = filtered.filter(factura => factura.proveedor === this.selectedProveedor);
      }

      // Filtrar por número de factura si se ingresa algún número
      if (this.numeroFactura !== 0 ) {
        filtered = filtered.filter(factura => factura.numero.includes(this.numeroFactura));
      }

      return filtered;
    }
  }
}
</script>
