<template>
    <div>
        <Nav></Nav>
        <div class="container py-3">
            <div class="row justify-content-center">
                <router-view></router-view>
            </div>
        </div>

    </div>
</template>

<script>
import Nav from './Nav';
export default {
    components: {
        Nav
    },
    mounted() {
        console.log('Component mounted.')
    }
}
</script>
