<template>
	<div>
		<nav-bar></nav-bar>
		<section class="container">
		<div class="columns">
			<div class="column is-8">
        <!-- <button  class="btn btn-primary">Démarrer la vidéo</button> -->
        <a class="btn button is-link" id="start">Démarer</a>
        <video id="emitter-video" ref="video" width="100%" height="400px" controls></video>
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
let socket = io("localhost:3000");
let p = null;

import NavBar from "./navBar.vue";

export default {
  name: "emission",
  components: { NavBar },
  data() {
    return {
      video: {},
      canvas: {},
      captures: [],
      intervalProgress: "",
      messages: "",
      editMessage: "",
      visiteur: false,
      stream: ""
    };
  },

  mounted() {
    this.video = this.$refs.video;
    // if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
    //   navigator.mediaDevices
    //     .getUserMedia({ video: true, audio: false })
    //     .then(stream => {
    //       this.video.src = window.URL.createObjectURL(stream);
    //       this.video.play();
    //     });
    // }
    // let app = document.createElement("script", {
    //   attrs: { src: require("../assets/app.js") }
    // });
    // document.head.appendChild(app);

    let simplePeer = document.createElement("script", {
      attrs: { src: require("../assets/simplePeer.js") }
    });
    document.head.appendChild(simplePeer);

    document.querySelector("#start").addEventListener("click", e => {
      navigator.mediaDevices
        .getUserMedia({
          audio: true,
          video: true
        })
        .then(stream => {
          p = new SimplePeer({
            initiator: true,
            stream: stream,
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
            },
            trickle: false
          });

          this.bindEvents(p);

          this.video.volume = 0;
          this.video.srcObject = stream;
          this.video.play();
        });
    });

    socket.on("answerForInitiator", answer => {
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

      p.signal(JSON.parse(answer));
    });
  },

  methods: {
    capture() {
      this.canvas = this.$refs.canvas;
      var context = this.canvas
        .getContext("2d")
        .drawImage(this.video, 0, 0, 640, 480);
      this.captures.push(canvas.toDataURL("image/png"));
    },

    // demarrer() {
    //   window.setInterval(() => {
    //     this.$refs.canvas.style.display = "none";
    //     this.stream = this.$refs.canvas;
    //     this.stream.getContext("2d").drawImage(this.video, 0, 0, 640, 480);
    //     socket.emit("stream", this.stream.toDataURL());
    //   }, 46);
    // },
    saveMess() {
      alert("Not Working");
    },
    bindEvents(p) {
      p.on("error", err => {
        console.log("Error", err);
      });

      p.on("signal", data => {
        //document.querySelector("#offer").textContent = JSON.stringify(data);
        socket.emit("offerInitiator", JSON.stringify(data));
      });

      p.on("stream", stream => {
        console.log("Nice");
      });
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
