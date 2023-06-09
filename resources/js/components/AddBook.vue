<template>
    <div>
        <h4 class="text-center">Ajout d'un nouveau étudiant</h4>
        <div class="row">
            <div class="col-md-6">
                <form @submit.prevent="addBook">
            
                    <div class="mb-3">
                        <label class="form-label">Matricule</label>
                        <input type="text" class="form-control" v-model="book.matricule" placeholder="Entrer le matricule">
                    </div><br>

                    <div class="mb-3">
                        <label class="form-label">Prenom</label>
                        <input type="text" class="form-control" v-model="book.first_name" placeholder="Entrer le prénom">
                    </div><br>

                    <div class="mb-3">
                        <label class="form-label">Nom</label>
                        <input type="text" class="form-control" v-model="book.last_name" placeholder="Entrer le nom">
                    </div><br>

                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control" v-model="book.email" placeholder="Entrer l'email">
                    </div><br>

                    <div class="mb-3">
                        <label class="form-label">Téléphone</label>
                        <input type="text" class="form-control" v-model="book.phone" placeholder="Entrer le téléphone">
                    </div><br>

                    <button type="submit" class="btn btn-primary">Ajouter</button>
                    
                </form>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            book: {}
        }
    },
    methods: {
        addBook() {
            this.$axios.get('/sanctum/csrf-cookie').then(response => {
                this.$axios.post('/api/books/add', this.book)
                    .then(response => {
                        this.$router.push({name: 'books'})
                    })
                    .catch(function (error) {
                        console.error(error);
                    });
            })
        }
    },
    beforeRouteEnter(to, from, next) {
        if (!window.Laravel.isLoggedin) {
            window.location.href = "/";
        }
        next();
    }
}
</script>
