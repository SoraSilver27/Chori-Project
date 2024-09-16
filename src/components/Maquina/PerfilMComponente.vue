<template>
  <v-container class="ma-0 py-0 px-1">
    <v-card class="bg-surface-light ">
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
                  <AnadirComponente/>
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
        <v-row v-for="(componente, i) in paraProbar" :key="i">
          <v-col cols="3" style="display: flex; align-items: center;">{{ componente.nombre }}</v-col>
          <v-divider vertical></v-divider>
          <v-col cols="2" style="display: flex; align-items: center;">{{ componente.serie }}</v-col>
          <v-divider vertical></v-divider>
          <v-col cols="2" style="display: flex; align-items: center;">{{ componente.modelo }}</v-col>
          <v-col cols="2" class="pr-0">
            <v-text-field type="date" label="Último mantenimiento" hide-details="auto" disabled>
                {{ componente.ultima_fecha }}
            </v-text-field>
          </v-col>
          <v-col cols="2" class="pr-0">
            <v-text-field type="date" label="Próximo mantenimiento" hide-details="auto" disabled>
              {{ componente.proxima_fecha }}
            </v-text-field>
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
  </v-container>
</template>

<script>
import axios from 'axios';
import { direccionIP } from '@/global';
import AnadirComponente from './PerfilComponente/AnadirComponente.vue';

export default {
  data() {
    return {
      myIP: direccionIP,
      isEditing: false,
      componentes: [], // Array vacío para los componentes que se obtendrán de la API
      componentesBackup: [], // Array para almacenar una copia de los componentes
      maquinaId: 1, // Cambia esto según la máquina que desees consultar
      componentesAEliminar: [], // Array para almacenar componentes a eliminar        
      paraProbar: [
      {nombre: 'Componente 1', serie: 'asgha', modelo: 'ASE13', ultima_fecha: '', proxima_fecha: '', descripcion: 'Esto es una prueba para verificar'},
      {nombre: 'Componente 2', serie: 'adaw3', modelo: 'ADA23', ultima_fecha: '', proxima_fecha: '', descripcion: 'A ver que tal es esta cosa'},
      {nombre: 'Componente 3', serie: 'boqhe', modelo: 'BYJK6', ultima_fecha: '', proxima_fecha: '', descripcion: 'Vamos a escribir algo para ver'},
      ]
    }
  },
  mounted() {
    this.fetchComponentes();
  },
  methods: {
    async fetchComponentes() {
      try {
        const response = await axios.get(`${this.myIP}/api/v1/maquinas/${this.maquinaId}/componentes`);
        this.componentes = response.data;
        this.componentesBackup = JSON.parse(JSON.stringify(this.componentes)); // Crear copia profunda
      } catch (error) {
        console.error("Hubo un error al obtener los componentes:", error);
      }
    },
    marcarParaEliminar(componente, i) {
      this.componentesAEliminar.push(componente); // Agregar el componente a la lista de eliminaciones
      this.componentes.splice(i, 1); // Removerlo de la lista visible
    },
    async guardarCambios() {
      try {
        for (let componente of this.componentesAEliminar) {
        await axios.put(`http://192.168.12.247:8000/api/v1/componentes/${componente.id}/desvincular`);
        }
        for (let componente of this.componentes) {
        await axios.put(`http://192.168.12.247:8000/api/v1/componentes/${componente.id}`, componente);
        }
        this.componentesAEliminar = []; // Limpiar la lista de eliminaciones después de guardar
        console.log('Datos guardados correctamente.');
      } catch (error) {
        console.error("Hubo un error al guardar los cambios:", error);
      }
    },
    toggleEditMode() {
      if (this.isEditing) {
        this.guardarCambios();
      }
      this.isEditing = !this.isEditing;
    },
    guardarCambios() {
      console.log('Datos guardados:', this.componentes);
      // Aquí puedes implementar la lógica para guardar los cambios, como hacer una llamada a una API.
    },
    cancel() {
      this.isEditing = false;
      this.componentes = JSON.parse(JSON.stringify(this.componentesBackup)); // Restaurar la copia de seguridad
      this.componentesAEliminar = []; // Limpiar lista de eliminaciones
    }
  }
}
</script>
  



