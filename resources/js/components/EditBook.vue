<template>
    <div>
        <h4 class="text-center">Modification Etudiant</h4>
        <div class="row">
            <div class="col-md-6">
                <form @submit.prevent="updateBook">

                    <div class="mb-3">
                        <label class="form-label">Matricule</label>
                        <input type="text" class="form-control" v-model="book.matricule">
                    </div><br>

                    <div class="mb-3">
                        <label class="form-label">Prenom</label>
                        <input type="text" class="form-control" v-model="book.first_name">
                    </div><br>

                    <div class="mb-3">
                        <label class="form-label">Nom</label>
                        <input type="text" class="form-control" v-model="book.last_name">
                    </div><br>

                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control" v-model="book.email">
                    </div><br>

                    <div class="mb-3">
                        <label class="form-label">Téléphone</label>
                        <input type="text" class="form-control" v-model="book.phone">
                    </div><br>

                    <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>

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
    created() {
        this.$axios.get('/sanctum/csrf-cookie').then(response => {
            this.$axios.get(`/api/books/edit/${this.$route.params.id}`)
                .then(response => {
                    this.book = response.data;
                })
                .catch(function (error) {
                    console.error(error);
                });
        })
    },
    methods: {
        updateBook() {
            this.$axios.get('/sanctum/csrf-cookie').then(response => {
                this.$axios.post(`/api/books/update/${this.$route.params.id}`, this.book)
                    .then(response => {
                        this.$router.push({name: 'books'});
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
