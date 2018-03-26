<template>
  <div>
    <nav-bar></nav-bar>
    <section class="container">
      <div class="columns main">
        <div class="mainvideo column is-8">
          <h2 class="is-size-1">{{ stream.nom }}</h2>
          <video src="https://www.youtube.com/embed/yZLRrNFZN50?autoplay=0" controls="controls"></video>
          <!--<iframe autoplay="1" src="https://www.youtube.com/embed/yZLRrNFZN50?autoplay=0" style="width: 100%; height: 100%;" frameborder="0" allowfullscreen ></iframe>-->
        </div>
        <div class="column is-4">
            <h2>Chat</h2>
            <div class="listemessage" id="messages">
              <message v-for="message in messages" :message="message" :key="message.id"></message>
            </div>
            <input v-if="visiteur" @keyup.enter="saveMess" class="input" placeholder="Message" v-model="editMessage">
            <input v-else class="input" placeholder="Vous ne pouvez pas parle en visiteur" disabled>
        </div>
      </div>
      <div class="">
        <div class="btnAbo">
            <a class="button is-link has-text-weight-semibold" v-show="ifabo" @click="abo">S'abonner</a>
            <a class="button is-danger has-text-weight-semibold" v-show="!ifabo">Se désabonner</a>
          </div>
      </div>
        <div class="">
            <div id="map">
            </div>
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
        alert('Vous ne pouvez pas vous abonner en tant que visiteur');
      }
      else {
        window.axios.post('abonnement',{

          id_streamer : this.stream.id_user,
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
          window.setInterval(function() {
            var elem = document.getElementById('messages');
            elem.scrollTop = elem.scrollHeight;
          }, 100);
        }).catch((error) => {
          alert(error);
        });

      }).catch((error) => {
        alert(error);
      });


    }
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
            attribution: 'Boniflux',
            minZoom: 1,
            maxZoom: 16
        }).addTo(this.map);

    }).catch((error) => {
    });

    window.axios.get('messages/'+this.$route.params.id).then((response) => {
      this.messages = response.data;
      window.setInterval(function() {
        var elem = document.getElementById('messages');
        elem.scrollTop = elem.scrollHeight;
      }, 500);
    }).catch((error) => {
    });

  }
}
</script>

<style scoped>

.container{
}

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

.listemessage{
  max-height: 400px;
  overflow: scroll;
}

.btnAbo{
  margin: 10px;
}

.main{
  margin-top: 30px;
}

</style>
