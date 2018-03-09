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
      window.axios.post('desabonnement/'+this.$route.params.id,{

        id_streamer : this.$route.params.id,
        id_abonne : this.$store.state.member.id,

      }).then((response) => {

        alert("Vous vous êtes désabonner !");

      }).catch((error) => {
        alert(error);
      });
    }
  }
}
</script>

<style scoped>

</style>
