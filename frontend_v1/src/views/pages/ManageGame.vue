<template>
    <div class="home">
      <Header/>
      <main class="container py-3" style="min-height: 100vh;">
        <h5>ManageGame</h5>
        <div class="d-flex justify-content-between">
            <div class="card">
                <img src="https://myrusakov.ru/images/articles/html_placeholder_01.jpg" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    <div class="d-flex ">
                        <button class="btn btn-primary me-2">Upload new version</button>
                        <button class="btn btn-danger">Delete</button>
                    </div>
                </div>
            </div>
            <div class="card">
                <img src="https://myrusakov.ru/images/articles/html_placeholder_01.jpg" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    <div class="d-flex ">
                        <button class="btn btn-primary me-2">Upload new version</button>
                        <button class="btn btn-danger">Delete</button>
                    </div>
                </div>
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
  
  export default {
    name: 'ManageGame',
    data () {
      return {
        token: localStorage.token ? true : false,
          games : [
            {},
            {},
            {}
        ],
        
      }
  
    },
    methods:{
      upload_new_version () {
      
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
