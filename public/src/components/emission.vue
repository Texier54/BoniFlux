<template>
	<div>
		<nav-bar></nav-bar>
		<div class="columns">
			<div class="column is-7" style="height: 500px;">
    		<a class="button is-link">Démarer</a>
				<h1>Retour</h1>
				<iframe autoplay="1" src="https://www.youtube.com/embed/yZLRrNFZN50?autoplay=0" style="width: 100%; height: 100%;" frameborder="0" allowfullscreen ></iframe>
			</div>
		</div>
	</div>
</template>

<script>

import NavBar from './navBar.vue'

export default {
  name: 'emission',
  components: {NavBar},
  data () {
    return {
    }
  },
}
</script>

<style scoped>

</style>
