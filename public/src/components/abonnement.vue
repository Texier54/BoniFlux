<template>
  <div class="column is-4">
		<strong>{{ user.pseudo }}</strong><br>

    <router-link class="button is-success" :to="{ name:'diffusion', params : { id : 1} }">Profil</router-link>

    <a class="button" @click="desabonner">Désabonner</a>
	</div>
</template>

<script>

export default {
	props: ['abonnement'],
  name: 'abonnement',
  components: {},
  data () {
    return {
			user: '',
    }
  },
  methods : {
    desabonner() {
      window.axios.post('desabonnement/',{

        id_streamer : this.abonnement.id_streamer,
        id_abonne : this.$store.state.member.id,

      }).then((response) => {

        alert("Vous vous êtes désabonner !");
				window.bus.$emit('updateAbonnements');

      }).catch((error) => {
        alert(error);
      });
    }
  },
	mounted() {
		window.axios.get('user/'+this.abonnement.id_streamer).then((response) => {
      this.user = response.data;
    }).catch((error) => {
    });
	}
}
</script>

<style scoped>

</style>
