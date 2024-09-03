
/**
 * router/index.ts
 *
 * Automatic routes for `./src/pages/*.vue`
 */

// Composables
import { name } from 'dayjs/locale/es'
import { createRouter, createWebHistory } from 'vue-router'

const routes = [
  { path: "/inicio", component: () => import("@/pages/index.vue"), },
  { path: "/maquinas", component: () => import("@/pages/Maquinas.vue") },
  { path: "/componentes", component: () => import("@/pages/Componentes.vue") },
  { path: "/facturas", component: () => import("@/pages/Facturas.vue") },
  { path: "/inventario", component: () => import("@/pages/Inventario.vue") },
  { path: "/calendario", component: () => import("@/pages/Calendario.vue") }
]

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes
})

export default router
