<template>
<div class="header_content">
  <div class="header ">
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a href="/" class="nav-link"><h2>FORSAJOB</h2></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item item">
          <a :href="publicationRoute()" class="nav-link">Articls</a>
        </li>
      </ul>
      <ul class="navbar-nav">
      <div class="dropdown ">
              <span>Categories</span>
              <div class="dropdown-content categories">
                 <li class="nav-item item" v-for="categorie in  categories" :key="categorie.id" :value="categorie.id_categorie">
                <a  :href="offresbycategorie(categorie.id_categorie)" class="dropdown-item">{{ categorie.name_categorie}}</a>
              </li>
              </div>
      </div>
      </ul>
     <ul v-if="isAuthenticated" class="navbar-nav ml-2">
            <div class="dropdown">
              <span>Dashboard</span>
              <div class="dropdown-content">
                <li class="nav-item item">
                <a :href="getDashboardLink()" class="dropdown-item">Dashboard</a>
                </li>
                <li class="nav-item item">
                 <button class="deconnecter" @click="logout">Deconnecter</button>
                </li>
              </div>
            </div>
          </ul>
          
        <ul v-else class="navbar-nav">
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
  data() {
    return {
      isAuthenticated: false,
      userType: "",
      categories:null,
    };
  },
  mounted() {
    this.isAuthenticated = this.checkAuthentication();
    if (this.isAuthenticated) {
      this.getUserTypeFromDatabase();
    }
  },
  methods: {
    checkAuthentication() {
      const token = localStorage.getItem("token");
      return !!token; // Check if token exists in localStorage
    },
    getallcategories() {
            axios.get('/getallcategories')
                .then(response => {
                    this.categories = response.data.categories;
                })
                .catch((error) => {
                    console.error(error);
                });
        },
    getUserTypeFromDatabase() {
      const token = localStorage.getItem("token");
      axios
        .get("/getUserType", {
          headers: {
            Authorization: `Bearer ${token}`,
          },
        })
        .then((response) => {
          this.userType = response.data.userType;
        })
        .catch((error) => {
          // Handle error
          console.log(error);
        });
    },
    getDashboardLink() {
      switch (this.userType) {
        case "recruteur":
          return "/recruteur/dashboard";
        case "condidat":
          return "/candidat/dashboard";
        case "admin":
          return "/admin/dashboard";
        default:
          return "";
      }
    },
    publicationRoute() {
    return `/publications`;
  },
  offresbycategorie(categorie) {
    return `/offres_emploi?categorie=${encodeURIComponent(categorie)}`;
  },
    logout() {
      localStorage.removeItem("token");
      this.isAuthenticated = false;
    },
  },
  created(){   
        this.getallcategories();
    }
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
    border-radius: 10px;
    font-weight: 600;
    transition: all .35s ease-in-out;
    box-shadow: 0 20px 15px 0 rgba(92, 148, 207, 0.1);
}

h2{
  font-family: Georgia, 'Times New Roman', Times, serif;
  font-size: 30px;
  color: midnightblue;
}

.dropdown {
  position: relative;
  display: inline-block;
}

.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f9f9f9;
  min-width: 100px;
  margin-left: -100px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  padding: 12px 16px;
  z-index: 1;
}
.categories li:hover{
 background-color: #b9c01a;
 color: #FFF;
 font-size: 17px;
}
.categories li{
  font-size: 17px;
}
.dropdown:hover .dropdown-content {
  display: block;
  }
  @media (max-width: 980px){
 .dropdown-content{
  margin-left: 0px;
}
}
.deconnecter{
  text-decoration: none;
  background-color:#f9f9f9 ;
  border: #f9f9f9;
}
</style>