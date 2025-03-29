import { createRouter, createWebHistory } from 'vue-router'
import PostarHistoria from '../components/PostarHistoria.vue'
import ListaHistorias from '../components/ListaHistorias.vue'
import VerHistoria from '../components/VerHistoria.vue' // ⬅️ importar o novo componente

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
    path: '/historia/:id',           // ⬅️ nova rota dinâmica
    name: 'ver-historia',
    component: VerHistoria,
    props: true,                     // permite passar o ID como prop (opcional)
  },
  {
    path: '/',
    redirect: '/historias'           // página inicial redireciona pra listagem
  },
  {
    path: '/admin/historias',
    name: 'admin.historias',
    component: () => import('../views/admin/adminStories.vue')
  }
]

const router = createRouter({
  history: createWebHistory(),
  routes,
})

export default router
