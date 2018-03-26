<template>
  <div class="column is-2">
    <img class="Timg" src="http://download.seaicons.com/icons/iconsmind/outline/512/Webcam-icon.png">
    <div class="contentStream">
      <p>{{ stream.nom }}</p>
      <strong v-if="stream.anonyme==0">{{ user.pseudo }}</strong>
      <i><strong v-if="stream.anonyme==1">Anonyme</strong></i>
    </div>
    <div class="has-text-centered data">
          <router-link class="button is-success" :to="{ name:'diffusion', params : { id : stream.id } }"><i class="fas fa-eye marker"></i>Regarder</router-link>
    </div>

  </div>
</template>

<script>

export default {
  props: ['stream'],
  name: 'listeStream',
  data () {
    return {
      user: '',

    }
  },
  mounted() {
    window.axios.get('user/'+this.stream.id_user).then((response) => {
      this.user = response.data;
    }).catch((error) => {
    });
  }
}
</script>

<style scoped>

.button{
  margin: 10px;
  -webkit-transition-property: color;
  -webkit-transition-duration: 0.5s;
  -moz-transition-property: color;
  -moz-transition-duration: 0.5s;
  transition-property: color;
  transition-duration: 0.5s;
}

.button:hover{
  color: #363636;
}

.titre{
  background-color: #DBDBDB;
}

.first{
  border-radius: 5px 0px 0px 5px;
}

.last{
  border-radius: 0px 5px 5px 0px;
}
.end{
  border-bottom: 1px solid black;
}

.Timg{
  width:50%;
  margin-left: 25%;
}

.marker{
  margin-right: 10px;
}

.contentStream{
  text-align: center;
}
</style>
