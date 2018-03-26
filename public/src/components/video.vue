<template>
    <div>
        <nav-bar></nav-bar>
        <section class="container">
            <div v-for="v in videos" :key="v.id">
                <video :src="v.filename" controls></video>
                <div>
                    <router-link :to="{ name: 'profil', params: { id: v.id_user }}">User</router-link>
                    <h1>{{v.nom}}</h1>
                    <p>{{v.description}}</p>
                </div>
            </div>
        </section>
    </div>
</template>

<script>
import NavBar from "./navBar.vue";

export default {
    name: 'video',
    components: { NavBar },
    data () {
        return {
            videos: []
        }
    },
    methods : {

    },
    created(){
        window.axios.get('video').then((response) => {
            this.videos = response.data
            this.videos.forEach(video => {
                video.filename = "http://localhost/BoniFlux/uploads/"+video.filename
                // window.axios.get('user/'+video.id_user).then((res) => {
                //     video.profil = res.data
                // }).catch((e) => {
                //     console.error(e)
                // })
            })
        })
        .catch((error) => {

		});
    }
}
</script>

<style scoped>

</style>
