<template>
	<div>
		<nav-bar></nav-bar>
		<div class="columns">
			<div class="column is-7" style="height: 500px;">
    		<a class="button is-link" @click="démarer">Démarer</a>
				<h1>Retour</h1>
				<div><video ref="video" id="video" width="640" height="480" autoplay></video></div>
				<div><button id="snap" v-on:click="capture()">Snap Photo</button></div>
				<canvas ref="canvas" id="canvas" width="640" height="480"></canvas>
				<ul>
						<li v-for="c in captures">
								<img v-bind:src="c" height="50" />
						</li>
				</ul>			</div>
		</div>
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
    }
  },

	mounted() {
	    this.video = this.$refs.video;
	    if(navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
	        navigator.mediaDevices.getUserMedia({ video: true }).then(stream => {
	            this.video.src = window.URL.createObjectURL(stream);
	            this.video.play();
	        });
	    }
	},

	methods: {
	    capture() {
	        this.canvas = this.$refs.canvas;
	        var context = this.canvas.getContext("2d").drawImage(this.video, 0, 0, 640, 480);
	        this.captures.push(canvas.toDataURL("image/png"));
	    },

			demarrer() {

			}
	}
}
</script>

<style scoped>

</style>
