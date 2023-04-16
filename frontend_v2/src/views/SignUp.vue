<template>
    <Header/>
    <main class="w-100">
        <div class="container">
            <h4 class="mt-4 mb-2">Sign Up</h4>
            <div class="p-5 border border-1">
                <div class="border border-1 p-5">
                    <input type="text" class="form-control mb-2" placeholder="username" v-model="username">
                    <input type="password" class="form-control mb-2" placeholder="password" v-model="password">
                    <button class="btn btn-success w-100" @click="SignUp">Sign Up</button>
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
import router from '@/router'
export default {
    name: 'SignUp',
    data () {
        return {
            username: "",
            password: "",
        }
    },
    components: {
        Header,
        Footer
    },
    created() {
        document.title = "Sign Up"
    },
    methods: {
    
        SignUp() {
            axios.defaults.baseURL = "http://127.0.0.1:8000/api/v1"
            axios.post('auth/signup', {
                username: this.username,
                password: this.password,
            }).then(response=>{
                let data = response.data
                let token = data.token
                localStorage.token = token
                localStorage.username = this.username
                router.push({path:"/11-module-b"})
            }).catch(error=>{
                alert("Ошибка отправки формы")
                console.log(error)
            })
        }
    
    }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>

</style>
