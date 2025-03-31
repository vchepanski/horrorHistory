import { createRouter, createWebHistory } from 'vue-router'
import PostarHistoria from '../components/PostarHistoria.vue'
import ListaHistorias from '../components/ListaHistorias.vue'
import VerHistoria from '../components/VerHistoria.vue'

const routes = [
  {
    path: '/postar',
    name: 'postar',
    component: PostarHistoria,
  },
  {
    path: '/historias',
    name: 'historias',
    component: ListaHistorias,
  },
  {
    path: '/historia/:id',
    name: 'ver-historia',
    component: VerHistoria,
    props: true,
  },
  {
    path: '/',
    redirect: '/historias',
  },
  {
    path: '/admin/historias',
    name: 'admin.historias',
    component: () => import('../views/Admin/adminStories.vue')
  },
  {
    path: '/admin/categories', // ⬅️ nova rota admin
    name: 'admin.categories',
    component: () => import('../views/Admin/AdminFormCategories.vue')
  }
]

const router = createRouter({
  history: createWebHistory(),
  routes,
})

export default router
