<template>
    <div>
        <nav-bar></nav-bar>
        <section class="container">

        </section>
    </div>
</template>

<script>
import NavBar from "./navBar.vue";

export default {
	props: ['profil'],
    name: 'profil',
    components: { NavBar },
    data () {
        return {

        }
    },
    methods : {

    },
    mounted(){
        // window.axios.get('video').then((response) => {

		// }).catch((error) => {

		// });
    }
}
</script>

<style scoped>

</style>
