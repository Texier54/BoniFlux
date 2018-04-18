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
              Une application web permettant de simplement diffuser en direct des flux vidéos, d'enregistrer ces flux et d'ensuite les gérer (classer, partager, supprimer, travailler la vidéo, etc.).
          </p>
        </div>
        <div class="has-text-centered is-marginless">
          <!--<router-link class="button is-link is-large is-capitalized has-text-weight-bold" :to="{ name:'emission', params : {} }">
          <i class="marker fas fa-circle" style="color: red;"></i>Démarer un Stream</router-link>-->

          <!-- Bouton pour modal stream -->
          <button class="button is-link is-large is-capitalized has-text-weight-bold" @click="openStream"><i class="marker fas fa-circle" style="color: red;"></i>Démarrer le Stream</button>
          <!-- Bouton pour modal stream -->
          <router-link :to="{name:'record'}" class="button is-link is-large is-capitalized has-text-weight-bold"><i class="marker fas fa-circle" style="color: red;"></i>Record</router-link>

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
        <listeStream v-for="stream in streams" :stream="stream" :key="stream.id"></listeStream>
        <div class="column is-2">
          <router-link v-show="this.$route.path !=='/abonnements'" class="nav btn button is-success is-medium btnPLus" :to="{ name:'streams', params : {} }"><i class="marker fas fa-plus-circle"></i>Plus</router-link>
        </div>
      </div>


      <div class="columns">

      </div>

    </section>

    <div v-show="modalCo" class="modal is-active">
      <div class="modal-background-gray"></div>
      <div class="modal-card">
        <header class="modal-card-head">
          <p class="modal-card-title">Connexion</p>
        </header>
        <form @submit="seConnecter">
          <section class="modal-card-body">
              <label class="label">E-mail</label>
              <div class="control">
                <input class="input" type="text" placeholder="E-mail" v-model="email" required>
              </div>

              <label class="label">Mot de passe</label>
              <div class="control">
                <input class="input" type="password" placeholder="Mot de passe" v-model="password" required>
              </div>
          </section>
          <footer class="modal-card-foot">
              <input type="submit" value="Connexion" class="button is-success">
              <button class="button" @click="modalCo=false; modalIn= true;">Inscription</button>
              <a class="button" @click="modeVisiteur">Mode Visiteur</a>
          </footer>
        </form>
      </div>
    </div>


    <div v-show="modalIn" class="modal is-active">
      <div class="modal-background-gray"></div>
      <div class="modal-card">
        <header class="modal-card-head">
          <p class="modal-card-title">Inscription</p>
        </header>
        <form @submit="creerMembre">
          <section class="modal-card-body">

            <label class="label">Nom</label>
            <div class="control">
              <input class="input" type="text" placeholder="Nom" v-model="nom" required>
            </div>

            <label class="label">Prénom</label>
            <div class="control">
              <input class="input" type="text" placeholder="Prénom" v-model="prenom" required>
            </div>

            <label class="label">Pseudo</label>
            <div class="control">
              <input class="input" type="text" placeholder="Pseudo" v-model="pseudo" required>
            </div>

            <label class="label">E-mail</label>
            <div class="control">
              <input class="input" type="text" placeholder="E-mail" v-model="email" required>
            </div>

            <label class="label">Mot de passe</label>
            <div class="control">
              <input class="input" type="password" placeholder="Mot de passe" v-model="password" required>
            </div>

          </section>
          <footer class="modal-card-foot">
            <input type="submit" class="button is-success" value="S'inscrire">
            <a class="button" @click="modalCo=true; modalIn= false;">Connexion</a>
          </footer>
        </form>
      </div>
    </div>

    <div v-show="modalStart" class="modal is-active">
      <div class="modal-background"></div>
      <div class="modal-card">
        <header class="modal-card-head">
          <p class="modal-card-title">Initialiser le stream</p>
        </header>
        <form @submit="demarrerStream">
          <section class="modal-card-body">

              <label class="label">Nom du stream</label>
              <div class="control">
                <input class="input" type="text" placeholder="Nom du stream" v-model="nomStream" required>
              </div>

              <label class="label">Description</label>
              <div class="control">
                <input class="input" type="text" placeholder="Description" v-model="descriptionStream">
              </div>

              <label class="label">Activer le mode Urgence ?</label>
              <div class="control">
               <input id="checkBox" type="checkbox" v-model="urgence">
              </div>

              <label class="label">Stream anonyme ?</label>
              <div class="control">
               <input id="checkBox" type="checkbox" v-model="anonyme">
              </div>

              <label class="label">Rendre la vidéo publique ? (Vous pourrez la rendre publique durant le stream)</label>
              <div class="control">
               <input id="checkBox" type="checkbox" v-model="publique">
              </div>

          </section>
          <footer class="modal-card-foot">
              <input type="submit" value="Créer un stream" class="button is-success">
              <button class="button" @click="modalStart=false;">Annuler</button>
          </footer>
        </form>
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
      streams: '',
      modalCo: false,
      modalIn: false,
      modalStart: false,
      nom : '',
      prenom : '',
      email : '',
      password : '',
      pseudo: '',
      nomStream : '',
      descriptionStream : '',
      urgence : false,
      anonyme : false,
      publique : true,
      visiteur: true,
    }
  },
  mounted() {

    //Verif visiteur
		if(this.$store.state.token == 'visiteur')
			this.visiteur = false;

    if(!this.$store.state.member) {
      this.modalCo = true;
    }
    window.bus.$on('logout',() => {
      this.$router.push({path: '/'});
      this.$store.commit('setMember', false);
      this.$store.commit('setToken', false);
      this.$router.push({path: '/'});
      this.modalCo = true;
    })

    window.axios.get('streams').then((response) => {
      this.streams = response.data;
    }).catch((error) => {
    });

  },
  methods : {
    seConnecter() {
      window.axios.post('members/signin',{

        email : this.email,
        password : this.password

      }).then((response) => {

        this.$store.commit('setMember', response.data.member);
        this.$store.commit('setToken', response.data.token);

        //window.axios.defaults.params.token = response.data.token;

        this.$router.push({path: '/'});
        this.modalCo = false;

      }).catch((error) => {
        console.log(error);
        alert(error);

      });

    },

    creerMembre() {
      window.axios.post('members',{

        nom : this.nom,
        prenom : this.prenom,
        pseudo : this.pseudo,
        email : this.email,
        password : this.password,

      }).then((response) => {

        console.log(response.data);
        alert('Le membre '+response.data.pseudo+' a été créé. Vous pouvez vous connecter');
        this.$router.push({path: '/connexion'});
        this.modalCo=true;
        this.modalIn= false;

      }).catch((error) => {
        alert(error);
      });

    },

    openStream() {
      if(this.visiteur === false) alert('Vous ne pouvez pas démarrer un stream en tant que visiteur');
      else this.modalStart=true;
    },

    demarrerStream() {

      window.axios.post('createStream',{

        nomStream : this.nomStream,
        descriptionStream : this.descriptionStream,
        urgence : this.urgence,
        anonyme : this.anonyme,
        publique : this.publique,
        id_user : this.$store.state.member.id

      }).then((response) => {

        this.$router.push({path: '/emission'});
        this.modalStart=false;

      }).catch((error) => {
        alert(error);
      });

    },

    modeVisiteur() {
      this.$store.commit('setMember', 'Visiteur' );
      this.$store.commit('setToken', 'visiteur');
      this.$router.push({path: '/'});
      this.modalCo = false;
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

.modal-background-gray {
  background-color: gray;
  bottom: 0;
  left: 0;
  right: 0;
  top: 0;
  position: absolute;
}

.btnPLus{
  top: 33%;
  margin-left: 33%;
}
</style>
