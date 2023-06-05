<template>
<div >
   <div class="search">
        <div class="text">
            <h1>Trouvez votre opportunité du Travail en quelques minutes</h1>
        </div>
        <div class="center-content">
            <input type="text" v-model="metier" name="metier" placeholder="Metier">
            <select class="form-select" name="ville" v-model="ville" >
                <option value="">Ville</option>
                <option value="Agadir">Agadir</option>
                <option value="Casablanca">Casablanca</option>
                <option value="Fez">Fez</option>
                <option value="Marrakech">Marrakech</option>
                <option value="Rabat">Rabat</option>
                <option value="Tangier">Tangier</option>
            </select>
            <select class="form-select" name="categorie">
                <option value="">categorie</option>
                <option value="Agadir">Agadir</option>
                <option value="Casablanca">Casablanca</option>
                <option value="Fez">Fez</option>
                <option value="Marrakech">Marrakech</option>
                <option value="Rabat">Rabat</option>
                <option value="Tangier">Tangier</option>
            </select>
            <a :href="getSearchUrl()" ><button class="btn btn-primary btn_condidat">Rechercher</button></a>
        </div>
    </div>
</div>
</template>

<script>
export default {
    data() {
        return{
            metier: '',
            ville: ''
        };
    },
    methods :{
getSearchUrl() {
          return `/rechercher/offres?metier=${encodeURIComponent(this.metier)}&ville=${encodeURIComponent(this.ville)}`;

    }
    },
}
</script>

<style scoped>
.search {
    display: flex;
    justify-content: center;
    flex-direction: column;
    align-items: center;
    height: 80vh;
    background-image: url('/images/recrutement.jpg');
    background-repeat: no-repeat;
    background-size: cover;
    background-position: center;
}

.center-content {
    text-align: center;
    display: flex;
    align-items: center;
    max-width: 800px;
    /* Adjust the max-width as per your preference */
    margin: 0 auto;
}

.btn_condidat {
    width: 100%;
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

.center-content input,
.center-content button,
.search select {
    width: 200px;
    padding: 10px;
    margin-bottom: 10px;
    margin-right: 10px;
}

.text {
    color: #FFF;
    text-align: center;
    box-shadow: 10px;
    margin-top: -200px;
    margin-bottom: 100px;
}

.search select:focus,
input:focus {
    outline: none !important;
    border: none;
    box-shadow: none !important;

}

.search select option:hover {
    background-color: transparent !important;
}

h1{
    text-align: center;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    font-size: 50px;
    margin: 0px 50px 0px 50px;
}
a{
    text-decoration: none;
    text-decoration-style: none;
    color: #FFF;
}

@media (max-width: 600px) {
    .center-content input,
    .center-content select {
        width: auto;
        /* Reset width to auto for smaller screens */
    }

    .center-content button {
        width: auto;
    }

    .center-content {
        text-align: center;
        display: flex;
        flex-direction: column;
        align-items: center;
        max-width: 400px;
        margin: 0 auto;
    }

    .center-content input,
    .center-content button,
    .search select {
        width: 200px;
        padding: 10px;
        margin-bottom: 10px;
        margin-right: 10px;
    }

    .text{
        color: #FFF;
        text-align: center;
        box-shadow: 10px;
        margin-top: -50px;
        margin-bottom: 100px;
    }
h1{
    font-size: 30px;
}
    .search select option:hover {
        background-color: transparent !important;
    }
}
</style>
