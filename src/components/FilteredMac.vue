<template>
  <v-container>
    <v-row>
      <v-col v-for="item in lista":key="item.nombre" cols="6">
        <v-card class="bg-surface-light pa-2">
          <v-list-item>
            <!-- Estructura diferente según el tipo de item -->
            <div>
              <v-list-item class="text-h6 py-0" :title="`${item.nombre}`"
                :subtitle="`Numero de serie: ${item.numero_de_serie}. ${item.observaciones_generales}.`">
              </v-list-item>
            </div>
            <template v-slot:append>
              <v-chip v-if="item.estado === 'en_uso'" color="blue">En uso</v-chip>
              <v-chip v-else-if="item.estado === 'disponible'" color="yellow">Disponible</v-chip>
              <v-chip v-else-if="item.estado === 'indisponible'" color="red">Indisponible</v-chip>
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
    lista: {
      type: Array,
      required: true
    }
  }
}
</script>

<style>

</style>
