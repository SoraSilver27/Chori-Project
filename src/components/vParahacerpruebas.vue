<!-- Es el invento raro con etiquetas que funciona raro -->
 <!-- No borrar -->

<template>
  <v-container class="pa-0">
    <v-list class="bg-surface-light pa-2">
      <v-list-item-title style="font-size: large;">
        Agregar componentes
      </v-list-item-title>
      <v-card>
        <v-form @submit.prevent="anadirForm">
          <v-list>
            <v-list-item>
              <v-row>
                <v-col cols="9">
                  <v-text-field
                    v-model="name"
                    :counter="30"
                    :rules="nameRules"
                    label="Nombre"
                    density="compact"
                  ></v-text-field>
                </v-col>
                <v-col cols="3">
                  <v-select
                    v-model="selectest"
                    :items="estado"
                    label="Estado"
                    density="compact"
                  ></v-select>
                </v-col>
              </v-row>
            </v-list-item>
            <v-list-item>
              <v-row>
                <v-col cols="7 pr-0">
                  <v-text-field
                    v-model="serie"
                    label="No de Serie"
                    density="compact"
                    class="pr-2"
                  ></v-text-field>
                </v-col>
                <v-col cols="5 pl-0">
                  <v-text-field
                    v-model="modelo"
                    label="Modelo"
                    :rules="rules"
                    density="compact"
                  ></v-text-field>
                </v-col>
              </v-row>
            </v-list-item>
            <v-list-item>
              <v-row>
                <v-col cols="7">
                  <v-select
                    v-model="selectfab"
                    :items="fabricante"
                    label="Fabricante"
                    density="compact"
                  ></v-select>
                </v-col>
                <v-col cols="2 pl-0">
                  <v-btn prepend-icon="mdi-plus" color="blue">Nuevo</v-btn>
                </v-col>
              </v-row>
            </v-list-item>


            <v-list-item>
              <v-row>
                <!-- Ventana de dialogo -->
                <v-col cols="2">
                  <v-dialog max-width="300">
                    <template v-slot:activator="{props:activatorProps}">
                      <v-btn v-bind="activatorProps">Etiquetas</v-btn>
                    </template>
                    <template v-slot:default="{isActive}">
                      <v-card title="Seleccione etiquetas">
                        <v-container>
                          <v-row>
                            <v-col v-if="!allSelected" cols="12">
                              <v-text-field
                              ref="searchField"
                              v-model="search"
                              label="Search"
                              hide-details
                              single-line
                            ></v-text-field>
                            </v-col>
                          </v-row>
                        </v-container>
                        <v-list>
                          <template v-for="etiqueta in categories">
                            <v-list-item
                              v-if="!selected.includes(etiqueta)"
                              :key="etiqueta.text"
                              :disabled="loading"
                              @click="selected.push(etiqueta)">
                                <v-list-item-title>{{ etiqueta.text }}</v-list-item-title>
                            </v-list-item>
                          </template>
                        </v-list>
                        <v-card-actions>
                          <v-spacer></v-spacer>
                          <v-btn :disabled="!selected.length" :loading="loading" @click="echo">
                            Hecho
                          </v-btn>
                        </v-card-actions>
                      </v-card>
                    </template>
                  </v-dialog>
                </v-col>

                <!-- Mostrar las lista de etiquetas seleccionadas -->
                <v-col cols="10">
                  <v-card>
                    <v-row align="center" justify="start">
                      <v-col v-for="(selection,i) in selections" :key="selection.text" cols="auto">
                        <v-chip
                          :disabled="loading"
                          v-model="selecteti"
                          closable
                          @click:close="selected.splice(i,1)">
                            {{ selection.text }}
                        </v-chip>
                      </v-col>
                    </v-row>
                  </v-card>
                </v-col>
              </v-row>
            </v-list-item>
            <v-list-item>
              <v-row>
                <v-col cols="10">
                </v-col>
                <v-col cols="2">
                  <v-btn color="blue" type="submit">Añadir</v-btn>
                </v-col>
              </v-row>
            </v-list-item>
          </v-list>
       </v-form>
      </v-card>

      <!-- Tabla de componentes -->
      <v-card class="mt-3">
        <v-data-table
          v-if="formulario.length"
          :headers="headers"
          :items="formulario"
          class="mt-4"
        ></v-data-table>
      </v-card>
    </v-list>
  </v-container>
</template>

<script>
import { computed, watch } from 'vue'

export default {
  data: () => ({
    name: '',
    modelo: '',
    serie: '',
    selectfab: null,
    selectest: null,
    selecteti:[],
    isActive: true,

    nameRules: [
      value => value ? true : 'Por favor ingrese un nombre',
      value => value.length <= 30 ? true : 'El nombre debe ser menor a 30 caracteres',
    ],
    rules: [
      value => value ? true : 'Campo obligatorio',
    ],
    fabricante: [
      'Hidraulica',
      'Electrica',
      'Neumatica',
    ],
    estado: [
      'En uso',
      'Disponible',
      'Indisponible',
    ],
    etiquetas: [
      {text: 'grande'},
      {text: 'chico'},
      {text: 'largo'},
      {text: 'corto'},
      {text: 'pesado'},
      {text: 'liviano'},
      {text: 'rojizo'},
      {text: 'azulado'},
    ],
    loading: false,
    selected: [],
    search: '',
    formulario: [],
    headers: [
      { text: 'Nombre', value: 'nombre' },
      { text: 'Serie', value: 'serie' },
      { text: 'Modelo', value: 'modelo' },
      { text: 'Estado', value: 'estado' },
      { text: 'Fabricante', value: 'fabricante' }
    ],
  }),
  computed: {
    allSelected () {
      return this.selected.length === this.etiquetas.length
    },
    categories () {
      const search = this.search.toLowerCase()

      if (!search) return this.etiquetas;

      return this.etiquetas.filter(etiqueta => {
        const text = etiqueta.text.toLowerCase()
        return text.indexOf(search) > -1
      })
    },
    selections () {
      const selections = []

      for (const selection of this.selected) {
        selections.push(selection)
      }

      return selections
    },
  },
  watch: {
    selected() {
      this.search=''
    }
  },
  methods: {
    next () {
      this.loading = true

      setTimeout(() => {
        this.search = ''
        this.selected = []
        this.loading = false
      }, 2000)
    },
    anadirForm() {
      this.formulario.push({
        nombre:this.name,
        serie:this.serie,
        modelo:this.modelo,
        selectest:this.selectest,
        selectfab:this.selectfab,
      });
      this.name='';
      this.serie='';
      this.modelo='';
      this.selectest=null;
      this.selectfab=null;
    }
  },
};
</script>


