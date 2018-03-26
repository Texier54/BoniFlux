<template>
	<div>
		<nav-bar></nav-bar>
		<section class="container">
			<div class="columns">
				<div class="column is-7" style="height: 500px;">
					<br>
	        <a id="startButton" class="button is-success" v-bind:class="{ 'is-warning': ifstart }" @click="start">Start</a>
	        <a id="downloadButton" class="button is-link" @click="download">Download</a>
					<br><br>
					<div><video ref="video" id="video" width="640" height="480" autoplay></video></div>
	        <section class="video-clips"></section>
	      </div>
        <div>
					<div class="columns">
						<div class="column is-7">
						<br>
            <label>Add file:</label><br>
            <input type="text" name="title" v-model="title" placeholder="Titre de la vidéo">
            <textarea v-model="description"></textarea>
            <input type="file" name="video" ref="file" @change="handleFileUpload"/>
            <button @click="postvideo">submit</button>
					</div>
				</div>
        </div>
			</div>
		</section>
	</div>
</template>

<script>
import NavBar from "./navBar.vue";

export default {
  name: "record",
  components: { NavBar },
  data() {
    return {
      video: {},
      theStream: '',
      theRecorder: '',
      recordedChunks: [],
      constraints : { "video": { width: { max: 320 } }, "audio" : true },
      clipName: '',
      ifstart: false,
      file: '',
      title: '',
      description: ''
    };
  },

  mounted() {

  },

  methods: {
    start() {
			this.ifstart = true;
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

      this.theStream.getTracks().forEach(track => { track.stop(); });
      this.clipName = prompt('Le nom de l\'enregistrement')
      let blob = new Blob(this.recordedChunks, {type: "video/webm"});
      let url =  URL.createObjectURL(blob);
      let a = document.createElement("a");
      document.body.appendChild(a);
      a.style = "display: none";
      a.href = url;
      a.download = this.clipName + '.webm';
      a.click();
      setTimeout(function() { URL.revokeObjectURL(url); }, 100);
    },
    postvideo(e) {
      let formData = new FormData()
      formData.append('video', this.file)
      formData.append('title', this.title)
      formData.append('description', this.description)
      formData.append('pseudo', this.$store.state.member.pseudo)
      formData.append('id_user', this.$store.state.member.id)
      window.axios.post( 'postvideo/',
        formData,
          {
          headers: {
              'Content-Type': 'multipart/form-data'
          }
        }
      ).then(function(){
          alert('La video à bien été upload')
      })
      .catch(function(){
        alert('Une erreur est survenu')
      })
      this.title = ""
      this.$refs.file = ""
      this.file = ""
    },
    handleFileUpload(){
      this.file = this.$refs.file.files[0];
    }
  }
};
</script>

<style scoped>

</style>
