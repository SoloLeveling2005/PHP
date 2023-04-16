import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'

const routes = [
  {
    path: '/11-module-b',
    name: 'home',
    component: HomeView
  },
  {
    path: '/11-module-b/signin',
    name: 'SignIn',
    component: () => import('../views/SignIn.vue')
  },
  {
    path: '/11-module-b/signup',
    name: 'SignUp',
    component: () => import('../views/SignUp.vue')
  },
  {
    path: '/11-module-b/signout',
    name: 'SignOut',
    component: () => import('../views/SignOut.vue')
  },
  {
    path: '/11-module-b/game/:slug',
    name: 'Game',
    component: () => import('../views/Game.vue')
  },
  {
    path: '/11-module-b/user/:username',
    name: 'User',
    component: () => import('../views/User.vue')
  },
  {
    path: '/11-module-b/game/:slug/manageGame',
    name: 'manageGame',
    component: () => import('../views/manageGame.vue')
  },
]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})

export default router
