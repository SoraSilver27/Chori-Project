<template>
  <v-container>
    <v-row>
      <v-col v-for="item in list" :key="item.title" cols="12">
        <v-card class="bg-surface-light pa-1">
          <v-list-item>
            <template v-if="item.curso===1" v-slot:prepend>
              <!-- Avatar e ícono pueden cambiar según el tipo -->
              <v-avatar color=green>
                <v-icon>mdi-clock-outline</v-icon>
              </v-avatar>
            </template>
            <template v-else v-slot:prepend>
              <!-- Avatar e ícono pueden cambiar según el tipo -->
              <v-avatar :color="getAvatarColor(item.type)">
                <v-icon>{{ getIcon(item.type) }}</v-icon>
              </v-avatar>
            </template>

            <!-- Estructura diferente según el tipo de item -->
            <div v-if="item.type === 'maquina'">
              <v-list-item class="text-h6 py-0" title="Mantenimiento"
                :subtitle="`La máquina: ${item.title} requiere mantenimiento el ${item.fecha}.`">
              </v-list-item>
            </div>
            <div v-if="item.type === 'componente'">
              <v-list-item class="text-h6 py-0" title="Mantenimiento"
                :subtitle="`El componente: ${item.title} requiere mantenimiento el ${item.fecha}.`">
              </v-list-item>
            </div>
            <div v-else-if="item.type === 'stock'">
              <v-list-item class="text-h6 py-0" title="Stock"
                :subtitle="`El repuesto: ${item.title} escasea. Actualmente ${item.cantidad} en el inventario.`">
              </v-list-item>
            </div>
            <div v-else-if="item.type === 'orden'">
              <v-list-item-content>
                <v-list-item class="text-h6 py-0" :title="`Orden de ${item.ordenes}`"
                  :subtitle="`De: ${item.title}. A: ${item.encargado}`">
                </v-list-item>
                <v-list-item :subtitle="`${item.descripcion}`"></v-list-item>
              </v-list-item-content>
            </div>

            <template v-slot:append >
              <v-list-content>
                <v-list-item class="pa-0">
                  <template v-slot:append>
                    <v-list-item v-if="item.fijado === 1" class="pa-0">
                      <v-chip>
                        <v-icon style="transform: rotate(45deg);">mdi-pin-outline</v-icon>
                      </v-chip>
                    </v-list-item>
                  </template>
                  <v-list-item v-if="item.curso === 1" class="pa-0">
                    <v-chip>
                      En curso
                    </v-chip>
                  </v-list-item>
                </v-list-item>

                <v-menu open-on-hover>
                  <template  v-slot:activator="{props}" v-slot:append>
                    <div class="d-flex justify-end">
                      <v-btn :to="item.path" color="grey" v-bind="props">Acción</v-btn>
                    </div>
                  </template>
                  <v-list>
                    <v-list-item @click="verCurso(item)">
                      <v-list-item-title>
                        {{ item.curso === 1 ? "Dermarcar" : "Marcar en curso" }}
                      </v-list-item-title>
                    </v-list-item>
                    <v-list-item @click="verFijado(item)">
                      <v-list-item-title>
                        {{ item.fijado === 1 ? "Desfijar" : "Fijar" }}
                      </v-list-item-title>
                    </v-list-item>
                    <v-list-item>
                      <v-list-item-title>Acceder</v-list-item-title>
                    </v-list-item>
                    <v-list-item v-if="item.type !== 'orden'">
                      <v-list-item-title>Orden de trabajo</v-list-item-title>
                    </v-list-item>
                    <v-list-item v-if="item.curso === 1 || item.type === 'orden'">
                      <v-list-item-title>Finalizar</v-list-item-title>
                    </v-list-item>
                  </v-list>
                </v-menu>
              </v-list-content>
            </template>

          </v-list-item>
        </v-card>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
export default {
  props: {
    list: {
      type: Array,
      required: true
    }
  },
  methods: {
    getAvatarColor(type) {
      // Cambiar el color del avatar según el tipo
      if (type === 'stock') return 'red';
      if (type === 'orden') return 'blue';
      return 'orange';
    },
    getIcon(type) {
      // Cambiar el ícono según el tipo
      if (type === 'orden') return 'mdi-clipboard-text';
      if (type === 'stock') return 'mdi-package-variant';
      return 'mdi-alert-circle';
    },
    verFijado(item){
      //item.fijado = item.fijado === 1 ? 0 : 1;
      if (item.fijado === 1) {
        item.fijado = 0
        localStorage.setItem(item.title+"_fijado", 0)
      } else {
        item.fijado = 1
        localStorage.setItem(item.title+"_fijado", 1)
      }
    },
    verCurso(item){
      //item.curso = item.curso === 1 ? 0 : 1;
      if (item.curso === 1) {
        item.curso = 0
        localStorage.setItem(item.title+"_curso", 0)
      } else {
        item.curso = 1
        localStorage.setItem(item.title+"_curso", 1)
      }
    }
  },
};
</script>

<style>

</style>
