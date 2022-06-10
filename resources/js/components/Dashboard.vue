<template>
    <div>
        Hello {{ this.user.name }}
    </div>
</template>


<script>
export default {
    data() {
        return {
            user: {}
        }
    },
    mounted() {
        axios.get('/api/user')
            .then(response => {
                this.user = response.data;
            })
            .catch(error => {
                console.log(error)
            })
    }
}
</script>