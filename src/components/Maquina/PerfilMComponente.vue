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
                <AnadirComponente 
                  :actualCompSelector="actualCompSelector"
                />
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
        <v-btn color="primary" prepend-icon="mdi-pencil" @click="toggleEditMode">
          {{ isEditing ? 'Guardar' : 'Editar' }}
        </v-btn>

      </v-col>
    </v-card-title>


    <v-card-text class="pt-3">
      <v-row v-for="(componente, i) in actualComp" :key="i">
        <v-col cols="3" class="pr-0">
          <v-text-field v-model="componente.nombre" label="Nombre"
            :disabled="!isEditing" class="bg-grey-darken-4" hide-details="auto"
          />
        </v-col>
        <v-col cols="2" class="px-0">
          <v-text-field v-model="componente.numero_de_serie"  label="Numero de Serie"
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
import { ref, defineProps, computed, watch } from 'vue';
import { useRoute } from "vue-router";
import { direccionIP } from '@/global';
import AnadirComponente from './PerfilComponente/AnadirComponente.vue';

const props = defineProps({
  actualComp: {
    type: Array,
    required: true,
  },
  actualCompSelector: {
    type: Array,
    required: true,
  },
});

const myIP = direccionIP;
const ipMaquina = useRoute();
const ID = ipMaquina.params.id;
const isEditing = ref(false)

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
  



