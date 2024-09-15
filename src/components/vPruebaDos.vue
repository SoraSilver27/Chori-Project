<template>
  <v-container class="ma-0 py-0 px-1">
    <v-card class="bg-surface-light pa-1 ma-0">
      <v-card-title style="display: flex; align-items: center;" class="pa-1">
        Mantenimiento de los componentes
        <v-col class="pa-2 text-end">
          <v-btn v-if="isEditing" color="primary" @click="cancel" class="mr-3">Cancelar</v-btn>
          <v-btn color="primary" prepend-icon="mdi-pencil" @click="toggleEditMode">
            {{ isEditing ? 'Guardar' : 'Editar' }}
          </v-btn>
        </v-col>
      </v-card-title>
      <v-container class="pa-0">

        <v-container class="pa-0" v-if="!isEditing">
          <v-card>
            <MantPerfil :componentesMaquina="componentesMaquina" />
          </v-card>
        </v-container>

        <v-container v-else class="pa-0">
          <v-card>
            <v-container class="pa-4">
              <v-form>
                <v-row v-for="(comp, index) in componentesMaquina" :key="index">
                  <v-col cols="2" class="d-flex align-center pr-1">
                    {{ comp.nombre }}
                  </v-col>
                  <v-col cols="2" class="px-1">
                    <v-select
                    v-model="comp.periodo"
                    :items="periodoOptions"
                    item-value="value"
                    item-text="text"
                    label="Periodo"
                    hide-details="auto"
                    @change="updatePeriodo"
                    >
                  </v-select>
                  </v-col>
                  <v-col cols="1" class="px-1">
                    <v-text-field
                      v-model="comp.horasUso"
                      label="Hs uso"
                      hide-details="auto"
                    ></v-text-field>
                  </v-col>
                  <v-col cols="6" class="px-1">
                    <v-text-field
                    v-model="comp.descripcion"
                    label="Descripcion"
                    hide-details="auto"
                  ></v-text-field>
                  </v-col>
                  <v-col class="d-flex align-center justify-center px-1">
                    <v-btn icon="mdi-file-document-edit" color="success">
                      <v-icon>mdi-file-document-edit</v-icon>
                      <v-tooltip activator="parent" location="top">
                        Modificar mantenimiento del componente
                      </v-tooltip>
                    </v-btn>
                  </v-col>
                </v-row>
              </v-form>
            </v-container>
          </v-card>
        </v-container>

      </v-container>
    </v-card>
  </v-container>
</template>


<script setup>
import { ref, computed } from 'vue';
import MantPerfil from './PerfilMantenimiento/MantPerfil.vue';

// Variables reactivas
const isEditing = ref(false);

const componentesMaquina = ref([
  { nombre: 'Componente 1', periodo: 7, ultimo: '2024-07-10', proximo: '2024-07-17', descripcion: 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Fugit asperiores beatae at, maxime eveniet odit.' },
  { nombre: 'Componente 2', periodo: 30, ultimo: '2024-06-15', proximo: '2024-07-15', descripcion: 'Rerum fuga nisi dolorem aut explicabo doloribus. Voluptatem assumenda repudiandae tempore. Pariatur commodi aut at?' },
  { nombre: 'Componente 3', periodo: 15, ultimo: '2024-07-01', proximo: '2024-07-16', descripcion: 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Fugit asperiores beatae at, maxime eveniet odit.' },
  { nombre: 'Componente 4', periodo: 360, ultimo: '2024-01-01', proximo: '2025-01-01', descripcion: 'Rerum fuga nisi dolorem aut explicabo doloribus. Voluptatem assumenda repudiandae tempore. Pariatur commodi aut at?' },
  { nombre: 'Componente 5', periodo: 7, ultimo: '2024-07-08', proximo: '2024-07-15', descripcion: 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Fugit asperiores beatae at, maxime eveniet odit.' },
  { nombre: 'Componente 6', periodo: 30, ultimo: '2024-06-30', proximo: '2024-07-30', descripcion: 'Rerum fuga nisi dolorem aut explicabo doloribus. Voluptatem assumenda repudiandae tempore. Pariatur commodi aut at?' },
  { nombre: 'Componente 7', periodo: 90, ultimo: '2024-05-01', proximo: '2024-08-01', descripcion: 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Fugit asperiores beatae at, maxime eveniet odit.' },
  { nombre: 'Componente 8', periodo: 15, ultimo: '2024-07-05', proximo: '2024-07-20', descripcion: 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Fugit asperiores beatae at, maxime eveniet odit.' },
  { nombre: 'Componente 9', periodo: 15, ultimo: '2024-07-12', proximo: '2024-07-19', descripcion: 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Fugit asperiores beatae at, maxime eveniet odit.' },
  { nombre: 'Componente 10', periodo: 60, ultimo: '2024-04-01', proximo: '2024-08-01', descripcion: 'Rerum fuga nisi dolorem aut explicabo doloribus. Voluptatem assumenda repudiandae tempore. Pariatur commodi aut at?' }
]);



// Methods
function toggleEditMode() {
  if (isEditing.value) {
    guardarCambios();
  }
  isEditing.value = !isEditing.value;
}

function guardarCambios() {
  console.log('Datos guardados:', componentesMaquina.value);
  // Aquí puedes implementar la lógica para guardar los cambios, como hacer una llamada a una API.
}

function cancel() {
  isEditing.value = !isEditing.value;
}
</script>
