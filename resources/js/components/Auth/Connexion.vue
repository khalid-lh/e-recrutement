<template>
<!--<div class="container" >

 <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Email address</label>
    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" v-model="user.email">
    <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Password</label>
    <input type="password" class="form-control" id="exampleInputPassword1" v-model="user.password"> 
  </div>
  <button class="btn btn-primary" @click="login">Connexion</button>
</div>-->

<div class="container mt-4">
  <div>
    <Popup :message="popupMessage" v-if="popupMessage" @close="clearError" />
  </div>
         <header>Login Form</header>
         
      
            <div class="input-field">
               <input type="email" required id="email" v-model="user.email">
               <label>Email </label>
            </div>
            
            <div class="input-field">
               <input class="pswrd" type="password" required v-model="user.password">
             
               <label>Password</label>
            </div> 
            <div class="button">
               <div class="inner"></div>
               <button @click="login">LOGIN</button>
            </div>
         <div class="signup">
            Not a member? <a href="/Register">Signup now</a>
         </div>
      </div>
</template>
<script>
import Popup from "../Other/alertError.vue";
export default{
  components: {
    Popup,
  },
  data(){
    return{
        user:{
            email:'',
            password:''
        },
        errors:{
            email:{},
            password:{},

        },
        popupMessage: ""
    }
  },
  methods:{
login(){
axios.post('/Connexion',this.user).then(response=>{
let user_type = response.data.user.user_type
let token = response.data.token;
if(response.data.message=='Authentication successful'){
  if(user_type=='condidat'){
    let timerInterval
Toast.fire({
  title: 'Chargement de votre tableau de board',
  timer: 2000,
  timerProgressBar: true,
  didOpen: () => {
    Toast.showLoading()
    const b = Swal.getHtmlContainer().querySelector('b')
    timerInterval = setInterval(()=>{
    b.textContent = Toast.getTimerLeft()
    }, 100)
  },
  willClose: () => {
    clearInterval(timerInterval)
  }
}).then((result) => {
  /* Read more about handling dismissals below */
  if(result.dismiss === Swal.DismissReason.timer){
    console.log('I was closed by the timer')
  }
})
window.location.href = '/condidat/dashboard';

localStorage.setItem('token',token)
  }else if(user_type=='recruteur'){
  
/*Toast.fire({
  title: 'Chargement de votre tableau de board',
  timer: 2000,
  timerProgressBar: true,
  didOpen: () => {
    Toast.showLoading();
    timerInterval = setInterval(() => {
      const b = Swal.getHtmlContainer()?.querySelector('b');
      if (b) {
        b.textContent = Toast.getTimerLeft();
      }
    }, 100);
  },
  willClose: () => {
    clearInterval(timerInterval)
  }
}).then((result) => {
  
  if(result.dismiss === Swal.DismissReason.timer) {
    console.log('I was closed by the timer')
  }
})*/
   window.location.href = '/recruteur/dashboard';
    localStorage.setItem('token',token)
  }else  if(user_type == 'admin'){
   window.location.href = '/admin/dashboard';
   localStorage.setItem('token',token)
  }
}

  
}).catch((error)=>{
  if ( error.response.status === 401) {
this.popupMessage = "Invalid Email ou Mot de Pass";
  }
 this.errors=error.response.data.errors
 this.checkErrors();        

})
},checkErrors() {
      
     
        for (let key in this.errors) {
        if (Object.keys(this.errors[key]).length > 0) {
          // Set the error message and display the popup
          this.popupMessage = Object.values(this.errors[key])[0];
          return;
        }
      }
      
      }, clearError() {
      this.popupMessage = "";
    }
  }
};
</script>

<style lang="css">
@import url('https://fonts.googleapis.com/css?family=Montserrat:600|Noto+Sans|Open+Sans:400,700&display=swap');
*{
  margin: 0;
  padding: 0;
  border-radius: 5px;
  box-sizing: border-box;
}
/*body{
  height: 100vh;
  display: flex;
  align-items: center;
  text-align: center;
  font-family: sans-serif;
  justify-content: center;
  background-size: cover;
  background-position: center;
}*/
.container{
  position: relative;
  width: 400px;
  background: white;
  padding: 60px 40px;
  box-shadow: 0 20px 15px 0 rgba(92, 148, 207, 0.1);
}
header{
  text-align: center;
  font-size: 40px;
  margin-bottom: 60px;
  font-family: 'Montserrat', sans-serif;
}
.input-field, form .button{
  margin: 25px 0;
  position: relative;
  height: 50px;
  width: 100%;
}
.input-field input{
  height: 100%;
  width: 100%;
  border: 1px solid silver;
  padding-left: 15px;
  outline: none;
  font-size: 19px;
  transition: .4s;
}
input:focus{
  border: 1px solid #1DA1F2;
}
.input-field label, span.show{
  position: absolute;
  top: 50%;
  transform: translateY(-50%);
}
.input-field label{
  left: 15px;
  pointer-events: none;
  color: grey;
  font-size: 18px;
  transition: .4s;
}
span.show{
  right: 20px;
  color: #111;
  font-size: 14px;
  font-weight: bold;
  cursor: pointer;
  user-select: none;
  visibility: hidden;
  font-family: 'Open Sans', sans-serif;
}
input:valid ~ span.show{
  visibility: visible;
}
input:focus ~ label,
input:valid ~ label{
  transform: translateY(-33px);
  background: white;
  font-size: 16px;
  color: #1DA1F2;
}
.button{
  margin-top: 30px;
  overflow: hidden;
  z-index: 111;
  position: relative;
}
.button .inner{
  position: absolute;
  height: 100%;
  width: 300%;
  left: -100%;
  z-index: -1;
  transition: all .4s;
  background: -webkit-linear-gradient(right,#00dbde,#fc00ff,#00dbde,#fc00ff);
}
.button:hover .inner{
  left: 0;
}
.button button{
  width: 100%;
  height: 100%;
  border: none;
  background: none;
  outline: none;
  color: white;
  font-size: 20px;
  cursor: pointer;
  font-family: 'Montserrat', sans-serif;
}
.container .auth{
  margin: 35px 0 20px 0;
  font-size: 19px;
  color: grey;
}
.links{
  display: flex;
  cursor: pointer;
}
.facebook, .google{
  height: 40px;
  width: 100%;
  border: 1px solid silver;
  border-radius: 3px;
  margin: 0 10px;
  transition: .4s;
}
.facebook:hover{
  border: 1px solid #4267B2;
}
.google:hover{
  border: 1px solid #dd4b39;
}
.facebook i, .facebook span{
  color: #4267B2;
}
.google i, .google span{
  color: #dd4b39;
}
.links i{
  font-size: 23px;
  line-height: 40px;
  margin-left: -90px;
}
.links span{
  position: absolute;
  font-size: 17px;
  font-weight: bold;
  padding-left: 8px;
  font-family: 'Open Sans', sans-serif;
}
.signup{
  margin-top: 50px;
  font-family: 'Noto Sans', sans-serif;
   text-align: center;
}
.signup a{
  color: #3498db;
  text-decoration: none;
}
.signup a:hover{
  text-decoration: underline;
}
</style>