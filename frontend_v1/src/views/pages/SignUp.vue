<template>
    <div class="home">
      <Header/>
      <main class="container py-3" style="min-height: 100vh;">
            <h4 class="">Sign Up</h4>
            <div class="d-flex justify-content-center align-items-center border border-1 py-5">
                <div class="p-4 mt-2 fs-4 border border-1">
                    <input type="text" id="username" class="form-control my-2 fs-4 " v-model="username">
                    <input type="password" id="password" class="form-control my-2  fs-4" v-model="password">
                    <button class="btn btn-success w-100" v-on:click="sign_up">Sign Up</button>
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

  export default {
    name: 'SignUp',
    data () {
      return {
        username:"",
        password:"",
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
        
        sign_up () {
            axios.post('http://127.0.0.1:8000/api/v1/auth/signup', {
                username:this.username,
                password:this.password,
                headers: {
                    'Content-Type': 'application/json',
                }
            }).then(response =>{
                console.log(response.data)
                localStorage.token = response.data.token
                localStorage.username = this.username
                
            }).catch(error => {
                console.log(error.response.data)
                alert(error.response.data.message)
            })
            router.push({path:'/11-module-b'})
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
