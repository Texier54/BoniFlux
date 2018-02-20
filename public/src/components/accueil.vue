<template>
  <div>
    <nav-bar></nav-bar>
    <section class="section coop-accueil">
      <nav class="panel">
        <p class="panel-heading is-size-4 has-text-weight-semibold has-text-info">
          Bienvenue sur BoniFlux !!!
        </p>
        <div class="panel-block">
          <p class="control has-icons-left is-size-5">
            Un jeu amusant où tu dois positionner une photo sur la carte de ta ville sans te tromper et plus vite que les autres !
            Il est possible de choisir son niveau pour avoir plus de photos ou devoir être plus précis dans les réponses.
          </p>
        </div>
        <div class="has-text-centered is-marginless">
          <router-link class="button is-link is-large is-capitalized has-text-weight-bold" :to="{ name:'emission', params : {} }">
          <i class="marker fas fa-circle" style="color: red;"></i>Démarer un Stream</router-link>
        </div>
      </nav>
      <div class="border">
        <div class="is-size-2 has-text-centered is-capitalized has-text-weight-bold">
          <p>Liste des streams en cours</p>
        </div>
        <div class="is-size-6 has-text-centered has-text-weight-semibold">
          <p>(La liste n'est qu'un aperçus)</p>
        </div>
      </div>
      <div class="columns is-multiline">
        <div class="column is-size-4 has-text-centered has-text-weight-semibold titre first">
          Pseudo
        </div>
        <div class="column is-size-4 has-text-centered has-text-weight-semibold titre">
          Lieu
        </div>
        <div class="column is-size-4 has-text-centered has-text-weight-semibold titre">
          Date
        </div>
        <div class="column is-size-4 has-text-centered has-text-weight-semibold titre last">
          Vue(s)
        </div>
        <div class="column is-size-4 has-text-centered has-text-weight-semibold titre last">
          Regarder
        </div>
      </div>
      <div class="end"></div>
      <listeStream></listeStream>
    </section>
  </div>
</template>

<script>

import NavBar from './navBar.vue'
import listeStream from './listeStream.vue'

export default {
  name: 'accueil',
  components: {NavBar, listeStream},
  
  data () {
    return {
    }
  },
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
