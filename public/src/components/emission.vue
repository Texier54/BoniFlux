<template>
	<div>
		<nav-bar></nav-bar>
		<section class="container">
		<div class="columns">
			<div class="column is-8">
        <a class="btn button is-link" id="open" @click="open" v-if="!stop">Démarer</a>
        <router-link class="btn button is-link" to="record" target="_blank" v-if="!stop">Record</router-link>
        <a class="btn button is-danger" id="stop" @click="stopStream">Stopper</a>
        <div id="emission"></div>
        <p><i class="fas fa-user"></i> {{numberOfUsers}}</p>
				<div>
					<button class="btn button is-success" id="snap" v-on:click="capture()">Snap Photo</button>
				</div>
				<canvas ref="canvas" id="canvas" width="640" height="480"></canvas>
				<ul>
					<li v-for="c in captures">
						<img v-bind:src="c" height="50" />
					</li>
				</ul>
			</div>
			<div class="column is-4">
				<h2>Chat</h2>
				<div class="listemessage" id="messages">
					<message v-for="message in messages" :message="message" :key="message.id"></message>
				</div>
				<input v-if="visiteur" @keyup.enter="saveMess" class="input" placeholder="Message" v-model="editMessage">
				<input v-else class="input" placeholder="Vous ne pouvez pas envoyer de message sur votre stream" disabled>
      </div>
		</div>
		</section>
	</div>
</template>

<script>
//let socket = io("localhost:3000");
let p = null;

import NavBar from "./navBar.vue";

export default {
  name: "emission",
  components: { NavBar },
  data() {
    return {
      canvas: {},
      captures: [],
      intervalProgress: "",
      messages: "",
      editMessage: "",
      visiteur: false,
      stop: false,
      numberOfUsers: 0
    };
  },

  mounted() {
    setInterval(()=>{
      this.numberOfUsers = this.connection.getAllParticipants().length;
    },1000)
    this.connection = new RTCMultiConnection();
    this.connection.socketURL = "https://rtcmulticonnection.herokuapp.com:443/";

    this.connection.onstream = function(event) {
      document.querySelector("#emission").appendChild(event.mediaElement);
      console.clear();
    };
  },

  methods: {
    capture() {
      this.canvas = this.$refs.canvas;
      var context = this.canvas
        .getContext("2d")
        .drawImage(this.video, 0, 0, 640, 480);
      this.captures.push(canvas.toDataURL("image/png"));
    },
    saveMess() {
      alert("Not Working");
    },
    open() {
      this.connection.session = {
        audio: true,
        video: true,
        data: true
      };

      this.connection.mediaConstraints = {
        audio: true,
        video: true
      };

      this.connection.sdpConstraints.mandatory = {
        OfferToReceiveAudio: false,
        OfferToReceiveVideo: false
      };

      this.connection.open(this.$store.state.uuidStream);
      console.clear();
    },
    stopStream() {
      this.connection.attachStreams.forEach(function(localStream) {
        localStream.stop();
      });

      this.connection.close();

      this.stop = true;

      window.axios
        .put("stopStream", {
          trash: 1,
          uuid: this.$store.state.uuidStream
        })
        .then(res => {
          console.log(res.data);
          this.$route.push("accueil");
        })
        .catch(err => {});
    }
  }
};
</script>

<style scoped>
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

.button {
  margin: 10px;
}

#video {
  height: 480px;
}
</style>
