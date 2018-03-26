<template>
    <div>
        <nav-bar></nav-bar>
        <div class="column is-2">
            <img class="Timg" src="http://download.seaicons.com/icons/iconsmind/outline/512/Webcam-icon.png">
            <div class="contentStream">
              <p>{{ user.nom }} {{ user.prenom }}</p>
              <strong>{{ user.pseudo }}</strong>
            </div>
            <div class="has-text-centered data">
                <!-- <router-link class="button is-success" :to="{ name:'diffusion', params : { id : stream.id } }"><i class="fas fa-eye marker"></i>Regarder</router-link> -->
            </div>

        </div>
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
            user: []
        }
    },
    methods : {

    },
    mounted(){
        window.axios.get('user/' + this.$route.params.id).then((res) => {
            this.user = res.data
		}).catch((error) => {

		});
    }
}
</script>

<style scoped>
.button{
  margin: 10px;
  -webkit-transition-property: color;
  -webkit-transition-duration: 0.5s;
  -moz-transition-property: color;
  -moz-transition-duration: 0.5s;
  transition-property: color;
  transition-duration: 0.5s;
}

.button:hover{
  color: #363636;
}

.titre{
  background-color: #DBDBDB;
}

.first{
  border-radius: 5px 0px 0px 5px;
}

.last{
  border-radius: 0px 5px 5px 0px;
}
.end{
  border-bottom: 1px solid black;
}

.Timg{
  width:50%;
  margin-left: 25%;
}

.marker{
  margin-right: 10px;
}

.contentStream{
  text-align: center;
}
</style>
