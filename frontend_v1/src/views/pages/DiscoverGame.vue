<template>
  <div class="home">
    <Header/>
    <main class="container pb-3">
        <div class="d-flex align-items-center justify-content-between mt-4">
            <h4>{{games_count}} Games available</h4>
            <div class="d-flex">
                <div class="btn-group p-0 m-0 me-4" role="group" aria-label="Basic radio toggle button group">
                    <input type="radio" class="btn-check" name="sortBy" id="Popularity" autocomplete="off" @click="sortBy='popularity'; get_filter_games()" checked>
                    <label class="btn btn-outline-primary" for="Popularity">Popularity</label>

                    <input type="radio" class="btn-check" name="sortBy" id="Recently Updated"  @click="sortBy='uploaddate'; get_filter_games()" autocomplete="off">
                    <label class="btn btn-outline-primary" for="Recently Updated">Recently Updated</label>

                    <input type="radio" class="btn-check" name="sortBy" id="Alphabetically" @click="sortBy='title'; get_filter_games()" autocomplete="off">
                    <label class="btn btn-outline-primary" for="Alphabetically">Alphabetically</label>
                </div>
                <div class="btn-group p-0 m-0" role="group" aria-label="Basic radio toggle button group">
                    <input type="radio" class="btn-check" name="sortDir" id="ASC" @click="sortDir='ASC'; get_filter_games()" autocomplete="off" checked>
                    <label class="btn btn-outline-primary" for="ASC">ASC</label>

                    <input type="radio" class="btn-check" name="sortDir" id="DESC" @click="sortDir='DESC'; get_filter_games()" autocomplete="off">
                    <label class="btn btn-outline-primary" for="DESC">DESC</label>
                </div>
            </div>
            
        </div>
        <div class="mt-4 d-flex flex-wrap justify-content-between" v-if="games">
            <template  v-for="game of games">
                    <router-link :to="{name:'Game', params:{slug:game.slug}}" class="card">
                        <template v-if="game.thumbnail">
                            <img :src="game.thumbnail" class="card-img-top" alt="...">
                        </template>
                        <template v-if="!game.thumbnail">
                            <img src="@/assets/logo.png" class="card-img-top" alt="...">
                        </template>
                        
                        
                        <div class="card-body">
                            <h5 class="card-title">{{game.title}}</h5>
                            <p class="card-text">{{ game.description }}</p>
                        </div>
                    </router-link>
                
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
  name: 'DiscoverGame',
  data () {
    return {
        games_count : 10,
        games : [],
        sortBy: '',
        sortDir: '',
    }
  },
  components: {
    Header,
    Footer
  }, 
  created() {
    localStorage.sortBy ? localStorage.sortBy : localStorage.sortBy = 'title'
    localStorage.sortDir ? localStorage.sortDir : localStorage.sortDir = 'ASC'
    axios.defaults.baseURL = "http://127.0.0.1:8000"
    let token = localStorage.token
    axios.get('/api/v1/games',
    {
        'Authorization':`Bearer ${this.token}`
    }).then(response => {
        console.log(response.data.content)
        this.games =  response.data.content
    }).catch(error=>{
        console.log(error)
    });
    },
    methods: {
        get_filter_games () {
            axios.get(`/api/v1/games`,
            {
                params:{
                    sortBy: this.sortBy,
                    sortDir:this.sortDir , 
                },
                
                headers:{
                    'Authorization':`Bearer ${this.token}`
                }
            }).then(response => {
                console.log(response.data.content)
                this.games =  response.data.content
            }).catch(error=>{
                console.log(error)
            });
        }
    }
}
</script>

<style scoped>
.card {
    width: 24%;
    margin-top: 10px;
}
main a {
    color: black;
}
</style>
