import Vue from 'vue'
import Router from 'vue-router'
import accueil from '@/components/accueil.vue'
import emission from '@/components/emission.vue'
import diffusion from '@/components/diffusion.vue'
import abonnements from '@/components/abonnements.vue'
import record from '@/components/record.vue'
import streams from '@/components/streams.vue'

Vue.use(Router)

export default new Router({
  routes: [
    {
      path: '/',
      component: accueil,
      name: 'accueil',
    },
    { path: '/emission', name: 'emission', component: emission},
    { path: '/diffusion/:id', name: 'diffusion', component: diffusion},
    { path: '/abonnements', name: 'abonnements', component: abonnements},
    { path: '/record', name: 'record', component: record},
    { path: '/streams', name: 'streams', component: streams},
    { path: '*', component: accueil}
  ]
})
