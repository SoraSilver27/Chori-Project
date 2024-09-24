<template>
  <v-card class="bg-grey-darken-3">
    <v-card-title style="display: flex; align-items: center;" class="px-3 py-0">
      Lista de componentes
      <v-col class="pa-2 text-end">

        <v-dialog max-width="1000">
          <template v-slot:activator="{ props: activatorProps }">
            <v-btn v-bind="activatorProps" v-if="!isEditing"
              color="primary" prepend-icon="mdi-plus" class="mr-3" text="Añadir">
            </v-btn>
          </template>
          <template v-slot:default="{ isActive }"> 
            <v-card title="Nuevo componente">
              <v-card-text>
                <AnadirComponente :componentesNU="componentesNOUbicados"/>
              </v-card-text>
              <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn text="Guardar" @click="isActive.value = false"></v-btn>
                <v-btn text="Cancelar" @click="isActive.value = false">
                </v-btn>
              </v-card-actions>
            </v-card>
          </template>
        </v-dialog>

        <v-btn v-if="isEditing" color="primary" @click="cancel" class="mr-3" text="Cancelar"></v-btn>
        <v-btn v-if="isEditing" color="primary"  class="mr-3" text="Agregar"></v-btn>
        <v-btn color="primary" prepend-icon="mdi-pencil" @click="toggleEditMode">
          {{ isEditing ? 'Guardar' : 'Editar' }}
        </v-btn>

      </v-col>
    </v-card-title>


    <v-card-text class="pt-3">
      {{ componenteLocal }}
      <v-row v-for="(componente, i) in componentesUbicados" :key="i">

        <v-col cols="3" class="pr-0">
          <v-text-field v-model="componente.nombre" label="Nombre"
            :disabled="!isEditing" class="bg-grey-darken-4" hide-details="auto"
          />
        </v-col>
        <v-col cols="2" class="px-0">
          <v-text-field v-model="componente.numero_serie"  label="Numero de Serie"
            :disabled="!isEditing" class="bg-grey-darken-4" hide-details="auto"
          />
        </v-col>
        <v-col cols="2" class="px-0">
          <v-text-field v-model="componente.modelo" label="Modelo"
            :disabled="!isEditing" class="bg-grey-darken-4" hide-details="auto"
          />
        </v-col>
        <v-col cols="2" class="px-0">
          <v-text-field type="date" v-model="componente.ultima_fecha" label="Últ. mantenimiento" 
            disabled class="bg-grey-darken-4" hide-details="auto"
          />
        </v-col>
        <v-col cols="2" class="px-0">
          <v-text-field type="date" v-model="componente.proxima_fecha" label="Prox. mantenimiento" 
            disabled class="bg-grey-darken-4" hide-details="auto"
          />
        </v-col>
        <v-col cols="1" clas="pr-0">
          <v-btn v-if="!isEditing" icon="mdi-file-document" color="green">
            <v-icon>mdi-file-document</v-icon>
            <v-tooltip activator="parent" location="top">
              Acceder al perfil del componente
            </v-tooltip>
          </v-btn>
          <v-btn v-if="isEditing" icon="mdi-delete" color="red" @click="marcarParaEliminar(componente, i)">
          </v-btn>
        </v-col>
        <v-divider></v-divider>
      </v-row>
    </v-card-text>
  </v-card>
</template>

<script setup>
import { ref, defineProps, computed } from 'vue';
import { useRoute } from "vue-router";
import axios from 'axios';
import { direccionIP } from '@/global';
import AnadirComponente from './PerfilComponente/AnadirComponente.vue';

//Esto se borra cuando tenga los componentes originales
import { componentes } from '@/components/vListasDeRepuestosEjemplo.js';

const props = defineProps({
  componentesReal: {
    type: Object,
    required: true,
  },
});

const myIP = direccionIP;
const ipMaquina = useRoute();
const IP = ipMaquina.params.id;
const ipNormalizada = String(IP).padStart(3, '0');
const isEditing = ref(false)
const componenteLocal = ref(props.componentesReal?.data? { ...props.componentesReal.data } : {});
const listaComponentes = ref(componentes);

// debo cambiar el 001 al id de la maquina en cuestion
const componentesUbicados = computed(() => {
  return listaComponentes.value.filter(componente => componente.ubicacion === '001');
});
const componentesNOUbicados = computed(() => {
  return listaComponentes.value.filter(componente => componente.ubicacion !== '001');
});

const componentesU = computed(() => {
  return componenteLocal.value.filter(componente => componente && componente.ubicacion === ipNormalizada);
});
// const componentesNU = computed(() => {
//   return componentes.value.filter(componente => componente.ubicacion !== ipNormalizada);
// });


const toggleEditMode = () => {
  if (isEditing.value) {
    // this.guardarCambios();
  }
  isEditing.value = !isEditing.value;
};
const cancel = () => {
  isEditing.value = false;
};


</script>
  



