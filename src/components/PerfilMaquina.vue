<template>
  <v-container class="ma-0 py-0 px-1">
    <v-card class="bg-surface-light">
      <v-card-title style="display: flex; align-items: center;" class="px-3 py-0">
        Perfil de la maquina
        <v-col class="text-end">
          <v-btn v-if="isEditing" color="primary" @click="cancel" class="mr-3" text="Cancelar"></v-btn>
          <v-btn color="primary" @click="toggleEditMode" class="ma-0" prepend-icon="mdi-pencil">
            {{ isEditing ? 'Guardar' : 'Editar' }}
          </v-btn>
        </v-col>
      </v-card-title>
      <v-card-text class="pt-3">
        <v-form style="width: 100%; height: 100%;">
          <v-row>
            <v-col cols="8" class="pa-0">
              <v-card v-for="(carta, i) in cartas" :key="i" class="pa-4 mx-2 mb-2">
                <v-row>
                  <v-col v-for="(fila, n) in carta.filas" :key="n" :cols="fila.size" :class="fila.class">
                    <v-text-field v-if="fila.component === 'textField'"
                      v-model="form[fila.model]"
                      v-bind="fila.props"
                      :disabled="getDisabled(fila) || isDisabled(fila)"
                      density="compact"
                    ></v-text-field>
                    <v-select v-else-if="fila.component === 'select'"
                      v-model="form[fila.model]"
                      :items="getItems(fila)"
                      :disabled="isDisabled(fila)"
                      v-bind="fila.props"
                      density="compact"
                    ></v-select>
                    <v-textarea v-else-if="fila.component === 'textArea'"
                      v-model="form[fila.model]"
                      :disabled="getDisabled(fila) || isDisabled(fila)"
                      v-bind="fila.props"
                    ></v-textarea>
                    <v-text v-else-if="fila.component === 'text'">{{ fila.text }}</v-text>
                    <v-checkbox v-else 
                      v-model="form[fila.model]" 
                      hide-details="auto" 
                      :disabled="isDisabled(fila)">
                      <template v-slot:label>{{ fila.text }}</template>
                    </v-checkbox>
                  </v-col>
                </v-row>
              </v-card>
            </v-col>
            <v-col cols="4" class="pa-0">
              <v-card class="mb-2 mr-2">
                <v-card-title>Repuestos requeridos:</v-card-title>
                <v-card-text>
                    <v-row>
                    <v-col cols="6" v-for="(componente, i) in componentes" :key="i" class="pa-0">
                      <v-list-item>{{ componente }}</v-list-item>
                    </v-col>
                  </v-row>
                </v-card-text>
                <v-divider></v-divider>
                <v-card-actions>
                  <v-btn color="primary" :disabled="!isEditing">Modificar</v-btn>
                </v-card-actions>
              </v-card>
              <v-card class="mr-2">
                <v-card-title>Insumos requeridos:</v-card-title>
                <v-card-text>
                    <v-row>
                    <v-col cols="6" v-for="(componente, i) in componentes" :key="i" class="pa-0">
                      <v-list-item>{{ componente }}</v-list-item>
                    </v-col>
                  </v-row>
                </v-card-text>
                <v-divider></v-divider>
                <v-card-actions>
                  <v-btn color="primary" :disabled="!isEditing">Modificar</v-btn>
                </v-card-actions>
              </v-card>
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
      isEditing: false,
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
          { model: 'nombreMaquina', component: 'textField', size: 9, class: 'pb-0', props:{label:'Nombre'} },
          { model: 'selectEstado', component: 'select', size: 3, class: 'pb-0 pl-0', props:{label:'Estado'} },
          { model: 'serieMaquina', component: 'textField', size: 5, class: 'py-0', props:{label:'Identificador'} },
          { model: 'modeloMaquina', component: 'textField', size: 4, class: 'pa-0', props:{label:'Modelo'} },
          { model: 'selectTipo', component: 'select', size: 4, class: 'py-0', props:{label:'Tipo'} },
          { model: 'voltaje', component: 'textField', size: 4, class: 'pa-0', props:{label:'Voltaje'} },
          { model: 'peso', component: 'textField', size: 4, class: 'py-0', props:{label:'Peso'} },
          { component: 'text', size: 3, text: 'Fecha de adquisicion:', class: 'py-0', },
          { model: 'fechaAdquiridaM', component:'textField', size: 4, class: 'pa-0', props:{label:'Fecha de adquisicion', type:'date'} },
          { component: 'text', size: 4 },
          { component: 'text', size: 3, text: 'Mantenimiento:', class: 'py-0', },
          { model: 'fechaUMantM', component:'textField', size: 4, class: 'pa-0', props:{label:'Ultimo', type:'date'} },
          { model: 'fechaPMantM', component:'textField', size: 5, class: 'py-0', props:{label:'Proximo', type:'date'} },
          { model: 'checkbox1', component: 'checkbox', size: 4, text: 'Velocidad ajustable', class: 'py-0' },
          { model: 'checkbox2', component: 'checkbox', size: 8, text: 'Facilidad de desmontaje', class: 'py-0' },
          { model: 'checkbox3', component: 'checkbox', size: 4, text: 'Pantalla digital', class: 'py-0' },
          { model: 'checkbox4', component: 'checkbox', size: 3, text: 'Garantia', class: 'py-0' },
          { model: 'cantidad', component: 'textField', size: 5, class: 'py-0', props: {label: 'Cantidad'} },
          { model: 'checkbox5', component: 'checkbox', size: 12, text: 'Requiere seguimiento', class: 'py-0' },
          { model: 'seguimiento', component: 'textArea', size: 12, class: 'py-0', props: {label: 'Aclaracion', rows:1}}
        ]},
        {filas:[
          { component: 'text', size: 12, text:'Observaciones generales' },
          { component: 'text', size: 12, text: 'Ubicacion:', class: 'py-0', },
          { model: 'ubicacionM', component: 'textArea', size: 12, class: 'py-0', props:{label:'Descripcion', rows:1} },
          { component: 'text', size: 12, text: 'Problemas recurrentes:', class: 'py-0' },
          { model: 'problemasM', component: 'textArea', size: 12, class: 'py-0', props:{label:'Descripcion', rows:2} },
          { component: 'text', size: 12, text: 'Recomendaciones:', class: 'py-0' },
          { model: 'recomenM', component: 'textArea', size: 12, class: 'py-0', props:{label:'Descripcion', rows:2} },
          { component: 'text', size: 12, text: 'Comentarios adicionales:', class: 'py-0' },
          { model: 'comentarioM', component: 'textArea', size: 12, class: 'py-0', props:{label:'Descripcion', rows:2} },
          { component: 'text', size: 12, text: 'Sistema de seguridad:', class: 'py-0' },
          { model: 'seguridad', component: 'textArea', size: 12, class: 'py-0', props:{label:'Descripcion', rows:2} },
        ]},
      ],
      componentes: ["una", "dos", "tres", "cuatro", "cinco", "seis", "siete", "ocho", "nueve"]
    }
  },
  methods: {
    getItems(fila) {
      if (fila.model === 'selectTipo') {
        return this.tipos;
      } else if (fila.model === 'selectEstado') {
        return this.estados;
      }
      return [];
    },
    getDisabled(fila) {
      if (fila.model === 'cantidad') {
        return !this.form.checkbox4;
      } else if (fila.model === 'seguimiento') {
        return !this.form.checkbox5;
      }
      return false;
    },
    isDisabled(fila) {
      return !this.isEditing;
    },
    toggleEditMode() {
      if (this.isEditing) {
        this.guardarCambios();
      }
      this.isEditing = !this.isEditing;
    },
    cancel() {
      this.isEditing = false;
    }
  }
}
</script>
