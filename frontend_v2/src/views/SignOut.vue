<template>
    <Header v-if="status"/>
    <Header v-if="!status"/>
    <main class="w-100">
        <div class="container">
            <h4 class="mt-4 mb-2">Sign Out</h4>
            <div class="p-5 border border-1">
                <div class="border border-1 p-5">
                    You have been successfuly sign out.
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
import { thisExpression } from "@babel/types"
export default {
    name: 'SignOut',
    data () {
        return {
            token: "",
            status:false
        }
    },
    components: {
        Header,
        Footer
    },
    created() {
        document.title = "Sign Out"
        this.token = localStorage.token
        axios.defaults.baseURL = "http://127.0.0.1:8000/api/v1"
        axios.post('auth/signout',{
            mode:'no-cors'
        },  {
          headers: {
              'Content-Type': 'application/json',
                'Authorization': `Bearer ${localStorage.token}`
            }   
        }).then(response=>{
            console.log(response)
            localStorage.removeItem('token')
            localStorage.removeItem('username')
            this.status = true
        }).catch(error=>{
            console.error(error)
        })
    }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>

</style>
