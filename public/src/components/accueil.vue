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

      <div class="end"></div>

      <div class="columns">
        <listeStream v-for="stream in streams" :stream="stream"></listeStream>
      </div>

    </section>

    <div v-show="modalCo" class="modal is-active">
      <div class="modal-background"></div>
      <div class="modal-card">
        <header class="modal-card-head">
          <p class="modal-card-title">Connexion</p>
        </header>
        <form @submit="seConnecter">
          <section class="modal-card-body">
              <label class="label">E-mail</label>
              <div class="control">
                <input class="input" type="text" placeholder="E-mail" v-model="email">
              </div>

              <label class="label">Mot de passe</label>
              <div class="control">
                <input class="input" type="password" placeholder="Mot de passe" v-model="password">
              </div>
          </section>
          <footer class="modal-card-foot">
              <input type="submit" value="Connexion" class="button is-success">
              <button class="button" @click="modalCo=false; modalIn= true;">Inscription</button>
          </footer>
        </form>
      </div>
    </div>


    <div v-show="modalIn" class="modal is-active">
      <div class="modal-background"></div>
      <div class="modal-card">
        <header class="modal-card-head">
          <p class="modal-card-title">Inscription</p>
        </header>
        <section class="modal-card-body">

          <label class="label">Pseudo</label>
          <div class="control">
            <input class="input" type="text" placeholder="Pseudo" v-model="pseudo">
          </div>

          <label class="label">E-mail</label>
          <div class="control">
            <input class="input" type="text" placeholder="E-mail" v-model="email">
          </div>

          <label class="label">Mot de passe</label>
          <div class="control">
            <input class="input" type="password" placeholder="Mot de passe" v-model="password">
          </div>

        </section>
        <footer class="modal-card-foot">
          <button class="button is-success">S'inscrire</button>
          <button class="button" @click="modalCo=true; modalIn= false;">Connexion</button>
        </footer>
      </div>
    </div>


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
      streams: [1, 2, 3, 4, 5, 6],
      modalCo: false,
      modalIn: false,
      email : '',
      password : '',
      pseudo: '',
    }
  },
  mounted() {
    if(!this.$store.state.member) {
      this.modalCo = true;
    }

  },
  methods : {
    seConnecter() {
      window.axios.post('members/signin',{

        email : this.email,
        password : this.password

      }).then((response) => {

        this.$store.commit('setMember', response.data);
        this.$store.commit('setToken',response.data.token);

          axios.get('members').then((response) => {
            this.$store.commit('setListeMember',response.data);
          }).catch((error) => {
          });


        window.axios.defaults.params.token = response.data.token;

        this.$router.push({path: '/'});

      }).catch((error) => {

        alert(error.response.data.error.join("\n"));

      });

    }
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
