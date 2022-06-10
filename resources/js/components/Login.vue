<template>
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <form @submit.prevent="login">
                    <div class="form-group mb-2">
                        <label for="email">Email address</label>
                        <input v-model="email" type="email" class="form-control" id="email" placeholder="Enter email">
                    </div>
                    <div class="form-group mb-2">
                        <label for="password">Password</label>
                        <input v-model="password" type="password" class="form-control" id="password"
                            placeholder="Password">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
export default {

    data() {
        return {
            email: '',
            password: ''
        }
    },
    methods: {
        login() {
            axios.get('/sanctum/csrf-cookie').then(response => {
                axios.post('/api/login', { email: this.email, password: this.password })
                    .then(response => {
                        this.$router.push({ name: 'dashboard' });
                    })
                    .catch(error => {
                        console.log(error);
                    })
            });

        }
    }
}
</script>