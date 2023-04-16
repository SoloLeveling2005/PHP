<template>
    <Header/>
    <main class="w-100">
        <div class="container">
            <h5 class="my-4 fw-bold">Manage Game</h5>
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
                    <router-link :to="'/11-module-b/game/'+game.slug" class="btn btn-primary me-3">Посмотреть</router-link>
                    <button class="btn btn-danger" @click="deleteGame">Удалить игру</button>
                </div>
                </div>
            </div>
            <div class="d-flex justify-content-between  mt-4">

                <div >
                    <div class="mb-3">
                        <label for="formFile" class="form-label">Default file input example</label>
                        <input class="form-control" ref="fileInput" type="file" id="formFile" name="zipfile">
                    </div>
                    <button class="btn btn-primary me-3" @click="upload_v">Загрузить новую версию</button>
                </div>
                <div >
                    <input type="text" v-model="title" placeholder="title" id="title" class="form-control mb-2">
                    <input type="text" v-model="description" placeholder="description" id="description" class="form-control mb-2">
                    <button class="btn btn-primary" @click="updateGame">Редактировать заголовок и/или описание игры</button>
                </div>
            </div>
            
            <div class="d-flex mt-4">
                
                
            </div>
        </div>
        
    </main>
    <Footer/>
  </template>
  
  <script>
  import Header from "./../components/Header.vue"
  import Footer from "./../components/Footer.vue"
  import axios from "axios"
import router from '@/router'
  export default {
    name: 'manageGame',
    components: {
        Header,
        Footer
    },
    data () {
        return {
            game:[],
            title:null,
            description:null,
        }
    },  
    created() {
        document.title = "manageGame"
        this.token = localStorage.token
        axios.defaults.baseURL = "http://127.0.0.1:8000/api/v1"
        axios.get(`games/${this.$route.params.slug}`, {
            headers:{
                'Authorization':`Bearer ${this.token}`
            }
        }). then(response=>{
            this.game = response.data
            this.title = this.game.title
            this.description = this.game.description
            console.log(this.game)
        }).catch(error=>{
            console.error(error)
        })
    }, 
    methods: {
        deleteGame () {
            axios.delete(`games/${this.game.slug}`, {
                headers:{
                    'Authorization':`Bearer ${this.token}`
                }
            }). then(response=>{
                alert("Успешно удалено")
                router.push({path:`/11-module-b/user/${this.game.author}/`})
            }).catch(error=>{
                console.error(error)
            })
        },
        updateGame () {
            axios.put(`games/${this.game.slug}`,{
                mode:'no-cors',
                title: this.title,
                description: this.description,
            }, {
                headers:{
                    'Authorization':`Bearer ${this.token}`
                }
            }). then(response=>{
                alert("Успешно обновлено")
                this.game.title = this.title,
                this.game.description = this.description
            }).catch(error=>{
                console.error(error)
            })
        },
        upload_v () {
            const file = this.$refs.fileInput.files[0];
            console.log(file)
            let formData = new FormData();
            formData.append('zipfile', file);
            formData.append('token', this.token);

            axios.post(`/games/${this.game.slug}/upload`,formData, {
                headers: {
                    'Content-Type': 'multipart/form-data',
                    'Authorization':`Bearer ${this.token}`,
                    'responseType': 'blob',
                }
            }).then(response => {
                console.log(response);
                alert('Успешно загружено')
            }).catch(error => {
                console.log(error);
            });
        }
    }
  }
  </script>
  
  <!-- Add "scoped" attribute to limit CSS to this component only -->
  <style scoped>
   .h-50-vh {
        height: 50vh;
    }
  </style>
  