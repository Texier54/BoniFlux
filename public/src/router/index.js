import Vue from 'vue'
import Router from 'vue-router'
import accueil from '@/components/accueil.vue'

Vue.use(Router)

export default new Router({
  routes: [
    {
      path: '/',
      component: accueil,
      name: 'accueil',
    },
    { path: '*', component: accueil}
  ]
})
