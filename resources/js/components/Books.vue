<template>
    <div>
        <h4 class="text-center">Liste des étudiants</h4><br/>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>Id</th>
                <th>Matricule</th>
                <th>Prénom</th>
                <th>Nom</th>
                <th>Email</th>
                <th>Télephone</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="book in books" :key="book.id">
                <td>{{ book.id }}</td>
                <td>{{ book.matricule }}</td>
                <td>{{ book.first_name }}</td>
                <td>{{ book.last_name }}</td>
                <td>{{ book.email }}</td>
                <td>{{ book.phone }}</td>
                <td>
                    <div class="btn-group" role="group">
                        <router-link :to="{name: 'editbook', params: { id: book.id }}" class="btn btn-primary">Modifier
                        </router-link>
                        <button class="btn btn-danger" @click="deleteBook(book.id)">Supprimer</button>
                    </div>
                </td>
            </tr>
            </tbody>
        </table>

        <button type="button" class="btn btn-info" @click="this.$router.push('/books/add')">Nouveau étudiant</button>
    </div>
</template>

<script>
export default {
    data() {
        return {
            books: []
        }
    },
    created() {
        this.$axios.get('/sanctum/csrf-cookie').then(response => {
            this.$axios.get('/api/books')
                .then(response => {
                    this.books = response.data;
                })
                .catch(function (error) {
                    console.error(error);
                });
        })
    },
    methods: {
        deleteBook(id) {
            this.$axios.get('/sanctum/csrf-cookie').then(response => {
                this.$axios.delete(`/api/books/delete/${id}`)
                    .then(response => {
                        let i = this.books.map(item => item.id).indexOf(id); // find index of your object
                        this.books.splice(i, 1)
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
