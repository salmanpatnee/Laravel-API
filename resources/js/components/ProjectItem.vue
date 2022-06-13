<template>
    <tr>
        <td>{{ project.id }}</td>
        <td>
            <router-link :to="{ name: 'project-details', params: { id: project.id } }">
                <span>
                    {{ project.name }}
                </span>
            </router-link>
        </td>
        <td>{{ project.no_of_tasks }}</td>
        <td>
            <button class="btn btn-info btn-sm text-light">
                <router-link :to="{ name: 'project-details', params: { id: project.id } }">
                    View
                </router-link>
            </button>
            <button class="btn btn-danger btn-sm" @click="deleteProject">Delete</button>
        </td>
    </tr>
</template>

<script>
export default {
    props: ['project'],
    methods: {
        deleteProject() {
            axios.delete('/api/projects/' + this.project.id)
                .then(response => {
                    this.$emit('projectDeleted')
                })
                .catch(error => {
                    console.log(error)
                })
        }
    }
}
</script>