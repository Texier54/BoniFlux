<template>
	<div>
		<nav-bar></nav-bar>
    <section>
  		<div class="titre">
			<h2>Vos abonnements</h2>
		</div>
		<div v-if="visiteur" class="columns contentAbonnement">
  			<abonnement  v-for="abonnement in abonnements" :abonnement="abonnement" :key="abonnement.id"></abonnement>
		</div>

			<div v-else class="columns">
				<p class="column is-12" style="text-align:center;">Vous n'avez pas d'abonnements en tant que visiteur</p>
			 </div>
    </section>
	</div>
</template>

<script>

import NavBar from './navBar.vue'
import abonnement from './abonnement.vue'

export default {
  name: 'abonnements',
  components: {NavBar, abonnement},
  data () {
    return {
      abonnements: '',
			visiteur: true,
    }
  },

	mounted () {

		//Verif visiteur
		if(this.$store.state.token == 'visiteur')
			this.visiteur = false;
		else {
			window.axios.get('abonnements/'+this.$store.state.member.id).then((response) => {
				this.abonnements = response.data;
			}).catch((error) => {
			});
		}

		window.bus.$on('updateAbonnements',() => {
			window.axios.get('abonnements/'+this.$store.state.member.id).then((response) => {
				this.abonnements = response.data;
			}).catch((error) => {
			});
    })

	}
}
</script>

<style scoped>
h2 {
	margin-left: auto;
	margin-right: auto;
	margin-top: 15px;
	font-size: 24px;
}

.titre{
	margin-left:8px;
	margin-bottom: 8px;
}

.contentAbonnement{
  text-align:center;
  font-size:32px;

}
</style>
