<template>
  <div>
    <nav-bar></nav-bar>
    <section class="container">
      <div class="columns">
        <div class="column is-7" style="height: 500px;">
          <iframe autoplay="1" src="https://www.youtube.com/embed/yZLRrNFZN50?autoplay=0" style="width: 100%; height: 100%;" frameborder="0" allowfullscreen ></iframe>
        </div>
        <div class="column is-5">
            <div id="map" height="100px">
            </div>
        </div>
      </div>
    </section>
  </div>
</template>

<script>

import NavBar from './navBar.vue'

export default {
  name: 'diffusion',
  components: {NavBar},
  data () {
    return {
      map: '',
    }
  },

  mounted() {
    this.map = L.map('map', {
      center: [1, 1],
      zoom: 10,
      });
      L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
          attribution: 'GeoQuizz',
          minZoom: 1,
          maxZoom: 16
      }).addTo(this.map);
  }
}
</script>

<style scoped>

#map{
  min-height: 400px;
  width: 100%;
}

.container {
  padding-top: 10px;
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

.img{
  border-radius: 5px;
}

.points{
  margin-top: 20px;
}

.score{
  border: solid #363636 2px;
  border-radius: 10px;
  padding-left: 5px;
  margin-bottom: 32px;
}

.marker{
  margin-right: 10px;
}

</style>
