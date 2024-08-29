<template>
    <v-card class="bg-green pa-3" style="height: 100%; width: 100%;">
      <v-card-title class="pa-7">
        <v-row>
            <p>Informacion de la maquina</p>
          <v-spacer></v-spacer>
          <div>
            <v-btn @click="handleCancel">Cancelar</v-btn>
            <v-btn @click="handleSubmit">Guardar</v-btn>
          </div>
        </v-row>
      </v-card-title>
      <v-card-text class="py-2">
        <v-form @submit.prevent="handleSubmit" style="width: 100%; height: 100%;">
          <v-row>
            <!-- Primera carta -->
            <v-col cols="7">
              <v-card>
                <v-list class="bg-surface-light pb-0">
                  <v-list-item v-for="(fila,index) in filas" :key="index">
                    <v-row>
                      <v-col v-for="(columna, i) in fila.columnas" :key="i" :cols="columna.size">
                        <v-text-field
                          v-if="columna.component === 'v-text-field'"
                          v-model="form[columna.model]"
                          :rules="getRules(columna)"
                          :disabled="getDisabled(columna)"
                          v-bind="columna.props"
                        ></v-text-field>
                        <v-select
                          v-else-if="columna.component === 'v-select'"
                          v-model="form[columna.model]"
                          :rules="getRules(columna)"
                          :items="getItems(columna)"
                          v-bind="columna.props"
                        ></v-select>
                        <v-list-item
                          v-else-if="columna.component === 'v-list-item'"
                          class="pa-1"
                        >
                          Fecha de adquisicion:
                        </v-list-item>
                        <v-checkbox-btn v-else v-model="form[columna.model]">
                          <template v-slot:label>{{ columna.text }}</template>
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
  
  <script>
  import axios from "axios";
  
  export default {
    data() {
      return {
        form: {
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
        },
        tipos: [
          "Hidraulica",
          "Electrica",
          "Neumatica",
          "Mecanica",
          "Termica",
          "Electronica",
          "Quimica",
          "Alimentaria",
        ],
        estados: ["en_uso", "disponible", "indisponible"],
        nameRules: [
          (value) => (value ? true : "Por favor ingrese un nombre"),
          (value) =>
            value.length <= 30 ? true : "El nombre debe ser menor a 30 caracteres",
        ],
        rules: [(value) => (value ? true : "Campo obligatorio")],
        filas: [
          {
            columnas: [
              {
                model: "nombre",
                component: "v-text-field",
                size: 12,
                props: { counter: 30, label: "Nombre", density: "comfortable" },
              },
            ],
          },
          {
            columnas: [
              {
                model: "numero_de_serie",
                component: "v-text-field",
                size: 7,
                props: {
                  counter: 15,
                  label: "Identificador",
                  density: "comfortable",
                },
              },
              {
                model: "modelo",
                component: "v-text-field",
                size: 5,
                props: { counter: 10, label: "Modelo", density: "comfortable" },
              },
            ],
          },
          {
            columnas: [
              { component: "v-list-item", size: 3 },
              {
                model: "fecha_adquisicion",
                component: "v-text-field",
                size: 5,
                props: { label: "Fecha", type: "date", density: "comfortable" },
              },
              {
                model: "estado",
                component: "v-select",
                size: 4,
                props: { label: "Estado", density: "comfortable" },
              },
            ],
          },
          {
            columnas: [
              {
                model: "selecttip",
                component: "v-select",
                size: 4,
                props: { label: "Tipo", density: "comfortable" },
              },
              {
                model: "voltaje",
                component: "v-text-field",
                size: 4,
                props: { label: "Voltaje", density: "comfortable" },
              },
              {
                model: "peso",
                component: "v-text-field",
                size: 4,
                props: { label: "Peso", density: "comfortable" },
              },
            ],
          },
          {
            columnas: [
              {
                model: "velocidad",
                component: "v-checkbox-btn",
                size: 4,
                text: "Velocidad ajustable",
              },
              {
                model: "desmontaje",
                component: "v-checkbox-btn",
                size: 8,
                text: "Facilidad de desmontaje",
              },
            ],
          },
          {
            columnas: [
              {
                model: "pantalla",
                component: "v-checkbox-btn",
                size: 4,
                text: "Pantalla digital",
              },
              {
                model: "enabled",
                component: "v-checkbox-btn",
                size: 3,
                text: "Garantia",
              },
              {
                model: "cantidad",
                component: "v-text-field",
                size: 5,
                props: { label: "Cantidad" },
              },
            ],
          },
        ],
        cartas: [
          { model: "seguridad", title: "Sistema de seguridad:" },
          { model: "ubicacion", title: "Ubicacion:" },
          { model: "observaciones_generales", title: "Mas informacion:" },
        ],
      };
    },
  
    methods: {
      getItems(columna) {
        if (columna.model === "selecttip") {
          return this.tipos;
        } else if (columna.model === "estado") {
          return this.estados;
        }
        return [];
      },
      getRules(columna) {
        if (columna.model === "nombre") {
          return this.nameRules;
        } else if (columna.model === "modelo") {
          return this.rules;
        } else if (columna.model === "selectest") {
          return this.rules;
        }
        return [];
      },
      getDisabled(columna) {
        if (columna.model === "cantidad") {
          return !this.form.enabled;
        }
        return false;
      },
      async handleSubmit() {
        const formData = {
          nombre: this.form.nombre,
          numero_de_serie: this.form.numero_de_serie,
          estado: this.form.estado,
          modelo: this.form.modelo,
          en_seguimiento: this.form.enabled ? 1 : 0,
          fecha_adquisicion: this.form.fecha_adquisicion,
          observaciones_generales: this.form.observaciones_generales,
        };
  
        try {
          const response = await axios.post(
            "http://192.168.12.247:8000/api/v1/maquinarias",
            formData
          );
          console.log("Datos enviados con éxito:", response.data);
        } catch (error) {
          console.error("Error al enviar los datos:", error.response.data);
        }
      },
      handleCancel() {
        // Lógica para cancelar o resetear el formulario
        this.form = {
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
      },
    },
  };
  </script>
  