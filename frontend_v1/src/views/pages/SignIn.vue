<template>
    <div class="home">
      <Header/>
      <main class="container py-3" style="min-height: 100vh;">
            <h4 class="">Sign In</h4>
            <div class="d-flex justify-content-center align-items-center border border-1 py-5">
                <div class="p-4 mt-2 fs-4 border border-1">
                    <input type="text" id="username" class="form-control my-2 fs-4 " v-model="username">
                    <input type="password" id="password" class="form-control my-2  fs-4" v-model="password">
                    <button class="btn btn-success w-100" @click="sign_in">Sign In</button>
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
  import axios from 'axios';
  import router from '@/router';
  export default {
    name: 'SignIn',
    data () {
      return {
        username: "",
        password: "",
          games : [
            {},
            {},
            {}
        ],
        
      }
  
    },
    components: {
      Header,
      Footer
    },
    methods: {
      sign_in () {
        axios.post('http://127.0.0.1:8000/api/v1/auth/signin', {
            username:this.username,
            password:this.password,
            headers: {
                'Content-Type': 'application/json',
            }
        }).then(response =>{
            console.log(response.data)
            localStorage.token = response.data.token
            localStorage.username = this.username
            router.push({path:'/11-module-b'})
        }).catch(error => {
            console.log(error.response.data.message)
        })
      }
    }
  }
</script>

<style scoped>
a {
text-decoration: none;
}
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

.modal {
    position: absolute !important;
    width: 100vw !important;
    z-index: 100 !important;
    height: 100vh !important;
    background-color: #fff;
    top:0; left: 0;
}
</style>
