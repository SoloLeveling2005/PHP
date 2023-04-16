<template>
    <div class="home">
      <Header/>
      <main class="container py-3" style="min-height: 100vh;">
        <h4>{{user.username}}</h4>
        <h5 v-if="games.length >= 1">Authored Games <router-link :to="{name:'ManageGame'}" class="btn btn-primary text-white" v-if="this_username == user.username">ManageGames</router-link></h5>
        
        <div class="d-flex flex-wrap">
          <template v-for="game in games">
            <router-link :to="{name:'Game', params:{slug:game.slug}}" class="card">
                <img src="@/assets/logo.png" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">{{ game.title }}</h5>
                    <p class="card-text">{{ game.description }}</p>
                </div>
            </router-link>
        </template>
        </div>
        
        <h5 class="mt-4 mb-2">HightScores per Game</h5>
        <div class="table w-50">
          <template v-for="score in higthscores">
            <div class="row">
              
                <div class="col">{{ score.game.title }}</div>
                <div class="col">{{ score.score }}</div>
            </div>
          </template>

        </div>
        
        
      </main>
      <Footer/>
    </div>
  </template>
  
  <script>
  // @ is an alias to /src
  import Header from '@/components/Header.vue'
  import Footer from '@/components/Footer.vue'
  import axios from 'axios'
  export default {
    name: 'UserProfile',
    data () {
      return {
        games:[],
        higthscores:[],
        user:[],
        this_username: localStorage.username
        
      }
  
    },
    created() {
      axios.defaults.baseURL = "http://127.0.0.1:8000"
      let token = localStorage.token
      axios.get(`/api/v1/users/${this.$route.params.username}`,
         {
          headers: {
              'Content-Type': 'application/json',
                'Authorization': `Bearer ${localStorage.token}`
            }
        }).then(response => {
          console.log(response.data)
          this.user = response.data
          this.games = response.data.authoredGames
          this.higthscores = response.data.highscores
      }).catch(error=>{
          console.log(error)
      });
    },
    components: {
      Header,
      Footer
    }
  }
  </script>
  
  <style scoped>
  .card {
      width: 24%;
      margin-top: 10px;
      margin-right: 10px;
  }
  main a {
      color: black;
  }
  .height-50-vh {
    height: 50vh;
  }
  hr {
    width: 70%;
  }
  a {
    text-decoration: none;
    }
  </style>
  