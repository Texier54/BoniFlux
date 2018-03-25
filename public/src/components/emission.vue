<template>
	<div>
		<nav-bar></nav-bar>
		<section class="container">
		<div class="columns">
			<div class="column is-8">
    		<a class="btn button is-link" @click="demarrer">Démarer</a>
				<div>
					<video class="video" ref="video" id="video" autoplay></video>
				</div>
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

import NavBar from './navBar.vue'

export default {
  name: 'emission',
  components: {NavBar},
  data () {
    return {
		video: {},
		canvas: {},
		captures: [],
		intervalProgress: '',
		messages: '',
		editMessage: '',
		visiteur: false
    }
  },

	mounted() {
	    this.video = this.$refs.video;
	    if(navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
	        navigator.mediaDevices.getUserMedia({ video: true, audio: false }).then(stream => {
	            this.video.src = window.URL.createObjectURL(stream)
	            this.video.play()
	        });
		}
			// window.axios.get('messages/'+this.$route.params.id).then((response) => {
			// 	this.messages = response.data;
			// 	window.setInterval(function() {
			// 		var elem = document.getElementById('messages');
			// 		elem.scrollTop = elem.scrollHeight;
			// 	}, 500);
			// }).catch((error) => {
			// });
	},

	methods: {
	    capture() {
	        this.canvas = this.$refs.canvas
	        var context = this.canvas.getContext("2d").drawImage(this.video, 0, 0, 640, 480)
	        this.captures.push(canvas.toDataURL("image/png"))
	    },

		demarrer() {
			console.log("Je stream")
		},
		saveMess() {
			alert('Not Working')
    	}
	}
}
</script>

<style scoped>

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

.button{
	margin: 10px;
}

#video{
	height: 480px;
}
</style>
