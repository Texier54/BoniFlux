import Vue from 'vue'
import Router from 'vue-router'
import lancerPartie from '@/components/lancerPartie'
import partie from '@/components/partie'

Vue.use(Router)

export default new Router({
  routes: [
    {
      path: '/',
      component: lancerPartie,
      name: 'lancerPartie',
    },
    {
      path: '/partie',
      component: partie,
      name: 'partie',
    },
    { path: '*', component: lancerPartie}
  ]
})
