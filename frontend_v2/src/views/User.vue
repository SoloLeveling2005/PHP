<template>
    <Header/>
    <main class="w-100">
        <div class="container">
            <h5 class="my-4 fw-bold">{{user.username}}</h5>
            <h5 v-if="user.authoredGames.length > 1">Authored Games</h5>
            <template v-for="game in user.authoredGames">
                <div class="card w-100 mt-3">
                    <div class="card-header">
                        {{ game.title }}
                    </div>
                    <div class="card-body d-flex">
                    <div class="w-25 me-3">
                        <img src="./../assets/logo.png" class="card-img-top" alt="...">
                    </div>
                    <div>
                        <p class="card-text pb-2">{{ game.description }}</p>
                        <router-link :to="'/11-module-b/game/'+game.slug" class="btn btn-primary">Играть</router-link>
                        {{ game.user }}
                        <template v-if="username == user.username">

                            <router-link :to="'/11-module-b/game/'+game.slug+'/manageGame'" class="btn btn-primary">Менеджер</router-link>
                        </template>
                    </div>
                    </div>
                </div>
            </template>
            <h5 class="mt-4 fw-bold">Hightscores per Game</h5>
            <div class="table mt-2 mb-5 w-50">
                <template v-for="score in user.highscores">
                    <div class="row" v-if="user.highscores.indexOf(score) +1<=10">
                        <div class="col text-align-left">{{score.game.title}}</div>
                        <div class="col text-align-right">{{score.score}}</div>
                    </div>
                </template>
                
            </div>
        </div>
        
    </main>
    <Footer/>
  </template>
  
  <script>
  import Header from "./../components/Header.vue"
  import Footer from "./../components/Footer.vue"
  import axios from "axios"
  export default {
    name: 'User',
    components: {
        Header,
        Footer
    },
    data () {
        return {
            token:'',
            username: localStorage.username,
            user: []
        }
    },
    created() {
        document.title = "User"
        this.token = localStorage.token
        axios.defaults.baseURL = "http://127.0.0.1:8000/api/v1"
        axios.get(`users/${this.$route.params.username}`, {
            headers:{
                'Authorization':`Bearer ${this.token}`
            }
        }). then(response=>{
            this.user = response.data
            console.log(this.user)
        }).catch(error=>{
            console.error(error)
        })
        
    }
  }
  </script>
  
  <!-- Add "scoped" attribute to limit CSS to this component only -->
  <style scoped>
   .h-50-vh {
        height: 50vh;
    }
  </style>
  