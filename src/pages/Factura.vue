<template>
  <v-card class="ma-3 bg-surface-light">
    <v-card-title>Nueva compra</v-card-title>
    <v-card-text>
      <v-card>
        <v-form>
          <v-card-title style="display: flex; align-items: center;">
            Detalles de compra
            <v-col class="text-end">
              <v-btn color="primary" text="Cancelar"></v-btn>
            </v-col>
          </v-card-title>
          <v-card-text>
            <v-divider class="mb-4"></v-divider>
            <v-row>
              <v-col cols="3" class="pr-0">
                <v-select v-model="form.proveedor" label="Proveedor"></v-select>
              </v-col>
              <v-col cols="1" class="pl-0">
                <v-btn prepend-icon="mdi-plus" text="Nuevo" color="primary"></v-btn>
              </v-col>
              <v-col cols="2">
                <v-text-field  v-model="form.fecha" type="date" label="Fecha"></v-text-field>
              </v-col>
              <v-col cols="2">
                <v-text-field v-model="form.n_compra" type="number" label="N Compra"></v-text-field>
              </v-col>
              <v-col cols="2">
                Agregar productos
                <v-dialog max-width="1200">
                  <template v-slot:activator="{ props: activatorProps }">
                    <v-btn v-bind="activatorProps"
                      color="primary" prepend-icon="mdi-plus" class="mr-3" text="Buscar">
                    </v-btn>
                  </template>
                  <template v-slot:default="{ isActive }"> 
                    <v-card title="Seleccion de productos">
                      <v-card-text>
                        <BuscarRepuesto 
                          :pruebaDeRepuestos="pruebaDeRepuestos" 
                          @transferir-pruebaDeRepuestos="agregarRepuestoSeleccionado"
                        />
                      </v-card-text>
                      <v-card-actions>
                        <v-spacer></v-spacer>
                        <v-btn text="Hecho" @click="isActive.value = false" color="blue"></v-btn>
                      </v-card-actions>
                    </v-card>
                  </template>
                </v-dialog>
              </v-col>
            </v-row>
            <v-divider></v-divider>
            <v-data-table :headers="headers" :items="repuestosSeleccionados" hide-default-footer>
              <template v-slot:item.nueva_cantidad="{ item }">
                <v-text-field v-model="item.nueva_cantidad" type="number" hide-details="auto" disabled></v-text-field>
              </template>
              <template v-slot:item.actions="{ item }">
                <v-btn icon="mdi-delete" color="red"></v-btn>
              </template>
            </v-data-table>
            <v-divider></v-divider>
          </v-card-text>
          <v-card-actions>
            <v-col cols="3">
              <v-text-field v-model="form.encargado_uno" label="Encargado"></v-text-field>
            </v-col>
            <v-col cols="9" class="text-end">
              <v-btn text="Guardar datos" color="primary" @click="guardarDatos"></v-btn>
            </v-col>
          </v-card-actions>
        </v-form>
      </v-card>
    </v-card-text>
  </v-card>
</template>

<script>
import axios from 'axios';
import { direccionIP } from '@/global';
import BuscarRepuesto from "@/components/BuscarRepuesto.vue";

export default {
  data() {
    return {
      myIP: direccionIP,
      repuestos: [],
      form: {
        proveedor: null,
        fecha: '',
        n_compra: '',
        encargado_uno: '',
      },
      headers: [
        { title: 'Nombre', value: 'nombre' },
        { title: 'Modelo', value: 'modelo' },
        { title: 'Fabricante', value: 'fabricante' },
        { title: 'Descripcion', value: 'descripcion' },
        { title: 'Cantidad', value: 'nueva_cantidad' },
        { title: '', value: 'actions', sortable: false },
      ],
      pruebaDeRepuestos: [
        { nombre: 'uno', categoria: 'a', modelo: 'A', n_serie: '12', fabricante: 'Aargs', descripcion: 'Una cosa', cantidad: '' },
        { nombre: 'dos', categoria: 'b', modelo: 'B', n_serie: '23', fabricante: 'Bhaefa', descripcion: 'Otra cosa', cantidad: '' },
        { nombre: 'tres', categoria: 'c', modelo: 'C', n_serie: '34', fabricante: 'Haeaa', descripcion: 'Cosa extra', cantidad: '' },
        { nombre: 'cuatro', categoria: 'd', modelo: 'D', n_serie: '45', fabricante: 'Abresah', descripcion: 'Mas cosas', cantidad: '' },
        { nombre: 'cinco', categoria: 'e', modelo: 'E', n_serie: '56', fabricante: 'Narsy', descripcion: 'Un poco mas', cantidad: '' },
      ],
      repuestosSeleccionados: [],
    }
  },
  mounted() {
      this.fetchRepuestos();
    },
  methods: {
    async fetchRepuestos() {
      try {
        const response = await axios.get(`${this.myIP}/api/v1/repuestos`);
        this.repuestos = response.data;
      } catch (error) {
        console.error("Hubo un error al obtener los datos:", error);
      }
    },
    agregarRepuestoSeleccionado(pruebaDeRepuestos) {
      const existingRepuesto = this.repuestosSeleccionados.find(r => r.nombre === pruebaDeRepuestos.nombre);
      if (!existingRepuesto) {
        this.repuestosSeleccionados.push({
          ...pruebaDeRepuestos,
          nueva_cantidad: pruebaDeRepuestos.nueva_cantidad || 0  // Asegúrate de que nueva_cantidad esté definida
        });
      }
    },
  }
}
</script>
