<template>
  <div>
    <nav-bar></nav-bar>
    <section class="container">
      <div class="columns main">
        <div class="mainvideo column is-8">
          <h2 class="is-size-1">{{ stream.nom }}</h2>
          <video id="receiver-video" ref="video" width="100%" height="400px" controls></video>
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

let socket = io("localhost:3000");

let p = null;

export default {
  name: "diffusion",
  components: { NavBar, message },
  data() {
    return {
      map: "",
      messages: "",
      editMessage: "",
      stream: "",
      abonnements: "",
      ifabo: true,
      visiteur: true,
      imagestream: "",
      video: ""
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
          window.axios
            .get("messages/" + this.$route.params.id)
            .then(response => {
              this.messages = response.data;
              // window.setInterval(function() {
              //   var elem = document.getElementById("messages");
              //   elem.scrollTop = elem.scrollHeight;
              // }, 100);
            })
            .catch(error => {
              alert(error);
            });
        })
        .catch(error => {
          alert(error);
        });
    },
    bindEvents(p) {
      p.on("error", err => {
        console.log("Error", err);
      });

      p.on("signal", data => {
        //document.querySelector("#offer").textContent = JSON.stringify(data);
        socket.emit("answerClient", JSON.stringify(data));
      });

      p.on("stream", stream => {
        this.video.volume = 0;
        this.video.srcObject = stream;
        this.video.play();
      });
    }
  },
  mounted() {
    this.video = this.$refs.video;
    // socket.on("retour", data => {
    //   this.imagestream = "";
    //   this.imagestream = data;
    //   this.$refs.retour.src = this.imagestream;
    // });

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
      .catch(error => {});

    window.axios
      .get("messages/" + this.$route.params.id)
      .then(response => {
        this.messages = response.data;
        // window.setInterval(function() {
        //   var elem = document.getElementById("messages");
        //   elem.scrollTop = elem.scrollHeight;
        // }, 500);
      })
      .catch(error => {});

    let simplePeer = document.createElement("script", {
      attrs: { src: require("../assets/simplePeer.js") }
    });
    document.head.appendChild(simplePeer);

    socket.on("offerForClient", offer => {
      if (p == null) {
        p = new SimplePeer({
          initiator: false,
          trickle: false,
          config: {
            iceServers: [
              {
                urls: ["stun:stun.l.google.com:19302"]
              },
              // {
              //   url: "stun:stun2.l.google.com:19302"
              // },
              // {
              //   url: "stun:stun3.l.google.com:19302"
              // },
              // {
              //   url: "turn:192.158.29.39:3478?transport=udp",
              //   credential: "JZEOEt2V3Qb0y27GRntt2u2PAYA=",
              //   username: "28224511:1379330808"
              // },
              {
                urls: ["turn:numb.viagenie.ca"],
                credential: "muazkh",
                username: "webrtc@live.com"
              }
            ]
          }
        });
        this.bindEvents(p);
      }

      p.signal(JSON.parse(offer));
    });

    // document.querySelector("#incoming").addEventListener("submit", e => {

    // });
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
