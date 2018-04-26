<template>
  <div>
    <nav-bar></nav-bar>
    <section class="container">
      <div class="columns main">
        <div class="mainvideo column is-8">
          <h2 class="is-size-1">{{ stream.nom }}</h2>
          <div id="stream"></div>
          <p><i class="fas fa-user"></i> {{numberOfUsers}}</p>
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
import NavBar from "./navBar.vue";
import message from "./message.vue";

//let socket = io("localhost:3000");

let p = null;

export default {
  name: "diffusion",
  components: { NavBar, message },
  data() {
    return {
      map: "",
      messages: [],
      editMessage: "",
      stream: "",
      abonnements: "",
      ifabo: true,
      visiteur: true,
      imagestream: "",
      video: "",
      numberOfUsers: 0
    };
  },

  methods: {
    abo() {
      if (this.visiteur == false) {
        alert("Vous ne pouvez pas vous abonner en tant que visiteur");
      } else {
        window.axios
          .post("abonnement", {
            id_streamer: this.stream.id_user,
            id_abonne: this.$store.state.member.id
          })
          .then(response => {
            this.ifabo = false;
          })
          .catch(error => {
            alert(error);
          });
      }
    },

    saveMess() {
      window.axios
        .post("messages/" + this.$route.params.id, {
          message: this.editMessage,
          id_stream: this.$route.params.id,
          id_user: this.$store.state.member.id
        })
        .then(response => {
          this.editMessage = "";
        })
        .catch(error => {
          alert(error);
        });
    }
  },
  mounted() {
    setInterval(()=>{
      this.numberOfUsers = this.connection.getAllParticipants().length;
    },2000)
    //Verif visiteur
    if (this.$store.state.token == "visiteur") this.visiteur = false;
    else {
      window.axios
        .get("abonnements/" + this.$store.state.member.id)
        .then(response => {
          this.abonnements = response.data;
          for (var i = 0; i < this.abonnements.length; i++) {
            if (this.abonnements[i].id_streamer == this.stream.id_user) {
              this.ifabo = false;
            }
          }
        })
        .catch(error => {});
    }

    window.axios
      .get("stream/" + this.$route.params.id)
      .then(response => {
        this.stream = response.data;

        this.map = L.map("map", {
          center: [this.stream.latitude, this.stream.longitude],
          zoom: 12
        });
        L.tileLayer("http://{s}.tile.osm.org/{z}/{x}/{y}.png", {
          attribution: "Boniflux",
          minZoom: 1,
          maxZoom: 16
        }).addTo(this.map);
      })
      .then(() => {
        this.connection = new RTCMultiConnection();
        this.connection.socketURL =
          "https://rtcmulticonnection.herokuapp.com:443/";
        this.connection.session = {
          audio: true,
          video: true,
          data: true
        };

        this.connection.mediaConstraints = {
          audio: false,
          video: false
        };

        this.connection.sdpConstraints.mandatory = {
          OfferToReceiveAudio: true,
          OfferToReceiveVideo: true
        };

        this.connection.dontCaptureUserMedia = true;

        this.connection.join(this.stream.stream_room_uuid);

        this.connection.onstream = function(event) {
          document.querySelector("#stream").appendChild(event.mediaElement);
          console.clear();
        };
      })
      .catch(error => {});
    setInterval(()=>{
      window.axios
      .get("messages/" + this.$route.params.id)
      .then(response => {
        this.messages = response.data.reverse();
      })
      .catch(error => {});
    },2000)
  }
};
</script>

<style scoped>
.container {
}

#map {
  height: 400px;
}

h2 {
  font-size: 26px;
  padding: 4px 4px;
}

body {
  background-color: #f2f6fa;
  margin: 0px;
  padding: 0px;
  outline: 0px;
  height: 100%;
  width: 100%;
  position: absolute;
}

.btn {
  font-weight: bold;
  -webkit-transition-property: color;
  -webkit-transition-duration: 0.5s;
  -moz-transition-property: color;
  -moz-transition-duration: 0.5s;
  transition-property: color;
  transition-duration: 0.5s;
}

.btn:hover {
  color: #363636;
}

.listemessage {
  max-height: 400px;
  overflow: scroll;
}

.btnAbo {
  margin: 10px;
}

.main {
  margin-top: 30px;
}
</style>
