<template>
    <div class="home">
      <Header v-if="render_header"/>
      <Header v-if="!render_header"/>
      <main class="container py-3" style="min-height: 100vh;">
            <h4 class="">Sign Out</h4>
            <div class="d-flex justify-content-center align-items-center border border-1 py-5">
                <div class="p-4 mt-2 fs-4 border border-1">
                    <h5>You have been successfully signed out.</h5>
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
  axios.defaults.baseURL = "http://127.0.0.1:8000";
  export default {
    name: 'SignOut',
    created () {
      console.log( `Bearer ${localStorage.token}`)
      axios.post('/api/v1/auth/signout', {
          mode: 'no-cors'
        }, {
          headers: {
              'Content-Type': 'application/json',
                'Authorization': `Bearer ${localStorage.token}`
            }   
        }).then(response =>{
            console.log(response.data)
            localStorage.removeItem('token')
            localStorage.removeItem('username')
            this.render_header = true;
        }).catch(error => {
            console.log(error.response.data.message)
        });
    },
    data () {
      return {
          render_header:false,
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
