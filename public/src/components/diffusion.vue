<template>
  <div>
    <nav-bar></nav-bar>
    <section class="container">
      <div class="columns">
        <div class="column is-8" style="height: 500px;">
          <h2>{{ stream.nom }}</h2>
          <iframe autoplay="1" src="https://www.youtube.com/embed/yZLRrNFZN50?autoplay=0" style="width: 100%; height: 100%;" frameborder="0" allowfullscreen ></iframe>
        </div>
        <div class="column is-3">
            <h2>Chat</h2>
            <message v-for="message in messages" :message="message"></message>
            <input v-if="visiteur" @keyup.enter="saveMess" class="input" placeholder="Message" v-model="editMessage">
            <input v-else class="input" placeholder="Vous ne pouvez pas parle en visiteur" disabled>
        </div>
      </div>
      <br>
      <div class="columns">
        <div class="column is-6">
            <div id="map" height="100px">
            </div>
        </div>
        <a class="button is-link" v-show="ifabo" @click="abo">S'abonner</a>
	      <a class="button is-danger" v-show="!ifabo">Se désabonner</a>
      </div>
    </section>
  </div>
</template>

<script>

import NavBar from './navBar.vue'
import message from './message.vue'

export default {
  name: 'diffusion',
  components: {NavBar, message},
  data () {
    return {
      map: '',
      messages: '',
      editMessage: '',
      stream: '',
      abonnements: '',
      ifabo: true,
      visiteur: true,
    }
  },

  methods : {

    abo() {

      if(this.visiteur == false)
      {
        alert('Vous ne pouvez pas vous abonné en tant que visiteur');
      }
      else {
        window.axios.post('abonnement',{

          id_streamer : this.$route.params.id,
          id_abonne : this.$store.state.member.id,

        }).then((response) => {

          this.ifabo = false;

        }).catch((error) => {
          alert(error);
        });
      }

    },

    saveMess() {


      window.axios.post('messages/'+this.$route.params.id,{

        message : this.editMessage,
        id_stream : this.$route.params.id,
        id_user : this.$store.state.member.id,

      }).then((response) => {

        this.editMessage = '';
        window.axios.get('messages/'+this.$route.params.id).then((response) => {
          this.messages = response.data;
        }).catch((error) => {
          alert(error);
        });

      }).catch((error) => {
        alert(error);
      });


    },
  },
  mounted() {

    //Verif visiteur
    if(this.$store.state.token == 'visiteur')
      this.visiteur = false;
    else {
      window.axios.get('abonnements/'+this.$store.state.member.id).then((response) => {
    		this.abonnements = response.data;
        for(var i= 0; i < this.abonnements.length; i++)
        {
    		    if(this.abonnements[i].id_streamer == this.stream.id_user)
            {
              this.ifabo = false;
            }
        }
    	}).catch((error) => {
    	});
    }

    window.axios.get('stream/'+this.$route.params.id).then((response) => {
      this.stream = response.data;

      this.map = L.map('map', {
        center: [this.stream.latitude, this.stream.longitude],
        zoom: 12,
        });
        L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
            attribution: 'GeoQuizz',
            minZoom: 1,
            maxZoom: 16
        }).addTo(this.map);

    }).catch((error) => {
    });

    window.axios.get('messages/'+this.$route.params.id).then((response) => {
      this.messages = response.data;
    }).catch((error) => {
    });

  }
}
</script>

<style scoped>

#map {
  height: 400px;
}

h2 {
  font-size: 26px;
  padding: 4px 4px;
}


body {
  background-color: #F2F6FA;
  margin: 0px;
  padding: 0px;
  outline: 0px;
  height: 100%;
  width: 100%;
  position: absolute;
}

.btn{
  font-weight: bold;
  -webkit-transition-property: color;
  -webkit-transition-duration: 0.5s;
  -moz-transition-property: color;
  -moz-transition-duration: 0.5s;
  transition-property: color;
  transition-duration: 0.5s;
}

.btn:hover{
  color: #363636;

}

</style>
