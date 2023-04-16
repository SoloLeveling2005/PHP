import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'
import DiscoverGame from '../views/pages/DiscoverGame.vue'
import SignUp from '../views/pages/SignUp.vue'
import SignIn from '../views/pages/SignIn.vue'
import SignOut from '../views/pages/SignOut.vue'
import Game from '../views/pages/Game.vue'
import UserProfile from '../views/pages/UserProfile.vue'
import ManageGame from '../views/pages/ManageGame.vue'
const routes = [
  {
    path: '/11-module-b',
    name: 'DiscoverGame',
    component: DiscoverGame
  },
  {
    path: '/11-module-b/sign_up',
    name: 'SignUp',
    component: SignUp
  },
  {
    path: '/11-module-b/sign_in',
    name: 'SignIn',
    component: SignIn
  },
  {
    path: '/11-module-b/sign_out',
    name: 'SignOut',
    component: SignOut
  },
  {
    path: '/11-module-b/game/:slug',
    name: 'Game',
    component: Game
  },
  {
    path: '/11-module-b/user/:username',
    name: 'UserProfile',
    component: UserProfile
  },
  {
    path: '/11-module-b/manage_game',
    name: 'ManageGame',
    component: ManageGame
  },
  {
    path: '/*',
    redirect: to => {
      return '/11-module-b'
    }
  },
]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})

export default router
