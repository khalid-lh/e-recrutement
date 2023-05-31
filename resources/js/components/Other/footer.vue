<template>
<div class="footer">
<div class="footer-content">
  <div class="row">
    <div class="col">
 <div class="logo">
      <h1 >FORSAJOB</h1>
      <p id="app_desc">FORSAJOB : Votre plateforme d'emploi au Maroc. Publiez et découvrez des offres d'emploi dans tout le pays. Connectez talents et employeurs.</p>
    </div>
    </div>
    <div class="col">
      <div class="list_additionnal">
    <ul>
        <li>À PROPOS</li>
        <li>CONDITIONS D'UTILISATION</li>
        <li>QUI SOMMES-NOUS?</li>
      </ul>
    </div>
    </div>
    <div class="col">
      <div class="footer-lists">
      <div>
        <h5 >Les offres d'emplois par ville</h5>
      </div>
      <div class="footer-lists-ville">
      <ul>
        <li><a class="nav-link" href="/rechercher/offres?metier=&ville=Casablanca">Casablanca</a></li>
        <li><a class="nav-link" href="/rechercher/offres?metier=&ville=Marrakech">Marrakech</a></li>
        <li><a class="nav-link" href="/rechercher/offres?metier=&ville=Fes">Fes</a></li>
        <li><a class="nav-link" href="/rechercher/offres?metier=&ville=Tangier">Tangier</a></li>
        <li><a class="nav-link" href="/rechercher/offres?metier=&ville=Rabat">Rabat</a></li>
      </ul>
      <ul>
        <li><a class="nav-link" href="/rechercher/offres?metier=&ville=Meknes">Meknes</a></li>
        <li><a class="nav-link" href="/rechercher/offres?metier=&ville=Agadir">Agadir</a></li>
        <li><a class="nav-link" href="/rechercher/offres?metier=&ville=Oujda">Oujda</a></li>
        <li><a class="nav-link" href="/rechercher/offres?metier=&ville=Kenitra">Kenitra</a></li>
        <li><a class="nav-link" href="/rechercher/offres?metier=&ville=Tetouan">Tetouan</a></li>
       
      </ul>
      </div>
    </div>
    </div>
  </div>
   
    
    
  </div>
  <div class="footer-bottom">
    <p>&copy; 2023 La Maison du Software. All rights reserved.</p>
  </div>
</div>
</template>
<script>
export default {
  name: 'footer'
};
</script>
<style scoped>
.footer {
  background-color: rgb(20, 108, 148);
  padding: 20px;
  height: 100%;
  left: 0;
  bottom: 0;
  width: 100%;
  margin-top: 35px;
}

.footer-content {
  display: flex;
  justify-content: space-between;
  align-items: center;
  
}

h1 ,h5{
color:azure;
font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
font-size: 30px;
}
h5{
color:azure;
font-size: 20px;
}
.logo {
margin-top: 20px;
}

.logo p {
font-size: 16px;

}

.footer-lists ul {
margin-top: 20px;
list-style: none;
margin: 0;
padding: 0;
}

.list_additionnal ul li {
color: rgb(223, 222, 212);
}

.list_additionnal ul {
list-style: none;
margin: 0;
padding: 0;
margin-top: 20px;
}

.footer-lists {
display: block;
color: aliceblue;
margin-top: 20px;
}

.footer-lists ul li {
margin-bottom: 8px;
margin-right: 50px;
color: rgb(223, 222, 212);
}

.footer-bottom {
text-align: center;
font-size: 14px;
margin-top: 30px;

color: azure;
}

.footer-lists-ville {
display: flex;
flex-wrap: wrap;
justify-content: flex-start;
}

.footer-lists-ville ul {
list-style: none;
margin: 0;
padding: 0;
}


#app_desc{
  color: rgb(223, 222, 212);
}
.footer-lists-ville ul li {
margin-bottom: 8px;
margin-right: 20px;
color: rgb(223, 222, 212);
}

@media (max-width: 768px) {
.footer-content {
flex-wrap: wrap;
justify-content: center;
}

.logo {
text-align: center;
margin-bottom: 20px;
}

.list_additionnal {
text-align: center;
margin-bottom: 20px;
}

.footer-lists {
text-align: center;
margin-top: 0;
}

.footer-lists-ville {
justify-content: center;
}
}
</style>