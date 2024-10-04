<!-- codigo del index -->

<template>
  <div class="contenedor">
    <div class="contenido">
      <div class="notificaciones">
        <v-card>
          <v-tabs v-model="tab" fixed-tabs color="primary">
            <v-tab :value="1" prepend-icon="mdi-alert">Todo</v-tab>
            <v-tab :value="2" prepend-icon="mdi-message-text">Ordenes</v-tab>
            <v-tab :value="3" prepend-icon="mdi-tools">Mantenimientos</v-tab>
            <v-tab :value="4" prepend-icon="mdi-archive-alert">Stock</v-tab>
          </v-tabs>

          <v-card-text class="caja pa-2">
            <v-tabs-window v-model="tab">
              <v-tabs-window-item :value="1">
                <FilteredList :list="filteredList" />
              </v-tabs-window-item>

              <v-tabs-window-item :value="2">
                <FilteredList :list="filteredList" />
              </v-tabs-window-item>

              <v-tabs-window-item :value="3">
                <FilteredList :list="filteredList" />
              </v-tabs-window-item>

              <v-tabs-window-item :value="4">
                <FilteredList :list="filteredList" />
              </v-tabs-window-item>
            </v-tabs-window>
          </v-card-text>
        </v-card>
      </div>

      <div class="botones">
        <v-btn class="btn" prepend-icon="mdi-plus" size="large">
          Nuevo Registro
        </v-btn>
        <v-btn class="btn" prepend-icon="mdi-plus" size="large">
          Nueva Orden
        </v-btn>
      </div>
    </div>


    <div class="historial">
      <h1>HISTORIAL</h1>
      <v-divider :thickness="2" class="border-opacity-50" color="red"></v-divider>
      <div class="listado">
        <NotHistorial :list="notHistorial"/>
      </div>
      <v-divider :thickness="2" class="border-opacity-50" color="red"></v-divider>
      <h3>Ver mas</h3>
    </div>
  </div>
</template>



<script>
import FilteredList from '@/components/index/FilteredList.vue';
import NotHistorial from '@/components/index/NotHistorial.vue';

export default {
  components: {
    FilteredList,
  },
  data() {
    return {
      tab: 1, // Pestaña activa inicial
      one: 1,
      two: 2,
      three: 3,
      four: 4,
      maintenanceList: [
        {
          title: "Compresor", fecha: "01/09/24", type: "maquina",
          curso: JSON.parse(localStorage.getItem("Compresor_curso")),
          fijado: JSON.parse(localStorage.getItem("Compresor_fijado"))
        },
        { title: "Stock 3", cantidad: 5, type: "stock", curso: 0, fijado: 0 },
        { title: "Motor", fecha: "05/09/24", type: "componente" },
        { ordenes: "mantenimiento", title: "Embutidora",
          descripcion: "Hacer tal o cual cosa de tal y tal forma",
          encargado: "Pancho", type: "orden",
          curso: 0, fijado: 0 },
        { title: "Turbina", fecha: "12/09/24", type: "componente", curso: 0, fijado: 0 },
        { title: "Generador", fecha: "18/09/24", type: "maquina", curso: 0, fijado: 0 },
        { title: "Transformador", fecha: "25/09/24", type: "maquina", curso: 0, fijado: 0 },
        { title: "Stock 1", cantidad: 3, type: "stock", curso: 0, fijado: 0 },
        { title: "Stock 2", cantidad: 2, type: "stock", curso: 0, fijado: 0 }
      ],
      notHistorial: [
        {id: "023", title: "MaquinaX", fecha: "12/08/24", type: "Mantenimiento" }
      ]
    };
  },
  computed: {
    filteredList() {
      const priority = {
        orden: 1,
        maquina: 2,
        componente: 3,
        stock: 4
      };

      let filtered = [];

      if (this.tab === 1) {
        filtered = this.maintenanceList;
      } else if (this.tab === 2) {
        filtered = this.maintenanceList.filter(item => item.type === "orden");
      } else if (this.tab === 3) {
        filtered = this.maintenanceList.filter(item => item.type === "maquina" || item.type === "componente");
      } else if (this.tab === 4) {
        filtered = this.maintenanceList.filter(item => item.type === "stock");
      }

      // Ordenar la lista filtrada según la prioridad
      return filtered.sort((a, b) => priority[a.type] - priority[b.type]);
    }
  }
};
</script>



<style scoped>
  .contenedor{
    padding: 0;
    width: 100%;
    height: 100%;
    display: flex;
  }
  .contenido{
    width: 80%;
    height: 100%;
    /* background-color: burlywood; */
  }
  .caja{
    overflow: auto;
    width: auto;
    height: 74vh;
  }
  .historial{
    padding-top: 1%;
    width: 20%;
    height: 100%;
    /* background-color: rgb(60, 60, 60); */
    h1,h3 {
      text-align: center;
    }
  }
  .listado{
    width: 100%;
    height: 80%;
    /* background-color: darkgreen; */
  }
  .notificaciones{
    padding: 2% 2% 0 2%;
    width: 100%;
    height: 85%;
    /* background-color: darkgoldenrod; */
  }
  .botones{
    display: flex;
    width: 100%;
    height: 15%;
    /* background-color: deeppink; */
    align-items: center;
    justify-content: center;
    gap: 10%;
  }
  .btn{
    width: 35%;
  }
</style>

