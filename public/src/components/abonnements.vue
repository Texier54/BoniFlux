<template>
	<div>
		<nav-bar></nav-bar>
    <section>
  		<div class="columns">
  			<div class="column is-7">
      		<abonnement v-for="abonnement in abonnements" :abonnement="abonnement"></abonnement>
        </div>
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
      abonnements: ['test', 'test'],
    }
  },
}
</script>

<style scoped>

</style>
