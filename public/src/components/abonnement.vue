<template>
	<div>
    <h2>Vos abonnements</h2>
		<p>{{ abonnement }}</p>

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
  }
}
</script>

<style scoped>

</style>
