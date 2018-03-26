<template>
    <div>
        <nav-bar></nav-bar>
        <section class="container">
            <div v-for="v in videos" :key="v.id">
                <video :src="v.filename" controls></video>
                <h1>{{v.nom}}</h1>
                <p>{{v.description}}</p>
            </div>
        </section>
    </div>
</template>

<script>
import NavBar from "./navBar.vue";

export default {
	props: ['video'],
    name: 'video',
    components: { NavBar },
    data () {
        return {
            videos: []
        }
    },
    methods : {

    },
    mounted(){
        window.axios.get('video').then((response) => {
            this.videos = response.data;
            this.videos.forEach(video => {
                video.filename = "http://localhost/BoniFlux/uploads/"+video.filename
            });
		}).catch((error) => {

		});
    }
}
</script>

<style scoped>

</style>
