<template>
  <div>
    <nav-bar></nav-bar>
    <section class="section coop-accueil">
      <nav class="panel">
        <p class="panel-heading is-size-4 has-text-weight-semibold has-text-info">
          Bienvenue sur GeoQuizz !!!
        </p>
        <div class="panel-block">
          <p class="control has-icons-left is-size-5">
            Un jeu amusant où tu dois positionner une photo sur la carte de ta ville sans te tromper et plus vite que les autres !
            Il est possible de choisir son niveau pour avoir plus de photos ou devoir être plus précis dans les réponses.
          </p>
        </div>
        <div class="has-text-centered is-marginless">
          <button class="button is-primary is-large is-capitalized has-text-weight-bold" @click="lancerPartie"><i class="marker fas fa-gamepad"></i>Lancer partie</button>
          <router-link v-show="this.$store.state.partie.save" class="button is-primary is-large is-capitalized has-text-weight-bold" :to="{ name:'partie', params : { partie : this.$store.state.partie } }"><i class="marker fas fa-gamepad"></i>Reprendre partie</router-link>
          <p class="is-size-5 has-text-centered has-text-weight-semibold" v-show="this.$store.state.partie"><i class="marker-warning fas fa-exclamation-triangle "></i>Recommencer une partie supprimera la sauvegarde<i class="marker-warning fas fa-exclamation-triangle "></i></p>
        </div>
      </nav>
      <div class="border">
        <div class="is-size-2 has-text-centered is-capitalized has-text-weight-bold">
          <p>Tableau des scores</p>
        </div>
        <div class="is-size-6 has-text-centered has-text-weight-semibold">
          <p>(Classé du meilleur score au moins bon)</p>
        </div>
      </div>
      <div class="columns is-multiline">
        <div class="column is-size-4 has-text-centered has-text-weight-semibold titre first">
          Pseudo
        </div>
        <div class="column is-size-4 has-text-centered has-text-weight-semibold titre">
          Série
        </div>
        <div class="column is-size-4 has-text-centered has-text-weight-semibold titre">
          Score
        </div>
        <div class="column is-size-4 has-text-centered has-text-weight-semibold titre last">
          Nombre de photo
        </div>
        <div class="column is-size-4 has-text-centered has-text-weight-semibold titre last">
          Niv. de difficulté
        </div>
        <div class="column is-size-4 has-text-centered has-text-weight-semibold titre last">
          Date
        </div>
      </div>
      <div class="end"></div>
      <tabScore v-for="tableau in tableaux" :tableau="tableau"></tabScore>
    </section>
    <startgame :lancer="lancer" v-show="lancer"></startgame>
  </div>
</template>

<script>

import NavBar from './navBar.vue'
import startgame from './startgame.vue'
import tabScore from './tableauScore.vue'

export default {
  name: 'lancerPartie',
  components: {NavBar, startgame, tabScore},
  
  data () {
    return {
      lancer: false,
      tableaux: []
    }
  },
  methods : {
    lancerPartie() {
      this.lancer = true;
    },
  },
  mounted() {

    if(typeof this.$store.state.partie !== 'undefined' && this.$store.state.partie.save !== true)
      this.$store.commit('setPartie', false);

    window.axios.get('partie',{
    }).then((response) => {
      this.tableaux = response.data;
    }).catch((error) => {
      console.log(error);
    });

    window.bus.$on('fermerStartGame',() => {
      this.lancer = false;
    });

  }
}
</script>

<style scoped>

body {
  background-color: #F2F6FA;
  margin: 0px;
  padding: 0px;
  outline: 0px;
  height: 100%;
  width: 100%;
  position: absolute;
}

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

.columns{
  border-radius: 5px;
  margin-top: 20px;
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

.data{
  border-bottom: 1px solid black;
}

.marker{
  margin-right: 10px;
}

.marker-warning{
  margin-right: 10px;
  margin-left: 10px;
}

.border{
  border-top: 3px solid #363636;
}

.end{
  border-bottom: 1px solid black;
}
</style>