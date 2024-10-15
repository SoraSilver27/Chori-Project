  <template>
    {{ formulariosLocal }}
    <v-form>
      <v-card class="pa-4">
        <v-card-title>Control de componentes</v-card-title>
        <v-card-text>
          <v-row>
            <v-col v-for="(fila, n) in filasDos" :key="n" :cols="fila.size">
              <component
                v-if="fila.tipo === 'dato' && fila.component.name !== 'VCheckbox'"
                :is="fila.component"
                v-model="componentesLocal[currentIndex][fila.model]"
                v-bind="fila.props"
                hide-details
                density="compact"
              />
              <component
                v-if="fila.tipo === 'nuevo' && fila.component.name !== 'VCheckbox'"
                :is="fila.component"
                v-model="formLocal[fila.model]"
                v-bind="fila.props"
                hide-details
                density="compact"
              />
              <component
                v-else-if="fila.component.name === 'VCheckbox'"
                :is="fila.component"
                v-model="formLocal[fila.model]"
                v-bind="fila.props"
                hide-details
                @update:modelValue="(val) => formLocal[fila.model] = val ? 1 : 0"
                density="compact"
              >
                <!-- Mostrar el slot de label solo si el componente es VCheckbox -->
                <template v-if="fila.component.name === 'VCheckbox'" v-slot:label>
                  {{ fila.text }}
                </template>
              </component>
            </v-col>
          </v-row>
        </v-card-text>
        <v-card-actions>
          <v-btn @click="closeDialog" color="blue">Cancelar</v-btn>
          <v-btn v-if="!isLastItem" @click="handleSiguiente" color="blue">Siguiente</v-btn>
          <v-btn v-else @click="handleGuardar" color="green">Aceptar</v-btn>
        </v-card-actions>
      </v-card>
    </v-form>
  </template>

<script setup>
import { ref, defineProps, computed, defineEmits } from 'vue';

const props = defineProps({
  componentesLocal: {
    type: Array,
    required: true,
  },
  formLocal: {
    type: Object,
    required: true,
  },
  dialog: {
    type: Boolean,
    required: true,
  },
  filasDos: {
    type: Array,
    required: true,
  }
});

// Index para rastrear en cuál estamos
const currentIndex = ref(0);
// Computed para saber si estamos en el último elemento
const isLastItem = computed(() => currentIndex.value === props.componentesLocal.length - 1);
// const isLastItem = computed(() => currentIndex.value === props.componentesLocal.length - 1);
const emit = defineEmits(['update:dialog', 'update:formularios_componentes']);
// Estado local para `formularios`
const formulariosLocal = ref([]);




// Función que maneja el botón "Siguiente"
const handleSiguiente = () => {
  // Asignar valores de props.form al formLocal
  props.filasDos.forEach((fila) => {
    if (fila.tipo === 'dato') {
      props.formLocal[fila.model] = props.componentesLocal[currentIndex.value][fila.model];
      props.formLocal.id = props.componentesLocal[currentIndex.value].id;
    }
  });

  // Agregar el formulario actual a formulariosLocal
  formulariosLocal.value.push({ ...props.formLocal });
  // Emitir evento para actualizar `formularios` en el componente padre
  emit('update:formularios_componentes', formulariosLocal.value);

  // Limpiar el formulario
  for (let key in props.formLocal) {
    props.formLocal[key] = ''; // resetear datos o dejar vacío
  }

  // Avanzar al siguiente índice si existe
  if (props.componentesLocal[currentIndex.value + 1]) {
    currentIndex.value++;
  } else {
    console.log('No hay más elementos en componentes_correct');
  }
  
  formulariosLocal.value = [];
};

const handleGuardar = () => {
  if (!props.componentesLocal[currentIndex.value]) {
    console.error('El índice es inválido o no hay elementos en componentesLocal.');
    return; // Terminar la función si no hay un elemento válido
  }

  // Guardar el último formulario
  props.filasDos.forEach((fila) => {
    if (fila.tipo === 'dato') {
      props.formLocal[fila.model] = props.componentesLocal[currentIndex.value][fila.model];
      props.formLocal.id = props.componentesLocal[currentIndex.value].id;
    }
  });

  // Agregar el formulario actual a formulariosLocal
  formulariosLocal.value.push({ ...props.formLocal });
  // Emitir evento para actualizar `formularios` en el componente padre
  emit('update:formularios_componentes', formulariosLocal.value);
  console.log('Datos guardados:', formulariosLocal.value);
  
  // Emitir un evento para cerrar el diálogo
  emit('update:dialog', false);

  // Resetear el formulario y el índice si se desea comenzar de nuevo
  currentIndex.value = 0;
  for (let key in props.formLocal) {
    props.formLocal[key] = '';
  }

  formulariosLocal.value = [];
};

// Función para cerrar el diálogo manualmente
const closeDialog = () => {
  // Emitir un evento para cerrar el diálogo
  emit('update:dialog', false);
};
</script>
