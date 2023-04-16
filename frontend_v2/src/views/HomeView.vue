<template>
  <Header/>
  <main class="w-100 pb-3">
      <div class="container">
        
        <div class="d-flex alugn-items-center justify-content-between pt-3">
          <h5>654 games available</h5>
          <div class="d-flex">
            <div class="btn-group me-2" role="group" aria-label="Basic radio toggle button group">
              <input type="radio" class="btn-check" name="sortBy" id="btnradio1" autocomplete="off" checked>
              <label class="btn btn-outline-primary" for="btnradio1" @click="sortByF('popular'); getGames()">Popularity</label>
              <input type="radio" class="btn-check" name="sortBy" id="btnradio2" autocomplete="off">
              <label class="btn btn-outline-primary" for="btnradio2" @click="sortByF('uploaddate'); getGames()">Recently Updated</label>
              <input type="radio" class="btn-check" name="sortBy" id="btnradio3" autocomplete="off">
              <label class="btn btn-outline-primary" for="btnradio3" @click="sortByF('title'); getGames()">Alphabetically</label>
            </div>
            <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
              <input type="radio" class="btn-check" name="sortDir" id="btnradio4" autocomplete="off" checked>
              <label class="btn btn-outline-primary" for="btnradio4" @click="sortDirF('asc'); getGames()">ASC</label>
              <input type="radio" class="btn-check" name="sortDir" id="btnradio5" autocomplete="off">
              <label class="btn btn-outline-primary" for="btnradio5" @click="sortDirF('desc'); getGames()">DESC</label>
            </div>
          </div>
        </div>
        <div>
            <template v-for="game in games_content">
              <div class="card w-100 mt-5">
                <div class="card-header">
                  <div class="d-flex align-items-center justify-content-between">
                    <h5 class="card-title fw-bold pb-1">{{ game.title }}</h5>
                    <router-link :to="'/11-module-b/user/'+game.author">{{ game.author }}</router-link>
                  </div>
                </div>
                <div class="card-body d-flex">
                  <div class="w-25 me-3">
                    <img src="./../assets/logo.png" class="card-img-top" alt="...">
                  </div>
                  <div>
                   
                    <p class="card-text pb-2">{{ game.description }}</p>
                    <router-link :to="'/11-module-b/game/'+game.slug" class="btn btn-primary">Играть</router-link>
                  </div>
                </div>
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
import axios from 'axios'
export default {
    name: 'Home',
    components: {
        Header,
        Footer
    },
    data () {
      return {
        sortBy: localStorage.sortBy,
        sortDir: localStorage.sortDir,
        games_content:[],
        page:0,
        size:3
      }
    },
    created() {
        document.title = "WorldSkills: Games"
        axios.defaults.baseURL = "http://127.0.0.1:8000/api/v1"
        if (!localStorage.sortBy) {
          localStorage.sortBy = 'title'
          localStorage.sortDir = 'asc'
        }
        this.getGames()
    }, 
    methods: {
      getGames () {
        axios.get('games', {
          params:{
            sortBy:this.sortBy,
            sortDir:this.sortDir,
            page:this.page,
            size:this.size
          }
        }).then(response => {
          this.games_content = response.data.content
          this.page = response.data.page + 1
          console.log(this.games_content)
        })
        .catch(function (error) {
          console.log(error);
        });
      },
      sortByF (data) {
        localStorage.sortBy = data
      },
      sortDirF (data) {
        localStorage.sortDir = data
      }
    }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>

</style>
