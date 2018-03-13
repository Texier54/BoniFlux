<template>
	<div>
		<nav-bar></nav-bar>
    <section>
  		<div class="columns">
					<h2>Vos abonnements</h2>
			</div>
			<div class="columns">
      		<abonnement v-if="visiteur" v-for="abonnement in abonnements" :abonnement="abonnement"></abonnement>
					<p v-else></p>
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
    }
  },

	mounted () {

		//Verif visiteur
		if(this.$store.state.token == visiteur)
			visiteur = false;

		window.bus.$on('updateAbonnements',() => {
			window.axios.get('abonnements/'+this.$store.state.member.id).then((response) => {
				this.abonnements = response.data;
			}).catch((error) => {
			});
    })

		window.axios.get('abonnements/'+this.$store.state.member.id).then((response) => {
			this.abonnements = response.data;
		}).catch((error) => {
		});
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
.columns {
	margin-left: 20px;
}
</style>
