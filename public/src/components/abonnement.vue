<template>
	<div>
    <h2>MisterRIB</h2>

    <router-link class="button is-success" :to="{ name:'diffusion', params : { id : 1} }">Profil</router-link>

    <a class="button" @click="désabonner">Désabonner</a>
	</div>
</template>

<script>

export default {
  name: 'abonnement',
  components: {},
  data () {
    return {
    }
  },

  methods : {
    désabonner() {

    }
  }
}
</script>

<style scoped>

</style>
