<template>
  <div class="contenedor">
    <div class="contenido">
      <div class="notificaciones">

{{ new Date().getDate()}}/{{new Date().getMonth()+1}}/{{ new Date().getFullYear()}}
          <v-container>
    <v-row justify="space-around">
      <v-date-picker
      v-model="date"
      :allowed-dates="allowedDates"
      max="3000-03-20"
      min="1970-06-15"
      >
    </v-date-picker>

    </v-row>
  </v-container>


      </div>
      <template>
        <v-container>
          <v-row justify="center">
            <v-date-picker width="400"></v-date-picker>
          </v-row>
        </v-container>
      </template>
      </div>


    <div class="historial">
      <h1>HISTORIAL</h1>
      <div class="listado">

      </div>
      <h3>Ver mas</h3>
    </div>
  </div>
</template>



<script setup>

import { ref } from 'vue'
import dayjs from 'dayjs';
import '../../node_modules/dayjs/locale/es'; // Importa el idioma español
import localizedFormat from 'dayjs/plugin/localizedFormat';

// Configura dayjs para usar el idioma español
dayjs.locale('es');
dayjs.extend(localizedFormat);

const date = ref(dayjs('YYYY-MM-DD').toDate());

const allowedDates = val => {
  // Asegúrate de que val es un valor interpretable por dayjs
  return true;
};
</script>



<style scoped>
  .contenedor{
    padding: 0 0 0 20%;
    width: 100%;
    height: 100%;
    display: flex;
  }
  .contenido{
    width: 75%;
    height: 100%;
    background-color: burlywood;
  }
  .notificaciones{
    padding: 2% 2% 0 2%;
    width: 100%;
    height: 85%;
    background-color: darkgoldenrod;
  }
  .historial{
    padding-top: 1%;
    width: 25%;
    height: 100%;
    background-color: rgb(60, 60, 60);
    h1,h3 {
      text-align: center;
    }
  }
  .listado{
    width: 100%;
    height: 80%;
    background-color: darkgreen;
  }
  .botones{
    display: flex;
    width: 100%;
    height: 15%;
    background-color: deeppink;
    align-items: center;
    justify-content: center;
    gap: 10%;
  }

</style>
