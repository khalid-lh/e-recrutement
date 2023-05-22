
require('./bootstrap');

window.Vue = require('vue').default;
import VueRouter from "vue-router"
Vue.use(VueRouter)
import Swal from "sweetalert2";
window.Swal=Swal
const Toast =Swal.mixin({

  toast:true,
  position:'center',
  showConfirmationButton:false,
  timer:2000,
  timerProgressBar:true,
  didOpen:(popup)=> {
    toast.addEventListener('mouseenter',Swal.stopTimer)
    toast.addEventListener('mouseleave',Swal,resumeTimer())
  }
})
window.Toast=Toast
import axios from 'axios';

import Myheader from './components/Myheader'
import Connexion from './components/Connexion'
import Register from './components/Register'
import home_offres from './components/Home_offres'
import search from './components/search.vue'
//recruteur
import dashboard from './components/dash'
import profilRecruteur from './components/profilRecruteur'
import addoffre from './components/addoffre'
import mescondidats from './components/mescondidatures.vue'
//userCondidat
import profilCondidature from './components/condidature/profilcondidature'
import dashboard_condidature from './components/condidature/dash'

const routes = [
    { path: '/Connexion', name: 'Connexion',component: Connexion },
    { path: '/Register', name: 'Register',component: Register},
    { path: '/recruteur/dashboard', name: 'recruteur_dashboard' ,component: dashboard},
    { path: '/recruteur/profil', name: 'profil_recruteur' ,component: profilRecruteur},
    { path: '/recruteur/addoffre', name: 'addoffre' , component: addoffre},
    { path: '/recruteur/mescondidatures', name: 'mescondidats' , component: mescondidats},
    { path: '/condidat/dashboard', name: 'condidature_dashboard' ,component: dashboard_condidature},
    { path: '/condidat/profil', name: 'profil_condidature' ,component: profilCondidature},

  ]
  
  const router = new VueRouter({
    mode:'history',
    routes
  })

export default router
const header = new Vue({
    el: '#header',
router,
    components: {
        Myheader,  
    }
});
const login = new Vue({
  el: '#login',
router,
  components: {
    Connexion,  
  }
});
const register = new Vue({
  el: '#register',
router,
  components: {
      Register,
  }
});
const search_vue = new Vue({
  el: '#search',
router,
  components: {
      search,
  }
});
const Home_offres= new Vue({
  el: '#home_offres',
router,
  components:{
    home_offres,
  }
});
const recruteur = new Vue({
  el: '#app',
  router,
  components: {
      dashboard,
      profilRecruteur,
      addoffre,
      mescondidats
  }
});

const condidature = new Vue({
  el: '#condidat_dashboard',
  router,
  components: {
    dashboard_condidature,
    profilCondidature
  }
});

