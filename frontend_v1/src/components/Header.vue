<template>
  <header class="w-100 bg-dark">
    <div class="container py-3 text-white d-flex justify-content-between align-items-center">
        <router-link to="/11-module-b" class="p-0 m-0 fs-4 text-decoration-none text-white">WorldSkills: Games</router-link>
        <div class="d-flex">
           <p class="fw-bold p-0 m-0" v-if="username">{{ username }}</p>
            <template v-if="!token">
              <router-link :to="{name:'SignUp'}" class="ms-4 text-decoration-none text-white">Sign Up</router-link>
              <router-link :to="{name:'SignIn'}" class="ms-4 text-decoration-none text-white">Sign In</router-link>
            </template>
            <template v-if="token">
              <router-link :to="{name:'SignOut'}" class="ms-4 text-decoration-none text-white">Sign Out</router-link>
            </template>
        </div>
    </div>
  </header>
</template>

<script>
import axios from 'axios';
import router from '@/router';
export default {
  name: 'Header',
  data() {
    return {
      token: localStorage.token ? true : false, 
      username: localStorage.username
    }
  },
  created() {
    if (localStorage.token && (router.currentRoute.value.name == 'SignUp' || router.currentRoute.value.name == 'SignIn')) {
      router.push({ path: '/11-module-b' })
    }
    if (!localStorage.token && router.currentRoute.value.name != 'SignIn' && router.currentRoute.value.name != 'SignOut' ) {
      router.push({ path: '/11-module-b/sign_up' })
    }
  }

}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
a {
    color: white;
}
</style>
