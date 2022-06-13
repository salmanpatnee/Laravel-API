<template>
    <div v-id="project.id > 0">
        <div class="row">
            <div class="col">

                <h1>Project # {{ project.id }}</h1>
            </div>
            <div class="col" style="text-align:right">

                <button class="btn btn-danger" @click="deleteProject">Delete Project</button>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-3"><b>Name</b></div>
            <div class="col">
                <p>{{ project.name }}</p>
            </div>
        </div>
        <div class="row">
            <div class="col-3"><b>Created at</b></div>
            <div class="col">
                <p>{{ project.created_at }}</p>
            </div>
        </div>
        <div class="row">
            <div class="col-3"><b>Updated at</b></div>
            <div class="col">
                <p>{{ project.updated_at }}</p>
            </div>
        </div>
        <div v-if="project.tasks.length > 0">
            <hr>
            <h2>Tasks</h2>
            <hr>
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Task</th>
                        <th>Due Date</th>
                        <th>Priority</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <task v-for="task in project.tasks" :key="task.id" :task="task"></task>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
import task from './Task.vue';
export default {
    props: ['id'],
    components: {
        task
    },
    data() {
        return {
            project: []
        }
    },
    methods: {
        deleteProject() {
            axios.delete('/api/projects/' + this.id)
                .then(response => {
                    this.$router.push({ name: 'projects' })
                })
                .catch(error => {
                    console.log(error)
                })
        }
    },
    mounted() {
        axios.get('/api/projects/' + this.id)
            .then(response => {
                this.project = response.data.data;
            })
            .catch(error => {
                console.log(error)
            })
    }
}
</script>