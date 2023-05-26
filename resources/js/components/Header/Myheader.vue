<template>
<div class="header_content">
  <div class="header ">
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a href="/" class="nav-link"><h2>FORSATI</h2></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item item">
            <a href="/liste_offres" class="nav-link">Listes Offres</a>
        </li>
        <li class="nav-item item">
          <a href="/login" class="nav-link">Se connecter</a>
        </li>
        
        <li class="nav-item">
          <a href="/Register" class="nav-link"><button class="btn btn-primary btn_condidat">S'inscrire</button></a>
        </li>
      </ul>
    </div>
  </nav>
</div>
</div>

</template>
<script>
export default {
  computed:{  
  },
  mounted(){
  },
};

</script>
<style scoped>


.header_content{
  box-shadow: 0 20px 15px 0 rgba(92, 148, 207, 0.1);
}
.header{
  margin-left: 15px;
  margin-right: 15px;
}
.item {
  padding: 10px;
  color: #1e1e1e;
  font-size: 15px;
  font-weight: 500;
  transition: all 0.35s ease-in-out;
}
.navbar-toggler:focus {
  outline: none !important;
  border: none;
  box-shadow: none !important;
}

.navbar-toggler{
  border-style: none;
}

.btn_condidat {
    width: 100px;
    height: 40px;
    font-size: 17px;
    outline: none;
    padding: 0;
    text-align: center;
    background-color: #b9c01a;
    display: flex;
    align-items: center;
    justify-content: center;
    text-decoration: none;
    color: #FFF;
    border: 1px solid transparent;
    border-radius: 4px;
    font-weight: 600;
    transition: all .35s ease-in-out;
    box-shadow: 0 20px 15px 0 rgba(92, 148, 207, 0.1);
}

h2{
  font-family: Georgia, 'Times New Roman', Times, serif;
  font-size: 30px;
  color: midnightblue;
}

</style>