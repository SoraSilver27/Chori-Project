<template>
  <v-container class="ma-0 py-0 px-1">
    <v-card class="bg-surface-light">
      <v-card-title style="display: flex; align-items: center;" class="px-3 py-0">
        Perfil de la maquina
        <v-col class="text-end">
          <v-btn color="primary" @click="editMode = !editMode" class="ma-0" prepend-icon="mdi-pencil">
            {{ editMode ? 'Guardar' : 'Editar' }}
          </v-btn>
        </v-col>
      </v-card-title>
      <v-card-text class="pt-3">
        <v-form style="width: 100%; height: 100%;">
          <v-row>
            <v-col cols="8" class="pa-0">
              <v-col cols="12" v-for="(carta, i) in cartas" :key="i" class="pa-1">
                <v-list>
                  <v-list-item>
                    <v-row v-for="(fila, n) in carta.filas" :key="n">
                      <v-col v-for="(columna, m) in fila.columnas" :key="m" :cols="columna.size" :class="columna.class">
                        <v-text-field v-if="columna.component === 'textField'"
                          v-model="form[columna.model]"
                          v-bind="columna.props"
                          :disabled="getDisabled(columna)"
                          density="compact"
                        ></v-text-field>
                        <v-select v-else-if="columna.component === 'select'"
                          v-model="form[columna.model]"
                          :items="getItems(columna)"
                          v-bind="columna.props"
                          density="compact"
                        ></v-select>
                        <v-textarea v-else-if="columna.component === 'textArea'"
                          v-model="form[columna.model]"
                          :disabled="getDisabled(columna)"
                          v-bind="columna.props"
                        ></v-textarea>
                        <v-text v-else-if="columna.component === 'text'">{{ columna.text }}</v-text>
                        <v-checkbox v-else v-model="form[columna.model]" hide-details="auto">
                          <template v-slot:label>{{ columna.text }}</template>
                        </v-checkbox>
                      </v-col>
                    </v-row>
                  </v-list-item>
                </v-list>
              </v-col>
            </v-col>
            <v-col cols="4" class="pa-0">
              <v-col cols="12" class="pa-1">
                <v-list class="pa-2">
                  <v-list-item-title>Repuestos requeridos</v-list-item-title>
                </v-list>
              </v-col>
              <v-col cols="12" class="pa-1">
                <v-list class="pa-2">
                  <v-list-item-title>Insumos requeridos</v-list-item-title>
                </v-list>
              </v-col>
            </v-col>
          </v-row>
        </v-form>
      </v-card-text>
    </v-card>
  </v-container>
</template>

<script>
export default {
  data() {
    return{
      form: {
        nombreMaquina: '',
        serieMaquina: '',
        modeloMaquina: '',
        fechaAdquiridaM: '',
        fechaUMantM: '',
        fechaPMantM: '',
        selectEstado: null,
        selectTipo: null,
        voltaje: '',
        peso: '',
        checkbox1: false,
        checkbox2: false,
        checkbox3: false,
        checkbox4: false,
        checkbox5: false,
        cantidad: '',
        seguimiento: '',
        seguridad: '',
        ubicacionM: '',
        problemasM: '',
        recomenM: '',
        comentarioM: '',
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
      cartas: [

        {filas:[
          {columnas: [
            { model: 'nombreMaquina', component: 'textField', size: 9, class: 'pb-0', props:{label:'Nombre'} },
            { model: 'selectEstado', component: 'select', size: 3, class: 'pb-0 pl-0', props:{label:'Estado'} },
          ]},
          {columnas: [
            { model: 'serieMaquina', component: 'textField', size: 5, class: 'py-0', props:{label:'Identificador'} },
            { model: 'modeloMaquina', component: 'textField', size: 4, class: 'pa-0', props:{label:'Modelo'} },
          ]},
          { columnas:[
            { model: 'selectTipo', component: 'select', size: 4, class: 'py-0', props:{label:'Tipo'} },
            { model: 'voltaje', component: 'textField', size: 4, class: 'pa-0', props:{label:'Voltaje'} },
            { model: 'peso', component: 'textField', size: 4, class: 'py-0', props:{label:'Peso'} },
          ]},
          { columnas:[
            { component: 'text', size: 3, text: 'Fecha de adquisicion:', class: 'py-0', },
            { model: 'fechaAdquiridaM', component:'textField', size: 4, class: 'pa-0', props:{label:'Fecha de adquisicion', type:'date'} },
          ]},
          { columnas:[
            { component: 'text', size: 3, text: 'Mantenimiento:', class: 'py-0', },
            { model: 'fechaUMantM', component:'textField', size: 4, class: 'pa-0', props:{label:'Ultimo', type:'date'} },
            { model: 'fechaPMantM', component:'textField', size: 5, class: 'py-0', props:{label:'Proximo', type:'date'} },
          ]},
          { columnas:[
            { model: 'checkbox1', component: 'checkbox', size: 4, text: 'Velocidad ajustable', class: 'py-0' },
            { model: 'checkbox2', component: 'checkbox', size: 8, text: 'Facilidad de desmontaje', class: 'py-0' },
          ]},
          { columnas:[
            { model: 'checkbox3', component: 'checkbox', size: 4, text: 'Pantalla digital', class: 'py-0' },
            { model: 'checkbox4', component: 'checkbox', size: 3, text: 'Garantia', class: 'py-0' },
            { model: 'cantidad', component: 'textField', size: 5, class: 'py-0', props: {label: 'Cantidad'} },
          ]},
          { columnas:[
            { model: 'checkbox5', component: 'checkbox', size: 12, text: 'Requiere seguimiento', class: 'py-0' },
            { model: 'seguimiento', component: 'textArea', size: 12, class: 'py-0', props: {label: 'Aclaracion', rows:1}}
          ]}
        ]},

        {filas:[
          { columnas:[{ component: 'text', size: 12, text: 'Observaciones generales' }]},
          { columnas:[{ component: 'text', size: 12, text: 'Ubicacion:', class: 'py-0', }]},
          { columnas:[{ model: 'ubicacionM', component: 'textArea', size: 12, class: 'py-0', props:{label:'Descripcion', rows:1} }]},
          { columnas:[{ component: 'text', size: 12, text: 'Problemas recurrentes', class: 'py-0' }]},
          { columnas:[{ model: 'problemasM', component: 'textArea', size: 12, class: 'py-0', props:{label:'Descripcion', rows:2} }]},
          { columnas:[{ component: 'text', size: 12, text: 'Recomendaciones', class: 'py-0' }]},
          { columnas:[{ model: 'recomenM', component: 'textArea', size: 12, class: 'py-0', props:{label:'Descripcion', rows:2} }]},
          { columnas:[{ component: 'text', size: 12, text: 'Comentarios adicionales', class: 'py-0' }]},
          { columnas:[{ model: 'comentarioM', component: 'textArea', size: 12, class: 'py-0', props:{label:'Descripcion', rows:2} }]},
          { columnas:[{ component: 'text', size: 12, text: 'Sistema de seguridad', class: 'py-0' }]},
          { columnas:[{ model: 'seguridad', component: 'textArea', size: 12, class: 'py-0', props:{label:'Descripcion', rows:2} }]},
        ]},

      ]
    }
  },
  methods: {
    saveChanges() {
      // Lógica para guardar los cambios
    },
    getItems(columna) {
      if (columna.model === 'selectTipo') {
        return this.tipos;
      } else if (columna.model === 'selectEstado') {
        return this.estados;
      }
      return [];
    },
    getDisabled(columna) {
      if (columna.model === 'cantidad') {
        return !this.form.checkbox4;
      } else if (columna.model === 'seguimiento') {
        return !this.form.checkbox5;
      }
      return false;
    },
  }
}
</script>
