<template>
  <v-container class="pa-1">
    <v-form @submit.prevent="handleSubmit" style="width: 100%; height: 100%;">
      <v-row>
              <!-- Primera carta -->
        <v-col cols="7">
          <v-card>
            <v-list class="bg-surface-light pb-0">
              <v-list-item v-for="(fila,index) in filas" :key="index">
                <v-row>
                    <v-col v-for="(columna, i) in fila.columnas" :key="i" :cols="columna.size">
                      <v-text-field v-if="columna.component === 'v-text-field'"
                        v-model="form[columna.model]"
                        :rules="getRules(columna)"
                        :disabled="getDisabled(columna)"
                        v-bind="columna.props"
                      ></v-text-field>
                      <v-select v-else-if="columna.component === 'v-select'"
                        v-model="form[columna.model]"
                        :rules="getRules(columna)"
                        :items="getItems(columna)"
                        v-bind="columna.props"
                      ></v-select>
                      <v-list-item v-else-if="columna.component === 'v-list-item'">
                        Fecha de adquisicion:
                      </v-list-item>
                      <v-checkbox-btn v-else v-model="form[columna.model]">
                        <template v-slot:label>{{ columna.text }}</template>
                      </v-checkbox-btn>
                    </v-col>
                </v-row>
              </v-list-item>
            </v-list>
          </v-card>
        </v-col>
               <!-- Segunda carta -->
        <v-col cols="5">
          <v-card>
            <v-list class="bg-surface-light">
              <v-list-item v-for="(carta, n) in cartas" :key="n" class="" :title="carta.title">
                <v-textarea
                  v-model="form[carta.model]"
                  :counter="200"
                  rows="2"
                  variant="outlined"
                ></v-textarea>
              </v-list-item>
            </v-list>
          </v-card>
        </v-col>
      </v-row>
    </v-form>
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
  </v-container>
</template>

<script>

export default {
  data() {
    return {

      tabValue: 1,

      form: {
        nombre: '',
        serie: '',
        modelo: '',
        fecha: '',
        selectest: null,
        selecttip: null,
        voltaje: '',
        peso: '',
        checkbox1: false,
        checkbox2: false,
        checkbox3: false,
        enabled: false,
        cantidad: '',
        seguridad: '',
        ubicacion: '',
        info: '',
      },
      tipos: [
        'Hidraulica',
        'Electrica',
        'Neumatica',
        'Mecanica',
        'Termica',
        'Electronica',
        'Quimica',
        'Alimentaria',
      ],
      estados: [
        'En uso',
        'Disponible',
        'Indisponible',
      ],
      nameRules: [
        value => value ? true : 'Por favor ingrese un nombre',
        value => value.length <= 30 ? true : 'El nombre debe ser menor a 30 caracteres',
      ],
      rules: [
        value => value ? true : 'Campo obligatorio',
      ],

      filas: [{
        columnas:[
          {model: 'nombre', component: 'v-text-field', size: 12, props: {counter: 30, label: 'Nombre', density: 'comfortable'}},
          ],
        },
        {
        columnas: [
          {model: 'serie', component: 'v-text-field', size: 7, props: {counter: 15, label: 'Identificador', density: 'comfortable'}},
          {model: 'modelo', component: 'v-text-field', size: 5, props: {counter: 10, label: 'Modelo', density: 'comfortable'}},
          ],
        },
        {
        columnas: [
          {component: 'v-list-item', size: 3},
          {model: 'fecha', component: 'v-text-field', size: 5, props: {label: 'Fecha', type: 'date', density: 'comfortable'}},
          {model: 'selectest', component: 'v-select', size: 4, props: {label: 'Estado', density: 'comfortable'}},
          ],
        },
        {
        columnas: [
          {model: 'selecttip', component: 'v-select', size: 4, props: {label: 'Tipo', density: 'comfortable'}},
          {model: 'voltaje', component: 'v-text-field', size: 4, props: {label: 'Voltaje', density: 'comfortable'}},
          {model: 'peso', component: 'v-text-field', size: 4, props: {label: 'Peso', density: 'comfortable'}},
          ],
        },
        {
        columnas: [
          {model: 'checkbox1', component: 'v-checkbox-btn', size: 4, text: 'Velocidad ajustable'},
          {model: 'checkbox2', component: 'v-checkbox-btn', size: 8, text: 'Facilidad de desmontaje'},
          ],
        },
        {
        columnas: [
          {model: 'checkbox3', component: 'v-checkbox-btn', size: 4, text: 'Pantalla digital'},
          {model: 'enabled', component: 'v-checkbox-btn', size: 3, text: 'Garantia'},
          {model: 'cantidad', component: 'v-text-field', size: 5, props: {label: 'Cantidad'}},
          ]
      }],
      cartas: [
        {model: 'seguridad', title: 'Sistema de seguridad:'},
        {model: 'ubicacion', title: 'Ubicacion:'},
        {model: 'info', title: 'Mas informacion:'},
      ],
    };
  },

  methods: {
    getItems(columna) {
      if (columna.model === 'selecttip') {
        return this.tipos;
      } else if (columna.model === 'selectest') {
        return this.estados;
      }
      return [];
    },
    getRules(columna) {
      if (columna.model === 'nombre') {
        return this.nameRules;
      } else if (columna.model === 'modelo') {
        return this.rules;
      } else if (columna.model === 'selectest') {
        return this.rules;
      }
      return [];
    },
    getDisabled(columna) {
      if (columna.model === 'cantidad') {
        return !this.form.enabled;
      }
      return false;
    },
    handleSubmit() {
      // Maneja el envío del formulario
      console.log(this.form);
    },
    nextTab() {
      this.$emit('update-tab', this.tabValue);
    },
  },
};
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
