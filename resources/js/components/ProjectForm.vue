<template>
    <div class="col-4 col-offset-4">
        <form @submit.prevent="handleSubmit">
            <div class="form-group">
                <input type="text" class="form-control" name="name" id="name" v-model="name" placeholder="Name"
                    required>
            </div>
            <div class="form-group mt-3 mb-5">
                <button type="submit" class="btn btn-success">Add Project</button>
                <button type="button" class="btn btn-secondary" @click="cancelForm">Cancel</button>
            </div>
            <div>
                <span class="text-danger">{{ errorMessage }}</span>
            </div>
        </form>
    </div>
</template>

<script>
import axios from 'axios'

export default {
    data() {
        return {
            name: '',
            errorMessage: ''
        }
    },
    methods: {
        async handleSubmit() {
            try {
                const response = await axios.post('/api/projects', { name: this.name });
                if (response.status == 201) {
                    this.name = "";
                    this.errorMessage = "";
                    this.$emit('projectAdded');
                }

            } catch (error) {
                console.log(error.response);
            }
        },
        cancelForm() {
            this.$emit('cancelForm')
        }
    }
}
</script>