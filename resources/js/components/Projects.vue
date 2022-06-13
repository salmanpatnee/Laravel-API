<template>
    <div>
        <div style="text-align:right">
            <button class="text-light btn btn-primary" @click="showForm = true">Add New Project</button>
        </div>
        <div v-if="showForm">
            <ProjectForm @cancelForm="showForm = false" @projectAdded="fetchProjects"></ProjectForm>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>No of Tasks</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <ProjectItem v-for="project in projects" :key="project.id" :project="project"
                    @projectDeleted="fetchProjects">
                </ProjectItem>
            </tbody>
        </table>
    </div>
</template>

<script>
import ProjectItem from './ProjectItem.vue';
import ProjectForm from './ProjectForm.vue';
export default {
    data() {
        return {
            projects: [],
            showForm: false
        }
    },
    components: {
        ProjectItem,
        ProjectForm,
    },
    methods: {
        fetchProjects() {
            this.showForm = false;
            axios.get('/api/projects')
                .then(response => {
                    this.projects = response.data.data;
                })
                .catch(error => {
                    console.log(error)
                })
        }
    },
    mounted() {
        this.fetchProjects();
    }
}
</script>