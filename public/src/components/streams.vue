<template>
	<div>
		<nav-bar></nav-bar>
    <section>
  		<div class="is-size-1">
			<h2>Liste des streams en cours</h2>
		</div>
		<div class="columns">
				<stream  v-for="stream in abonnements" :stream="stream" :key="stream.id"></stream>
		</div>
    </section>
	</div>
</template>

<script>
import NavBar from "./navBar.vue";
import stream from "./stream.vue";

export default {
  name: "abonnements",
  components: { NavBar, stream },
  data() {
    return {
      abonnements: "",
      visiteur: true
    };
  },

  mounted() {
    window.axios
      .get("streams")
      .then(response => {
        this.abonnements = response.data;
      })
      .catch(error => {});
  }
};
</script>

<style scoped>
h2 {
  margin-left: auto;
  margin-right: auto;
  margin-top: 15px;
  font-size: 24px;
}

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
