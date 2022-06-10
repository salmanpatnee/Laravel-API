<template>
    <div>
        <div class="container">
            <div class="row justify-content-center">
                <router-view></router-view>
            </div>
        </div>

    </div>
</template>

<script>
export default {
    mounted() {
        console.log('Component mounted.')
    }
}
</script>
