<template>
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <form @submit.prevent="handleLogin">
                    <div v-show="errorMessage" class="alert alert-danger" role="alert">
                        {{ errorMessage }}
                    </div>
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
import { mapGetters } from 'vuex';
export default {

    data() {
        return {
            email: '',
            password: '',
            errorMessage: ''
        }
    },
    methods: {
        async handleLogin() {
            this.errorMessage = '';
            try {
                await this.$store.dispatch('login', {
                    email: this.email, password: this.password
                });
                this.$router.push({ name: 'dashboard' });
            } catch (error) {
                this.errorMessage = error;
            }
        }
    },
    computed: {
        ...mapGetters([
            'authenticated'
        ])
    },
    mounted() {
        if (this.authenticated) {
            this.$router.push({ name: 'dashboard' })
        }
    }
}
</script>