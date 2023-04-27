
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
import offres from './components/offres'
import dashboardAdmin from './components/adminDashboard'
import dashboardCondidat from './components/condidatDashboard'



const routes = [
    { path: '/Connexion',   name: 'Connexion',component: Connexion },
    { path: '/Register', name: 'Register',component: Register},
    { path: '/offres', name: 'offres' , component: offres},
    { path: '/admin/Dashboard', name: 'dashboardAdmin' ,component: dashboardAdmin},
    { path: '/condidat/Dashboard', name: 'dashboardCondidat' ,component: dashboardCondidat}
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

