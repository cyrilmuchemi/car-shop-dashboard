import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: HomeView
    },
    {
      path: '/stock',
      name: 'Stock',
      component: () => import('../views/StockView.vue')
    },
    {
      path: '/addCar',
      name: 'Add Car',
      component: () => import('../views/AddCar.vue')
    }
  ]
})

export default router
