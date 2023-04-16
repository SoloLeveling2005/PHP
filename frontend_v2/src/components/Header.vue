<template>
    <header class="w-100 bg-dark">
        <div class="container d-flex align-items-center justify-content-between text-white py-3">
            <router-link to="/11-module-b" class="p-0 m-0 fs-2 text-white">WorldSkills: Games</router-link>
            <div class="d-flex align-items-center justify-content-center" v-if="!this.token">
                <router-link to="/11-module-b/SignUp" class="ms-4 text-white">SignUp</router-link>
                <router-link to="/11-module-b/SignIn" class="ms-4 text-white">SignIn</router-link>
            </div>
            <div v-else>
                <router-link to="/11-module-b/SignOut" class="ms-4 text-white">Sign Out</router-link>
            </div>
        </div>
    </header>
</template>

<script>
import router from '@/router'
export default {
    name: 'Header',
    data() {
        return {
            token: ""
        }
    },
    created() {
        this.token = localStorage.token
        let route_url = router.options.history.location
        if (!this.token && route_url != "/11-module-b/SignUp" && route_url != "/11-module-b/SignIn" && route_url != "/11-module-b/SignOut"  ) {
            router.push({path:"/11-module-b/SignUp"})
        }
        if (this.token && (route_url == "/11-module-b/SignUp" || route_url == "/11-module-b/SignIn")) {
            router.push({path:"/11-module-b"})
        }
    }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
    
</style>
