<template>
  <div class="column is-3">
    <img src="http://download.seaicons.com/icons/iconsmind/outline/512/Webcam-icon.png">
    <p>{{ stream.nom }}</p>
    <strong v-if="stream.anonyme==0">{{ user.pseudo }}</strong>
    <i><strong v-if="stream.anonyme==1">Anonyme</strong></i>

    <div class="column is-size-5 has-text-centered data">
          <router-link class="button is-success" :to="{ name:'diffusion', params : { id : stream.id } }">Regarder</router-link>
    </div>

  </div>
</template>

<script>

export default {
	props: ['stream'],
  name: 'stream',
  components: {},
  data () {
    return {
			user: '',
    }
  },
  methods : {
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
