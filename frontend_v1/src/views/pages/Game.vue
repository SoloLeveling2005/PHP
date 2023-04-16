<template>
  <div class="home">
    <Header/>
    <main class="container py-3" style="min-height: 100vh;">
        <iframe :src="gamePath" frameborder="0" class="w-100 height-50-vh border border-1">

        </iframe>
        <div class="d-flex justify-content-between pt-3">
            <div class="table w-50">
              <h5>Top 10 leaderboard</h5>
              <hr>
              <template v-for="score in scores">
                <div class="row w-100" v-if="score.username != username">
                  <div class="col-1">#{{ scores.indexOf(score)+1 }}</div>
                  <router-link  :to="{name:'UserProfile', params:{username:score.username}}" class="col">{{score.username}}</router-link>
                  <div class="col">{{ score.score }}</div>
                </div>
                <div class="row w-100 fw-bold" v-if="score.username == username">
                  <div class="col-1">#{{ scores.indexOf(score)+1 }}</div>
                  <router-link  :to="{name:'UserProfile', params:{username:score.username}}" class="col">{{score.username}}</router-link>
                  <div class="col">{{ score.score }}</div>
                </div>
              </template>   

            </div>
            <div class="w-50">
              <h5>Description</h5>
              <hr>
              <p>
                {{ game.description }}
                
              </p>
            </div>
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
        scores:[],
        username:localStorage.username,
        user_score:{},
        game:[],
        gamePath:""
    }

  }, 
  created() { 
    axios.defaults.baseURL = "http://127.0.0.1:8000"
    let token = localStorage.token
    axios.get(`/api/v1/games/${this.$route.params.slug}`,
    {
        'Authorization':`Bearer ${token}`
    }).then(response => {
        console.log(response.data)
        this.game =  response.data
        document.title = this.game.title
        this.gamePath = `http://127.0.0.1:8000${this.game.gamePath}index.html`
        console.log(this.game)
    }).catch(error=>{
        console.log(error)
    });

    axios.get(`/api/v1/games/${this.$route.params.slug}/scores`,
    {
        'Authorization':`Bearer ${token}`
    }).then(response => {
        this.scores =  response.data.scores.slice(1, 11)
        this.user_score = response.data.scores.find(function (score, index) {
          if (score.username == localStorage.username)
            return true
        })
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
</style>
