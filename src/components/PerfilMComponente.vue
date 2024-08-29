<template>
    <v-container>
        <v-card>
            <v-row v-for="(componente, i) in componentes" :key="i">
                <v-col cols="3">{{ componente.nombre }}</v-col>
                <v-col cols="2">{{ componente.serie }}</v-col>
                <v-col cols="2">{{ componente.modelo }}</v-col>
                <v-col cols="3">{{ componente.descripcion }}</v-col>
                <v-col cols="2"><v-text-field type="date" label="Ultimo manteniento"></v-text-field></v-col>
            </v-row>
        </v-card>
    </v-container>
</template>

<script>
export default {
  data() {
    return {
      componentes: [
        {nombre: '', serie: '', modelo: '', ultima_fecha: '', proxima_fecha: '', descripcion: ''}
      ]
    }
  },
}
</script>