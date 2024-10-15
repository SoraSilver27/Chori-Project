<template>
  <v-container>
    <v-card>
      <v-card-title style="display: flex; align-items: center;" class="pa-5">
        <v-row>
          <v-col cols="9">
            Informacion de la maquina
          </v-col>
          <v-col cols="3" class="pa-2 text-end">
            <v-btn to="/maquinas" color="primary" class="mr-4">Cancelar</v-btn>
            <v-btn @click="handleSubmit" color="primary">Guardar</v-btn>
          </v-col>
        </v-row>
      </v-card-title>
      <v-card-text>
        <v-form>
          <v-row>
            <v-col cols="6">
              <PerfilInfo
                :local="form"
                :filas="filas"
                :isEditing="isEditing"
              />
            </v-col>
            <v-col cols="6">
              <PerfilInfo
                :local="formDos"
                :filas="filasDos"
                :isEditing="isEditing"
              />
            </v-col>
          </v-row>
        </v-form>
      </v-card-text>
    </v-card>
  </v-container>
</template>

<script setup>
import { ref, computed } from 'vue';
import axios from 'axios';
import { direccionIP } from "@/global";
import { VCheckbox, VSelect, VTextarea, VTextField } from 'vuetify/components';
import PerfilInfo from '@/components/PerfilInfo.vue';

const myIP = ref(direccionIP);
const isEditing = ref(true);

const form = ref({
  nombre: "",
  numero_de_serie: "",
  modelo: "",
  fecha_adquisicion: "",
  estado: null,
  observaciones_generales: "",
});
const formDos = ref({
  tipo: null,
  voltaje: "",
  peso: "",
  velocidad_ajustable: false,
  facil_desmontaje: false,
  pantalla_digital: false,
  garantia: false,
  garantia_cantidad: "",
  seguridad: "",
  ubicacion: "",
});

const tipos = ref([
  "Ninguno",
  "Hidraulica",
  "Electrica",
  "Neumatica",
  "Mecanica",
  "Termica",
  "Electronica",
  "Quimica",
  "Alimentaria",
]);

const estados = ref(["En uso", "Disponible", "Indisponible"]);

const filas = [
  { model: "nombre", component: VTextField, size: 12, props: { counter: 30, label: "Nombre" } },
  { model: "numero_de_serie", component: VTextField, size: 7, props: { counter: 15, label: "Identificador" } },
  { model: "modelo", component: VTextField, size: 5, props: { counter: 10, label: "Modelo" } },
  { model: "fecha_adquisicion", component: VTextField, size: 5, props: { label: "Fecha de adquisicion", type: "date" } },
  { model: "estado", component: VSelect, size: 4, props: { label: "Estado", } },
  { model: "observaciones_generales", component: VTextarea, size: 12, ocultar: 'auto', props: { label: "Observaciones generales", rows: 2 } },
];

const filasDos = [
  { model: "tipo", component: VSelect, size: 4, ocultar: 'auto', props: { label: "Tipo" } },
  { model: "voltaje", component: VTextField, size: 4, ocultar: 'auto', props: { label: "Voltaje" } },
  { model: "peso", component: VTextField, size: 4, ocultar: 'auto', props: { label: "Peso" } },
  { model: "velocidad_ajustable", component: VCheckbox, size: 4, ocultar: 'auto', text: "Velocidad ajustable" },
  { model: "facil_desmontaje", component: VCheckbox, size: 8, ocultar: 'auto', text: "Facilidad de desmontaje" },
  { model: "pantalla_digital", component: VCheckbox, size: 4, ocultar: 'auto', text: "Pantalla digital" },
  { model: "garantia", component: VCheckbox, size: 3, ocultar: 'auto', text: "Garantia" },
  { model: "garantia_cantidad", component: VTextField, size: 5, ocultar: 'auto', props: { label: "Cantidad" } },
];

// // Methods
// const getItems = (fila) => {
//   if (fila.model === "tipo") {
//     return tipos.value;
//   } else if (fila.model === "estado") {
//     return estados.value;
//   }
//   return [];
// };

// const getRules = (fila) => {
//   if (fila.model === "nombre") {
//     return nameRules;
//   } else if (fila.model === "modelo") {
//     return rules;
//   } else if (fila.model === "selectest") {
//     return rules;
//   }
//   return [];
// };


const handleSubmit = async () => {
  const formData = {
    nombre: form.value.nombre,
    numero_de_serie: form.value.numero_de_serie,
    estado: form.value.estado,
    modelo: form.value.modelo,
    en_seguimiento: form.value.garantia ? 1 : 0,
    fecha_adquisicion: form.value.fecha_adquisicion,
    observaciones_generales: form.value.observaciones_generales,
  };

  try {
    const response = await axios.post(`${myIP.value}/api/maquinarias`, formData);
    console.log("Datos enviados con éxito:", response.data);
    alert('Datos guardados correctamente');
  } catch (error) {
    console.error("Error al enviar los datos:", error.response.data);
    alert('Error al enviar los datos');
  }
};

</script>

