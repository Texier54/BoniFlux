import Vue from 'vue'
import App from './App'
import router from './router'
import store from './store.js'
import axios from 'axios'
import Vue2Leaflet from 'vue2-leaflet';

Vue.component('v-map', Vue2Leaflet.Map);
Vue.component('v-tilelayer', Vue2Leaflet.TileLayer);
Vue.component('v-marker', Vue2Leaflet.Marker);


window.axios = axios.create({
  baseURL: 'http://api.geoquizz.local:10080/',
});


Vue.config.productionTip = false

store.subscribe((mutation, state) => {
	localStorage.setItem('store', JSON.stringify(state));
});

window.bus = new Vue();

new Vue({
  el: '#app',
  router,
  store,
  beforeCreate() {
  	this.$store.commit('initialiseStore');
  },
  template: '<App/>',
  components: { App }
})


