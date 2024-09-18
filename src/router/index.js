
/**
 * router/index.ts
 *
 * Automatic routes for `./src/pages/*.vue`
 */

// Composables
import { name } from 'dayjs/locale/es'
import { createRouter, createWebHistory } from 'vue-router'

const routes = [
  { path: "/", component: () => import("@/pages/index.vue"), },
  { path: "/maquinas", component: () => import("@/pages/Maquinas.vue") },
  { path: "/nueva_maquina", component: () => import("@/pages/NuevaMaquina.vue") },
  { path: "/maquina", component: () => import("@/pages/Maquina.vue") },
  { path: "/maquinas/:id", component: () => import("@/pages/Maquina.vue") },

  { path: "/componentes", component: () => import("@/pages/Componentes.vue") },
  { path: "/nuevo_componente", component: () => import("@/pages/NuevoComponente.vue") },
  { path: "/componente", component: () => import("@/pages/Componente.vue") },
  { path: "/componentes/ :id", component: () => import("@/pages/Componente.vue") },

  { path: "/facturas", component: () => import("@/pages/Facturas.vue") },
  { path: "/nueva_factura", component: () => import("@/pages/Factura.vue") },
  { path: "/inventario", component: () => import("@/pages/Inventario.vue") },
  { path: "/nuevo_repuesto", component: () => import("@/pages/NuevoRepuesto.vue") },
  { path: "/calendario", component: () => import("@/pages/Calendario.vue") }
]

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes
})

export default router
