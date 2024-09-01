<template>
  <v-card>
    <v-card-text v-for="carta in cartas">
      <v-row>
        <v-col :cols="fila.size" v-for="(fila, i) in carta.filas">{{ fila.model }}</v-col>
      </v-row>
    </v-card-text>
  </v-card>
</template>
<script>
export default {
  data() {
    return{
      cartas: [
        {filas:[
          { model: 'nombreMaquina', component: 'textField', size: 9, class: 'pb-0', props:{label:'Nombre'} },
          { model: 'nombreMaquina', component: 'textField', size: 3, class: 'pb-0', props:{label:'Nombre'} },
          { model: 'nombreMaquina', component: 'textField', size: 3, class: 'pb-0', props:{label:'Nombre'} },
          { model: 'nombreMaquina', component: 'textField', size: 9, class: 'pb-0', props:{label:'Nombre'} },
          { model: 'nombreMaquina', component: 'textField', size: 5, class: 'pb-0', props:{label:'Nombre'} },
          { model: 'nombreMaquina', component: 'textField', size: 7, class: 'pb-0', props:{label:'Nombre'} },
          { model: 'nombreMaquina', component: 'textField', size: 6, class: 'pb-0', props:{label:'Nombre'} },
          { model: 'nombreMaquina', component: 'textField', size: 6, class: 'pb-0', props:{label:'Nombre'} },
          { model: 'nombreMaquina', component: 'textField', size: 12, class: 'pb-0', props:{label:'Nombre'} },
        ]}
      ]
    }
  }
}
// {
//   "nombre": "Cortadora",
//   "numero_de_serie": "CT-05",
//   "estado": "disponible",
//   "modelo": "LLK24",
//   "en_seguimiento": 0,
//   "fecha_adquisicion": "2024-12-12",
//   "observaciones_generales": "algo",
// }

</script>