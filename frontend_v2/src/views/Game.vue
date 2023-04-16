<template>
    <Header/>
    <main class="w-100">
        <div class="container">
          <h5 class="mt-4 fw-bold">{{ game.title }}</h5>
          <iframe :src="'http://127.0.0.1:8000'+game.gamePath+'index.html'" frameborder="0" class="mt-4 mb-2 w-100 h-50-vh border border-1"></iframe>
          <div class="table">
            <div class="row">
                <div class="col-3 pe-4">
                    <h5>Hightscores</h5>
                    <div class="mt-3">
                        <div class="table">
                            <div class="row" v-for="score in scores">
                                <template v-if="scores.indexOf(score)+1<=10">
                                    <div class="col-2">#{{scores.indexOf(score)+1}}</div>
                                    <router-link :to="'/11-module-b/user/'+score.username" class="col">{{score.username}}</router-link>
                                    <div class="col-1">{{score.score}}</div>
                                </template>
                            
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col ps-5">
                    <h5>Description</h5>
                    <p class="mt-3">{{ game.description }}</p>
                </div>
            </div>
        </div>
        </div>
        
    </main>
    <Footer/>
  </template>
  
  <script>
  import Header from "./../components/Header.vue"
  import Footer from "./../components/Footer.vue"
import axios from 'axios'
  export default {
    name: 'Game',
    components: {
        Header,
        Footer
    },
    data () {
        return {
            game:[],
            interval: null,
            scores:[]
        }
    },  
    created() {
        document.title = "Game"
        axios.defaults.baseURL = "http://127.0.0.1:8000/api/v1"
        axios.get(`games/${this.$route.params.slug}`, {}). then(response=>{
            this.game = response.data
        }).catch(error=>{
            console.error(error)
        })
        this.getScores()
        this.interval = setInterval(this.getScores, 5000)
    }, 
    methods: {
        getScores () {
            axios.get(`games/${this.$route.params.slug}/scores`, {}). then(response=>{
                this.scores = response.data.scores
                console.log(this.scores)
            }).catch(error=>{
                console.error(error)
            })
            
        }
    },
    destroyed() {
        clearInterval(this.interval)
    },
    
  }
  </script>
  
  <!-- Add "scoped" attribute to limit CSS to this component only -->
  <style scoped>
   .h-50-vh {
        height: 50vh;
    }
  </style>
  