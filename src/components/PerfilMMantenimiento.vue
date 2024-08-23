<template>
  <v-container class="ma-0 pa-2">
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
          <v-row no-gutters v-for="(horasArray, periodo) in agrupadoPorPeriodo" :key="periodo" class="pa-1">
            <v-card class="bg-teal">
              <v-row class="pa-1">
                <v-col cols="1" class="pr-1">
                  <v-sheet class="pa-2 d-flex align-center fill-height">
                    {{ periodo }}
                  </v-sheet>
                </v-col>
                <v-divider vertical class="border-opacity-25" color="info"></v-divider>
                <v-col cols="9" class="px-1">
                  <v-row no-gutters v-for="horaObj in horasArray" :key="horaObj.horasUso">
                    <v-col cols="1">
                      <v-sheet class="pa-2 d-flex align-center fill-height">
                        {{ horaObj.horasUso }} horas
                      </v-sheet>
                    </v-col>
                    <v-divider vertical class="border-opacity-25" color="info"></v-divider>
                    <v-col cols="11">
                      <v-row no-gutters v-for="nombre in horaObj.nombres" :key="nombre">
                        <v-col cols="4">
                          <v-sheet  class="pa-2 fill-height">
                            {{ nombre }}
                          </v-sheet>
                        </v-col>
                        <v-divider vertical class="border-opacity-25" color="info"></v-divider>
                        <v-col cols="8">
                          <!-- Asumiendo que 'descripcion' se encuentra en 'componentesMaquina' -->
                            <v-sheet class="pa-2 d-flex align-center fill-height">
                            {{ componentesMaquina.find(c => c.nombre === nombre).descripcion }}
                          </v-sheet>
                        </v-col>
                        <v-divider class="border-opacity-25" color="info"></v-divider>
                      </v-row>
                    </v-col>
                    <v-divider class="border-opacity-25" color="info"></v-divider>
                  </v-row>
                </v-col>
                <v-divider vertical class="border-opacity-25" color="info"></v-divider>
                <v-col cols="2" class="pl-1">
                  <v-text-field density="compact" type="date" label="Ultimo Mant." hide-details="auto" class="bg-secondary"></v-text-field>
                  <v-text-field density="compact" type="date" label="Proximo Mant." hide-details="auto" class="bg-error"></v-text-field>
                </v-col>
                <v-divider class="border-opacity-25" color="info"></v-divider>
              </v-row>
            </v-card>
          </v-row>
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

// Variables reactivas
const isEditing = ref(false);
const componentesMaquina = ref([
  { nombre: 'Componente 1', periodo: 'Semanal', horasUso: 100, ultimo: '2024-07-10', proximo: '2024-07-17', descripcion: 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Fugit asperiores beatae at, maxime eveniet odit.' },
  { nombre: 'Componente 2', periodo: 'Mensual', horasUso: 480, ultimo: '2024-06-15', proximo: '2024-07-15', descripcion: 'Rerum fuga nisi dolorem aut explicabo doloribus. Voluptatem assumenda repudiandae tempore. Pariatur commodi aut at?' },
  { nombre: 'Componente 3', periodo: 'Quince.', horasUso: 240, ultimo: '2024-07-01', proximo: '2024-07-16', descripcion: 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Fugit asperiores beatae at, maxime eveniet odit.' },
  { nombre: 'Componente 4', periodo: 'Anual', horasUso: 8760, ultimo: '2024-01-01', proximo: '2025-01-01', descripcion: 'Rerum fuga nisi dolorem aut explicabo doloribus. Voluptatem assumenda repudiandae tempore. Pariatur commodi aut at?' },
  { nombre: 'Componente 5', periodo: 'Semanal', horasUso: 140, ultimo: '2024-07-08', proximo: '2024-07-15', descripcion: 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Fugit asperiores beatae at, maxime eveniet odit.' },
  { nombre: 'Componente 6', periodo: 'Mensual', horasUso: 480, ultimo: '2024-06-30', proximo: '2024-07-30', descripcion: 'Rerum fuga nisi dolorem aut explicabo doloribus. Voluptatem assumenda repudiandae tempore. Pariatur commodi aut at?' },
  { nombre: 'Componente 7', periodo: 'Trimes.', horasUso: 2160, ultimo: '2024-05-01', proximo: '2024-08-01', descripcion: 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Fugit asperiores beatae at, maxime eveniet odit.' },
  { nombre: 'Componente 8', periodo: 'Quince.', horasUso: 300, ultimo: '2024-07-05', proximo: '2024-07-20', descripcion: 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Fugit asperiores beatae at, maxime eveniet odit.' },
  { nombre: 'Componente 9', periodo: 'Quince.', horasUso: 100, ultimo: '2024-07-12', proximo: '2024-07-19', descripcion: 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Fugit asperiores beatae at, maxime eveniet odit.' },
  { nombre: 'Componente 10', periodo: 'Semes.', horasUso: 4320, ultimo: '2024-04-01', proximo: '2024-10-01', descripcion: 'Rerum fuga nisi dolorem aut explicabo doloribus. Voluptatem assumenda repudiandae tempore. Pariatur commodi aut at?' }
]);

// Computed properties
const agrupadoPorPeriodo = computed(() => {
  const agrupado = componentesMaquina.value.reduce((acc, componente) => {
    const { periodo, horasUso, nombre } = componente;
    if (!acc[periodo]) {
      acc[periodo] = [];
    }
    let entry = acc[periodo].find(item => item.horasUso === horasUso);
    if (entry) {
      entry.nombres.push(nombre);
    } else {
      acc[periodo].push({
        horasUso: horasUso,
        nombres: [nombre]
      });
    }
    return acc;
  }, {});

  for (const key in agrupado) {
    agrupado[key].sort((a, b) => a.horasUso - b.horasUso);
  }
  console.log(agrupado);
  return agrupado;
});

const periodoOptions = [
  'Semanal',
  'Quincenal',
  'Mensual',
  'Trimestral',
  'Semestral',
  'Anual'
];


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



<!-- <script>

export default {
  data() {
    return {
      isEditing: false,
      componentesMaquina: [
      { nombre: 'Componente 1', periodo: 7, horasUso: 100, ultimo: '2024-07-10', proximo: '2024-07-17', descripcion: 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Fugit asperiores beatae at, maxime eveniet odit.' },
      { nombre: 'Componente 2', periodo: 30, horasUso: 480, ultimo: '2024-06-15', proximo: '2024-07-15', descripcion: 'Rerum fuga nisi dolorem aut explicabo doloribus. Voluptatem assumenda repudiandae tempore. Pariatur commodi aut at?' },
      { nombre: 'Componente 3', periodo: 15, horasUso: 240, ultimo: '2024-07-01', proximo: '2024-07-16', descripcion: 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Fugit asperiores beatae at, maxime eveniet odit.' },
      { nombre: 'Componente 4', periodo: 365, horasUso: 8760, ultimo: '2024-01-01', proximo: '2025-01-01', descripcion: 'Rerum fuga nisi dolorem aut explicabo doloribus. Voluptatem assumenda repudiandae tempore. Pariatur commodi aut at?' },
      { nombre: 'Componente 5', periodo: 7, horasUso: 140, ultimo: '2024-07-08', proximo: '2024-07-15', descripcion: 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Fugit asperiores beatae at, maxime eveniet odit.' },
      { nombre: 'Componente 6', periodo: 30, horasUso: 480, ultimo: '2024-06-30', proximo: '2024-07-30', descripcion: 'Rerum fuga nisi dolorem aut explicabo doloribus. Voluptatem assumenda repudiandae tempore. Pariatur commodi aut at?' },
      { nombre: 'Componente 7', periodo: 90, horasUso: 2160, ultimo: '2024-05-01', proximo: '2024-08-01', descripcion: 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Fugit asperiores beatae at, maxime eveniet odit.' },
      { nombre: 'Componente 8', periodo: 15, horasUso: 300, ultimo: '2024-07-05', proximo: '2024-07-20', descripcion: 'Rerum fuga nisi dolorem aut explicabo doloribus. Voluptatem assumenda repudiandae tempore. Pariatur commodi aut at?' },
      { nombre: 'Componente 9', periodo: 15, horasUso: 100, ultimo: '2024-07-12', proximo: '2024-07-19', descripcion: 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Fugit asperiores beatae at, maxime eveniet odit.' },
      { nombre: 'Componente 10', periodo: 180, horasUso: 4320, ultimo: '2024-04-01', proximo: '2024-10-01', descripcion: 'Rerum fuga nisi dolorem aut explicabo doloribus. Voluptatem assumenda repudiandae tempore. Pariatur commodi aut at?' }
      ],
      opciones: "",
    }
  },
  computed: {
    agrupadoPorPeriodo() {
      const agrupado = this.componentesMaquina.reduce((acc, componente) => {
        const { periodo, horasUso, nombre } = componente;
        // Si el periodo no existe en el acumulador, lo inicializamos como un array vacío
        if (!acc[periodo]) {
          acc[periodo] = [];
        }
        // Verificamos si ya existe una entrada con el mismo `horasUso`
        let entry = acc[periodo].find(item => item.horasUso === horasUso);
        if (entry) {
          // Si ya existe, simplemente agregamos el nombre al array de nombres
          entry.nombres.push(nombre);
        } else {
          // Si no existe, creamos un nuevo objeto con `horasUso` y `nombres`
          acc[periodo].push({
            horasUso: horasUso,
            nombres: [nombre]
          });
        }
        return acc;
      }, {});
      // Ordenamos cada array por `horasUso`
      for (const key in agrupado) {
        agrupado[key].sort((a, b) => a.horasUso - b.horasUso);
      }
      console.log(agrupado);
      return agrupado;
    },
    periodoOptions() {
      const periodoMap = {
        7: 'Semanal',
        15: 'Quincenal',
        30: 'Mensual',
        90: 'Trimestral',
        180: 'Semestral',
        365: 'Anual'
      };
      // Crea un array con los valores text y value para el selector de periodo
      return Object.keys(periodoMap).map(key => ({
        text: periodoMap[key],
      }));
    }

  },
  methods: {
    toggleEditMode() {
      // if (this.isEditing) {
      //   // Guardar datos cuando se hace clic en 'Guardar'
      //   if (this.$refs.form.validate()) {
      //     this.isEditing = false;
      //   }
      // } else {
      //   this.isEditing = true;
      // }
      if (this.isEditing) {
        // Guardar cambios antes de salir del modo edición
        this.guardarCambios();
      }
      this.isEditing = !this.isEditing;
    },
    guardarCambios() {
      // Aquí debes implementar la lógica para guardar los cambios en la base de datos
      // Puedes hacer una llamada a una API para enviar los datos actualizados
      console.log('Datos guardados:', this.componentesMaquina);
      // Ejemplo de llamada a API:
      // this.$http.post('/api/guardar-componentes', this.componentesMaquina)
      //   .then(response => {
      //     console.log('Datos guardados correctamente');
      //   })
      //   .catch(error => {
      //     console.error('Error al guardar los datos:', error);
      //   });
    },
    cancel() {
      this.isEditing = !this.isEditing;
    }
  },
  mounted() {
    // Inicializa periodoOptions al montar el componente
    this.periodoOptions = this.periodoOptions;
  }
}
</script> -->
