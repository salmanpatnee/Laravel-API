<template>

    <div>
        <div class="jumbotron">
            <h1>Hello, {{ this.user.name }}</h1>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Laboriosam, eos libero incidunt fugit harum ex
                deserunt cupiditate nostrum id ipsa natus commodi assumenda debitis, quos atque quae possimus facere
                reiciendis?</p>
        </div>
    </div>


</template>


<script>
import { mapGetters } from 'vuex';

export default {
    data() {
        return {
            user: {}
        }
    },
    computed: {
        ...mapGetters([
            'authenticated'
        ])
    },
    mounted() {
        this.user = this.$store.state.user;
    }
}
</script>