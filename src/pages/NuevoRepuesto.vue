<template>
  <v-card class="ma-3">
    <v-card-title>
      Agregar nuevo repuesto
    </v-card-title>
    <v-card-text>
      <v-container>
        <v-row>
          <v-col cols="4" class="bg-surface-light">
            <v-card>
              <v-card-title>Imagen</v-card-title>
              <v-card-text>
                <v-divider></v-divider>
              </v-card-text>
            </v-card>
          </v-col>
          <v-col cols="8" class="bg-surface-light">
            <v-card>
              <v-card-title>Detalles del repuesto</v-card-title>
              <v-card-text>
                <v-divider></v-divider>

                <v-form>
                  <v-row class="px-4 pt-7">
                    <v-col v-for="(item, i) in items" :cols="item.size" class="pa-0">
                      <v-text-field v-if="item.tipo === 'texto'"
                        :label="item.label"
                        :v-model="item.modelo"
                        density="compact"
                      ></v-text-field>
                      <v-select v-else-if="item.tipo === 'seleccion'"
                        :label="item.label"
                        :v-model="item.modelo"
                        density="compact"
                      ></v-select>


                      <v-dialog v-else-if="item.tipo === 'boton' && item.modelo === 'nuevo'" max-width="500">
                        <template v-slot:activator="{ props: activatorProps }">
                          <v-btn v-bind="activatorProps"
                            :text="item.texto"
                            :prepend-icon="item.icono"
                            color="primary">
                          </v-btn>
                        </template>
                        <template v-slot:default="{ isActive }"> 
                          <v-card title="Agregar categoria">
                            <v-card-text>
                              <v-row>
                                <v-col cols="12"><v-text-field label="Nombre"></v-text-field></v-col>
                                <v-col cols="12"><v-text-field label="Descripcion"></v-text-field></v-col>
                              </v-row>
                            </v-card-text>
                            <v-card-actions>
                              <v-spacer></v-spacer>
                              <v-btn text="Hecho" @click="isActive.value = false" color="blue"></v-btn>
                            </v-card-actions>
                          </v-card>
                        </template>
                      </v-dialog>

                      <v-dialog v-else-if="item.tipo === 'boton' && item.modelo === 'examinar'" max-width="300">
                        <template v-slot:activator="{ props: activatorProps }">
                          <v-btn v-bind="activatorProps"
                            :text="item.texto"
                            :prepend-icon="item.icono"
                            color="primary">
                          </v-btn>
                        </template>
                        <template v-slot:default="{ isActive }"> 
                          <v-card title="Buscar imagen">
                            <v-card-text>
                            </v-card-text>
                            <v-card-actions>
                              <v-spacer></v-spacer>
                              <v-btn text="Hecho" @click="isActive.value = false" color="blue"></v-btn>
                            </v-card-actions>
                          </v-card>
                        </template>
                      </v-dialog>


                    </v-col>
                  </v-row>
                </v-form>

                
              </v-card-text>
              <v-card-actions style="display: flex; align-items: center; justify-content: center; gap: 50%;">
                <v-btn color="primary" to="/inventario">Cancelar</v-btn>
                <v-btn color="primary">Guardar</v-btn>
              </v-card-actions>
            </v-card>
          </v-col>
        </v-row>
      </v-container>
    </v-card-text>
  </v-card>
</template>


<script>
export default {
  data() {
    return {
      isActive: false,
      form: {
        nombre: '',
        descripcion: '',
        categoria: null,
        modelo: '',
        fabricante: '',
        imagen: null,
      },
      items: [
        { tipo: 'texto', label: 'Nombre', modelo: 'nombre', size: 12 },
        { tipo: 'texto', label: 'Descripcion', modelo: 'descripcion', size: 12 },
        { tipo: 'seleccion', label: 'Categoria', modelo: 'categoria', size: 4 },
        { tipo: 'boton', texto: 'Nuevo', modelo: 'nuevo', size: 8, icono: 'mdi-plus' },
        { tipo: 'texto', label: 'Modelo', modelo: 'modelo', size: 12 },
        { tipo: 'texto', label: 'Fabricante', modelo: 'fabricante', size: 12 },
        { tipo: 'texto', label: 'Seleccione una imagen', modelo: 'imagen', size: 8 },
        { tipo: 'boton', texto: 'Examinar...', modelo: 'examinar', size: 3, icono: 'mdi-magnify' },        
      ]
    }
  }
}
</script>