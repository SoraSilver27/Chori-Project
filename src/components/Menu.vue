<template>
<v-navigation-drawer
        expand-on-hover
        rail
      >
        <v-list>
          <v-list-item
            prepend-avatar="https://w7.pngwing.com/pngs/235/916/png-transparent-maintenance-logo-car-repair-logo-cartoon.png"
            subtitle=""
            title="MantoMax"
          ></v-list-item>
        </v-list>

        <v-divider></v-divider>

        <v-list density="compact" nav>
          <v-list-item prepend-icon="mdi-home" title="Inicio" to="/"></v-list-item>
          <v-list-group value="Maquinaria">
            <template v-slot:activator="{ props }">
              <v-list-item v-bind="props" prepend-icon="mdi-domain" title="Maquinaria"></v-list-item>
            </template>
            <v-list-item
              v-for="([title, icon, path], i) in Maquinaria"
              :key="i"
              :prepend-icon="icon"
              :title="title"
              :value="title"
              :to="path"
            ></v-list-item>
          </v-list-group>
          <v-list-group value="Stock">
            <template v-slot:activator="{ props }">
              <v-list-item
                v-bind="props"
                prepend-icon="mdi-package-variant"
                title="Stock"
              ></v-list-item>
            </template>
            <v-list-item
              v-for="([title, icon, path], i) in Stock"
              :key="i"
              :prepend-icon="icon"
              :title="title"
              :value="title"
              :to="path"
            ></v-list-item>
          </v-list-group>
          <v-list-item prepend-icon="mdi-calendar" title="Calendario" to="/Calendario"></v-list-item>
        </v-list>
      </v-navigation-drawer>
</template>

<script scoped>
export default {
    data: () => ({
      Maquinaria: [
        ['Maquinas', 'mdi-monitor-dashboard', '/Maquinas'],
        ['Componentes', 'mdi-nut', '/Componentes'],
      ],
      Stock: [
        ['Facturas', 'mdi-file-document', '/Facturas'],
        ['Inventario', 'mdi-widgets', '/Inventario'],
      ],
    }),
  }
</script>
