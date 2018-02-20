<template>
  <div>
    <nav-bar></nav-bar>
    <section class="container">
      <div class="columns">
        <div class="column is-7" style="height: 500px;">
          <iframe autoplay="1" src="https://www.youtube.com/embed/yZLRrNFZN50?autoplay=0" style="width: 100%; height: 100%;" frameborder="0" allowfullscreen ></iframe>
        </div>
        <div class="column is-5">
          <img class="img" :src="img" v-show="photo">
          <div>
            <p class="is-size-5 has-text-weight-semibold has-text-centered is-capitalized">{{ aide }}</p>
          </div>
          <div class="is-size-3 has-text-centered has-text-weight-bold">
            <p class="is-uppercase">{{ ville }}</p>
          </div>
          <button class="btn button is-success" v-show="btn_val" @click="valider"><i class="marker fas fa-check-circle"></i>VALIDER</button>
          <button class="btn button is-info" v-show="btn_suiv" @click="suivant"><i class="marker fas fa-angle-double-right"></i>SUIVANT</button>
          <div class="points is-size-4 has-text-weight-semibold">
            <p class="score">Score : {{ score }}  ( +{{ newscore }} ! )</p>
          </div>
          <p class="is-size-4 has-text-weight-semibold"><i class="marker fas fa-hourglass-half"></i>{{ progress }}s</p>
          <progress class="progress is-success" :value="progress" :max="tempsMax">{{ progress }}</progress>
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
    }
  },
}
</script>

<style scoped>

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