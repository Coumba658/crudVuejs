<template>
    <div class="container">
        <div class="text-center" style="margin: 20px 0px 20px 0px;">
            <!-- <a href="https://shouts.dev/" target="_blank"><img src="https://i.imgur.com/Nt3kJXa.png"></a><br> -->
            <span class="text-secondary">Gestion des étudiants</span>
        </div>

        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="collapse navbar-collapse">
                <!-- for logged-in user-->
                <div class="navbar-nav" v-if="isLoggedIn">
                    <router-link to="/dashboard" class="nav-item nav-link">Tableau de bord</router-link>
                    <router-link to="/books" class="nav-item nav-link">Liste Etudiant</router-link>
                    <a class="nav-item nav-link" style="cursor: pointer;" @click="logout">Se déconnecter</a>
                </div>
                <!-- for non-logged user-->
                <div class="navbar-nav" v-else>
                    <router-link to="/" class="nav-item nav-link">Accueil</router-link>
                    <router-link to="/login" class="nav-item nav-link">Se Connecter</router-link>
                    <router-link to="/register" class="nav-item nav-link">Créer un compte</router-link>
                    <!-- <router-link to="/about" class="nav-item nav-link">A Propos</router-link> -->
                </div>
            </div>
        </nav>
        <br/>
        <router-view/>
    </div>
</template>

<script>
export default {
    name: "App",
    data() {
        return {
            isLoggedIn: false,
        }
    },
    created() {
        if (window.Laravel.isLoggedin) {
            this.isLoggedIn = true
        }
    },
    methods: {
        logout(e) {
            console.log('ss')
            e.preventDefault()
            this.$axios.get('/sanctum/csrf-cookie').then(response => {
                this.$axios.post('/api/logout')
                    .then(response => {
                        if (response.data.success) {
                            window.location.href = "/"
                        } else {
                            console.log(response)
                        }
                    })
                    .catch(function (error) {
                        console.error(error);
                    });
            })
        }
    },
}
</script>
