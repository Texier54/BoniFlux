<template>
  <div class="column is-3">

    <img class="Timg" src="http://download.seaicons.com/icons/iconsmind/outline/512/Webcam-icon.png">
    <div class="contentStream">
      <p>{{ stream.nom }}</p>
      <strong v-if="stream.anonyme==0">{{ user.pseudo }}</strong>
      <i><strong v-if="stream.anonyme==1">Anonyme</strong></i>
    </div>
    <div class="is-size-5 has-text-centered data">
          <router-link class="button is-success" :to="{ name:'diffusion', params : { id : stream.id } }">Regarder</router-link>
    </div>

  </div>
</template>

<script>
export default {
  props: ["stream"],
  name: "stream",
  components: {},
  data() {
    return {
      user: ""
    };
  },
  methods: {},
  mounted() {
    console.log(this.stream.id);
    console.log(this.stream.nom);
    window.axios
      .get("user/" + this.stream.id_user)
      .then(response => {
        this.user = response.data;
      })
      .catch(error => {});
  }
};
</script>

<style scoped>
.Timg {
  width: 50%;
  margin-left: 25%;
}

.marker {
  margin-right: 10px;
}

.contentStream {
  text-align: center;
}
</style>
