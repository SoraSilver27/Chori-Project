<template>
  <v-container class="pa-1">

    <v-card class="bg-surface-light pa-3">
      <v-list>
        <v-list-item-title class="pl-4">Agregar componentes (Aqui solo seran agregados componentes nuevos que esten actualmente en esta maquina)</v-list-item-title>
        <v-form style="width: 100%; height: 100%;">
          <v-card class="ma-4">
            <v-list class="bg-surface-light">
              <v-list-item v-for="(fila,index) in filas" :key="index">
                <v-row>
                  <v-col v-for="(columna, i) in fila.columnas" :key="i" :cols="columna.size">
                    <v-text-field v-if="columna.component === 'v-text-field'"
                      v-model="form[columna.model]"
                      :rules="getRules(columna)"
                      v-bind="columna.props"
                      density="compact"
                    ></v-text-field>
                    <v-select v-else-if="columna.component === 'v-select'"
                      v-model="form[columna.model]"
                      :items="getItems(columna)"
                      :rules="getRules(columna)"
                      v-bind="columna.props"
                      density="compact"
                    ></v-select>
                    <v-btn v-else prepend-icon="mdi-plus" color="blue">Nuevo fab</v-btn>
                  </v-col>
                </v-row>
              </v-list-item>

              <v-list-item>
                <v-row>
                  <v-col cols="10">
                    <v-combobox
                      v-model="form.etiquetas"
                      :items="items"
                      label="Seleccione etiquetas"
                      prepend-icon="mdi-magnify"
                      variant="solo"
                      chips clearable multiple
                      density="compact"
                    >
                      <template v-slot:selection="{ attrs, item, select, selected }">
                        <v-chip v-bind="attrs" :model-value="selected" closable
                          @click="select"
                          @click:close="remove(item)"
                        >
                          <strong>{{ item }}</strong>
                        </v-chip>
                      </template>
                    </v-combobox>
                  </v-col>
                  <v-col cols="2">
                    <v-btn prepend-icon="mdi-plus" color="blue">Nueva Eti</v-btn>
                  </v-col>
                </v-row>
              </v-list-item>

              <v-list-item>
                <v-row class="text-end">
                  <v-col>
                    <v-btn color="orange" @click="addData">Añadir</v-btn>
                  </v-col>
                </v-row>
              </v-list-item>

            </v-list>
          </v-card>
        </v-form>


        <v-data-table :items="data" :headers="headers">
          <template v-slot:item.actions="{ item }">
            <v-btn color="red" density="comfortable" icon="mdi-delete" class="v-btn--round"
              @click="deleteItem(item)"
            ></v-btn>
          </template>
        </v-data-table>

        <v-container>
          <v-card class="bg-surface-light">
            <div class="botones">
              <v-btn class="btn" style="width: 30%;" size="large">
                Cancelar
              </v-btn>
              <v-btn class="btn" style="width: 30%;" size="large" @click="nextTab">
                Siguiente
              </v-btn>
            </div>
          </v-card>
        </v-container>


      </v-list>
    </v-card>

  </v-container>
</template>

<script>

export default {
  data() {
    return {

      tabValue: 2,

      // Definicion del formulario
      form: [
        {
          nombreComp: '',
          serieComp: '',
          modeloComp: '',
          selectestComp: null,
          fabricanteComp: null,
          etiquetas: [],
        },
      ],

      //Lista para almacenar los datos guardados
      data: [],

      //Reglas de validacion
      nameRules: [
        value => value ? true : 'Por favor ingrese un nombre',
        value => value.length <= 30 ? true : 'El nombre debe ser menor a 30 caracteres',
      ],
      rules: [
        value => value ? true : 'Campo obligatorio',
      ],

      //Opciones para los selectores
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

      //Configuracion de las filas y columnas del formulario
      filas: [
        {
          columnas: [
            { model: 'nombreComp', component: 'v-text-field', size: 9, props: {label: 'Nombre', counter: 30} },
            { model: 'selectestComp', component: 'v-select', size: 3, props: {label: 'Estado'} },
          ],
        },
        {
          columnas: [
            { model: 'serieComp', component: 'v-text-field', size: 4, props: {label: 'Identificador', counter: 15} },
            { model: 'modeloComp', component: 'v-text-field', size: 3, props: {label: 'Modelo', counter: 10} },
            { model: 'fabricanteComp', component: 'v-select', size: 3, props: {label: 'Fabricante'} },
            { model: 'nuevoFab', component: 'v-btn', size: 2 },
          ]
        }
      ],

      //Opciones para las etiquetas
      items: ['Grande', 'Chico', 'Pesado', 'Liviano', 'Alto', 'Bajo', 'Rojizo', 'Azulado', 'Caro', 'Barato'],

      //Encabezado de la tabla
      headers: [
        { title: 'Nombre', value: 'nombreComp' },
        { title: 'Modelo', value: 'modeloComp' },
        { title: 'Identificador', value: 'serieComp' },
        { title: 'Fabricante', value: 'fabricanteComp' },
        { title: 'Estado', value: 'selectestComp' },
        { title: 'Etiquetas', value: 'etiquetas' },
        { title: '', value: 'actions', sortable: false },
      ],
    }
  },
  methods: {
    //Optiene las opciones para los selectores
    getItems(columna) {
      if (columna.model === 'selectestComp') {
        return this.estado;
      } else if (columna.model === 'fabricanteComp') {
        return this.fabricante;
      }
      return [];
    },
    //Obtiene las reglas de validacion para los campos
    getRules(columna) {
      if (columna.model === 'nombreComp') {
        return this.nameRules;
      } else if (columna.model === 'modeloComp') {
        return this.rules;
      } else if (columna.model === 'selectestComp') {
        return this.rules;
      }
      return [];
    },
    handleSubmit() {
      // Maneja el envío del formulario
      console.log(this.form);
    },
    // Elimina una etiqueta seleccionada
    remove(item) {
      const index = this.form.etiquetas.indexOf(item);
      if (index !== -1) {
        this.form.etiquetas.splice(index, 1);
      }
    },
    // Método para agregar datos a la tabla
    addData() {
      // Añade una copia del objeto form a la tabla data
      this.data.push({ ...this.form });

      // Limpia el formulario para nuevas entradas
      this.form = {
        nombreComp: '',
        serieComp: '',
        modeloComp: '',
        selectestComp: null,
        fabricanteComp: null,
        etiquetas: [],
      };
    },
    deleteItem(item) {
      // Filtra el item eliminado fuera de la lista de datos
      this.data = this.data.filter(i => i !== item);
    },
    nextTab() {
      this.$emit('update-tab', this.tabValue);
    },
  }
}

</script>

<style scoped>

.botones{
  padding-top: 1%;
  padding-bottom: 1%;
  display: flex;
  width: 100%;
  height: 15%;
  align-items: center;
  justify-content: center;
  gap: 10%;
}

</style>
