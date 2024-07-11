// Composables
import { createRouter, createWebHistory } from 'vue-router'

const routes = [
  {
    path: '/',
    component: () => import('@/layouts/default/Default.vue'),
    children: [
      {
        path: '',
        name: 'Home',
        component: () => import(/* webpackChunkName: "home" */ '@/views/Home.vue'),
        
      },
      {
        path: 'présentation', 
        name: 'Présentation',
        component: () => import(/* webpackChunkName: "vehicules" */ '@/views/Présentation.vue'),
      },
      {
        path: 'restauration', 
        name: 'Restauration',
        component: () => import(/* webpackChunkName: "login" */ '@/views/Restauration.vue'),
      },
      {
        path: 'visitehabitat', 
        name: 'VisiteHabitat',
        component: () => import(/* webpackChunkName: "login" */ '@/views/VisiteHabitat.vue'),
      },
      {
        path:'visitetrain',
        name:'VisiteTrain',
        component: () => import(/* webpackChunkName: "login" */ '@/views/VisiteTrain.vue'),
      },
      {
        path:'habitat',
        name:'Habitat',
        component: () => import(/* webpackChunkName: "login" */ '@/views/Habitat.vue'),
      },
      {
        path:'savane',
        name:'Savane',
        component: () => import(/* webpackChunkName: "login" */ '@/views/Savane.vue'),
      },
      {
        path:'jungle',
        name:'Jungle',
        component: () => import(/* webpackChunkName: "login" */ '@/views/Jungle.vue'),
      },
      {
        path:'marais',
        name:'Marais',
        component: () => import(/* webpackChunkName: "login" */ '@/views/Marais.vue'),
      },
      {
        path:'connexion',
        name:'Connexion',
        component: () => import(/* webpackChunkName: "login" */ '@/views/Connexion.vue'),
      },
      {
        path:'admin',
        name:'Admin',
        component: () => import(/* webpackChunkName: "login" */ '@/views/Admin/Admin.vue'),
      },
      {
        path:'employe',
        name:'Employe',
        component: () => import(/* webpackChunkName: "login" */ '@/views/Admin/Employe.vue'),
      },
      {
        path:'vétérinaire',
        name:'Vétérinaire',
        component: () => import(/* webpackChunkName: "login" */ '@/views/Admin/Vétérinaire.vue'),
      },
      ],
  },
]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes,
})

export default router