
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

import Myheader from './components/Header/Myheader'
import Connexion from './components/Auth/Connexion'
import Register from './components/Auth/Register'
import home_offres from './components/Other/Home_offres'
import search from './components/Other/search.vue'
//recruteur
import dashboard from './components/Recruteur/dash'
import profilRecruteur from './components//Recruteur/profilRecruteur'
import addoffre from './components//Recruteur/addoffre'
import mescondidats from './components//Recruteur/mescondidatures.vue'
import deletedOffres from './components//Recruteur/deleted_offre.vue'
//userCondidat
import profilCondidature from './components/condidature/profilcondidature'
import dashboard_condidature from './components/condidature/dash'
import  mesEnregistrement from './components/condidature/mesenregistrement'
//Admin
import dashboard_admin from './components/admin/dash'
import allOffers from './components/admin/allOffers'
import allcompanies from './components/admin/listcompanies'
import addpost from './components/admin/addPost'
import postsdeletd from './components/admin/brouillant'
const routes = [
    { path: '/Connexion', name: 'Connexion',component: Connexion },
    { path: '/Register', name: 'Register',component: Register },
    { path: '/recruteur/dashboard', name: 'recruteur_dashboard' , component: dashboard},
    { path: '/recruteur/profil', name: 'profil_recruteur' , component: profilRecruteur},
    { path: '/recruteur/addoffre', name: 'addoffre' , component: addoffre},
    { path: '/recruteur/mescondidatures', name: 'mescondidats' , component: mescondidats},
    { path: '/recruteur/deletedOffres', name: 'mesoffresdeleted' , component: deletedOffres},
    { path: '/condidat/dashboard', name: 'condidature_dashboard' , component: dashboard_condidature},
    { path: '/condidat/profil', name: 'profil_condidature' , component: profilCondidature},
    { path: '/condidat/mesenregistrement ', name: 'mesenregistrement' , component: mesEnregistrement},
    { path: '/admin/dashboard', name: 'admin_dashboard' , component: dashboard_admin},
    { path: '/admin/alloffers', name: 'allOffers' , component: allOffers},
    { path: '/admin/allCompanies', name: 'allcompanies' , component: allcompanies},
    { path: '/admin/addPost', name: 'addpost' , component: addpost},
    { path: '/admin/Brouillant', name: 'postsdeleted' , component: postsdeletd},

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
      mescondidats,
      deletedOffres
  }
});

const condidature = new Vue({
  el: '#condidat_dashboard',
  router,
  components: {
    dashboard_condidature,
    profilCondidature,
    mesEnregistrement
  }
});

const admin = new Vue({
  el: '#admin_dashboard',
  router,
  components: {
    dashboard_admin,
    allOffers,
    allcompanies,
    addpost,
    postsdeletd
  }
});