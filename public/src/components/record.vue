<template>
	<div>
		<nav-bar></nav-bar>
		<div class="columns">
			<div class="column is-7" style="height: 500px;">
        <a id="startButton" class="button is-link" @click="start">Start</a>
        <a id="downloadButton" class="button is-link" @click="download">Download</a>
				<div><video ref="video" id="video" width="640" height="480" autoplay></video></div>
        <section class="video-clips"></section>
      </div>
		</div>
	</div>
</template>

<script>
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
      theStream: '',
      theRecorder: '',
      recordedChunks: [],
      constraints : { "video": { width: { max: 320 } }, "audio" : true },
      clipName: ''
    };
  },

  mounted() {

  },

  methods: {
    start() {
      navigator.mediaDevices.getUserMedia(this.constraints)
          .then(stream => {
            this.theStream = stream;
            let video = document.querySelector('video');
            video.src = URL.createObjectURL(stream);
            try {
              var recorder = new MediaRecorder(stream, {mimeType : "video/webm"});
            } catch (e) {
              console.error('Exception while creating MediaRecorder: ' + e);
              return;
            }
            
            this.theRecorder = recorder;
            recorder.ondataavailable = 
                (event) => { this.recordedChunks.push(event.data); };
            recorder.start(100);
          })
          .catch(e => { console.error('getUserMedia() failed: ' + e); });
    },
    download() {
      this.theRecorder.stop();
      this.clipName = prompt('Le nom de l\'enregistrement')
      this.theStream.getTracks().forEach(track => { track.stop(); });

      let blob = new Blob(this.recordedChunks, {type: "video/webm"});
      let url =  URL.createObjectURL(blob);
      let a = document.createElement("a");
      document.body.appendChild(a);
      a.style = "display: none";
      a.href = url;
      a.download = this.clipName + '.webm';
      a.click();
      setTimeout(function() { URL.revokeObjectURL(url); }, 100); 
    }
  }
};
</script>

<style scoped>

</style>
