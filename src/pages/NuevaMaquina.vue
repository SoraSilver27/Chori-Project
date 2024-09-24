<template>
  <v-card class="pa-3" style="height: 100%; width: 100%;">
    <v-card-title style="display: flex; align-items: center;" class="px-3 py-0">
      Informacion de la maquina
      <v-col class="pa-2 text-end">
        <v-btn @click="handleCancel" color="primary" class="mr-4">Cancelar</v-btn>
        <v-btn @click="handleSubmit" color="primary">Guardar</v-btn>
      </v-col>
    </v-card-title>
    <v-card-text class="py-2">
      <v-form @submit.prevent="handleSubmit" style="width: 100%; height: 100%;">
        <v-row>
          <!-- Primera carta -->
          <v-col cols="7">
            <v-card>
              <v-list class="bg-surface-light pb-0">
                <v-list-item>
                  <v-row>
                    <v-col v-for="(fila,index) in filas" :key="index" :cols="fila.size">
                      <v-text-field
                        v-if="fila.component === 'v-text-field'"
                        v-model="form[fila.model]"
                        :rules="getRules(fila)"
                        :disabled="getDisabled(fila)"
                        v-bind="fila.props"
                      ></v-text-field>
                      <v-select
                        v-else-if="fila.component === 'v-select'"
                        v-model="form[fila.model]"
                        :rules="getRules(fila)"
                        :items="getItems(fila)"
                        v-bind="fila.props"
                      ></v-select>
                      <v-list-item
                        v-else-if="fila.component === 'v-list-item'"
                        class="pa-1">
                        Fecha de adquisicion:
                      </v-list-item>
                      <v-checkbox-btn v-else v-model="form[fila.model]">
                        <template v-slot:label>{{ fila.text }}</template>
                      </v-checkbox-btn>
                    </v-col>
                  </v-row>
                </v-list-item>
              </v-list>
            </v-card>
          </v-col>
          <!-- Segunda carta -->
          <v-col cols="5">
            <v-card>
              <v-list class="bg-surface-light">
                <v-list-item
                  v-for="(carta, n) in cartas"
                  :key="n"
                  class=""
                  :title="carta.title"
                >
                  <v-textarea
                    v-model="form[carta.model]"
                    :counter="200"
                    rows="2"
                    variant="outlined"
                  ></v-textarea>
                </v-list-item>
              </v-list>
            </v-card>
          </v-col>
        </v-row>
      </v-form>
    </v-card-text>
  </v-card>
</template>

<script setup>
import { ref, computed } from 'vue';
import axios from 'axios';
import { direccionIP } from "@/global";

// Reactive state
const myIP = ref(direccionIP);
const form = ref({
  nombre: "",
  numero_de_serie: "",
  modelo: "",
  fecha_adquisicion: "",
  estado: null,
  selecttip: null,
  voltaje: "",
  peso: "",
  velocidad: false,
  ajustable: false,
  pantalla: false,
  enabled: false,
  cantidad: "",
  seguridad: "",
  ubicacion: "",
  observaciones_generales: "",
});

const tipos = ref([
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

const nameRules = [
  (value) => (value ? true : "Por favor ingrese un nombre"),
  (value) => (value.length <= 30 ? true : "El nombre debe ser menor a 30 caracteres"),
];

const rules = [(value) => (value ? true : "Campo obligatorio")];

const filas = ref([
  { model: "nombre", component: "v-text-field", size: 12, props: { counter: 30, label: "Nombre", density: "comfortable" } },
  { model: "numero_de_serie", component: "v-text-field", size: 7, props: { counter: 15, label: "Identificador", density: "comfortable" } },
  { model: "modelo", component: "v-text-field", size: 5, props: { counter: 10, label: "Modelo", density: "comfortable" } },
  { component: "v-list-item", size: 3 },
  { model: "fecha_adquisicion", component: "v-text-field", size: 5, props: { label: "Fecha", type: "date", density: "comfortable" } },
  { model: "estado", component: "v-select", size: 4, props: { label: "Estado", density: "comfortable" } },
  { model: "selecttip", component: "v-select", size: 4, props: { label: "Tipo", density: "comfortable" } },
  { model: "voltaje", component: "v-text-field", size: 4, props: { label: "Voltaje", density: "comfortable" } },
  { model: "peso", component: "v-text-field", size: 4, props: { label: "Peso", density: "comfortable" } },
  { model: "velocidad", component: "v-checkbox-btn", size: 4, text: "Velocidad ajustable" },
  { model: "desmontaje", component: "v-checkbox-btn", size: 8, text: "Facilidad de desmontaje" },
  { model: "pantalla", component: "v-checkbox-btn", size: 4, text: "Pantalla digital" },
  { model: "enabled", component: "v-checkbox-btn", size: 3, text: "Garantia" },
  { model: "cantidad", component: "v-text-field", size: 5, props: { label: "Cantidad" } },
]);

const cartas = ref([
  { model: "seguridad", title: "Sistema de seguridad:" },
  { model: "ubicacion", title: "Ubicacion:" },
  { model: "observaciones_generales", title: "Mas informacion:" },
]);

// Methods
const getItems = (fila) => {
  if (fila.model === "selecttip") {
    return tipos.value;
  } else if (fila.model === "estado") {
    return estados.value;
  }
  return [];
};

const getRules = (fila) => {
  if (fila.model === "nombre") {
    return nameRules;
  } else if (fila.model === "modelo") {
    return rules;
  } else if (fila.model === "selectest") {
    return rules;
  }
  return [];
};

const getDisabled = (fila) => {
  if (fila.model === "cantidad") {
    return !form.value.enabled;
  }
  return false;
};

const handleSubmit = async () => {
  const formData = {
    nombre: form.value.nombre,
    numero_de_serie: form.value.numero_de_serie,
    estado: form.value.estado,
    modelo: form.value.modelo,
    en_seguimiento: form.value.enabled ? 1 : 0,
    fecha_adquisicion: form.value.fecha_adquisicion,
    observaciones_generales: form.value.observaciones_generales,
  };

  try {
    const response = await axios.post(`${myIP.value}/api/v1/maquinarias`, formData);
    console.log("Datos enviados con éxito:", response.data);
  } catch (error) {
    console.error("Error al enviar los datos:", error.response.data);
  }
};

const handleCancel = () => {
  // Lógica para cancelar o resetear el formulario
  form.value = {
    nombre: "",
    numero_de_serie: "",
    modelo: "",
    fecha_adquisicion: "",
    estado: null,
    selecttip: null,
    voltaje: "",
    peso: "",
    velocidad: false,
    ajustable: false,
    pantalla: false,
    enabled: false,
    cantidad: "",
    seguridad: "",
    ubicacion: "",
    observaciones_generales: "",
  };
};
</script>

