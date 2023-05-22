<template>
<div class="content mt-3">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header" v-if="UsersTable=='users'">
                    <h4 class="card-title ">Condidats Postule a votre Offres</h4>
                </div>
                <div class="card-header" v-else-if="UsersTable=='offres'">
                    <h4 class="card-title ">Liste des Offres et les condidats postule</h4>
                </div>
                <div class="card-body">
                    <button class="btn btn-primary btn-sm" v-if="UsersTable == 'users'" style="float :right;" @click="UsersTable='offres'">
                        Retour
                    </button>
                    <table class="table table-striped walla table-hover" v-if="UsersTable == 'offres'">
                        <thead>
                            <tr>
                                <th>Titre</th>
                                <th>Type Offre</th>
                                <th>lien</th>
                                <th>Date creation</th>
                                <th>N° Condidats Postule</th>
                                <th>Liste Condidats</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="offre in Offrescondidatures" :key="offre.id_offre">
                                <td>{{ offre.titre_offre }}</td>
                                <td>{{ offre.type_offre }}</td>
                                <td><a :href="'/offre_emploi?key=' + offre.id_offre + '&slug=' + offre.slug">lien offre</a></td>
                                <td>{{ offre.created_at }}</td>
                                <td>{{ offre.postulers_count}}</td>
                                <td>
                                    <button class="btn btn-success btn-sm" @click="showUsersTable(offre.id_offre)">
                                        <i class="fa-sharp fa-solid fa-users"></i>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="table table-striped walla table-hover" v-else-if="UsersTable == 'users'">

                        <thead>
                            <tr>
                                <th>Nom</th>
                                <th>Email</th>
                                <th>Telephone</th>
                                <th>Ville</th>
                                <th>Cirriculum Vitae</th>
                            </tr>
                        </thead>
                        <tbody v-for="condidature in mescondidatures" :key="condidature.postule_id">
                            <tr v-for="user in condidature.users" :key="user.id">
                                <td>{{user.name}}</td>
                                <td>{{user.email}}</td>
                                <td>{{user.profil.telephone}}</td>
                                <td>{{user.profil.ville}}</td>
                                <td>
                                    <button class="btn btn-success btn-sm" @click="viewPdf(user.profil.cv)">
                                        View
                                    </button>
                                </td>
                            </tr>
                        </tbody>  
                    </table>
                    <div v-else style="display: block;">
                         <button class="btn btn-primary btn-sm mb-4" style="float :right;" @click=" UsersTable='users'">
                                Retour
                            </button>
                        <div style="display: flex; justify-content: center; align-items: center;" class="mt-2">    
                            <iframe :src="pdfUrl" width="700px" height="700px" frameborder="0"></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</template>

<script>
export default {
    name: 'mescondidats',
    data() {
        return {
            mescondidatures: {},
            Offrescondidatures: {},
            UsersTable: 'offres',
            selectedOffreId: null,
            selectedOffreCondidatures: {},
            pdfUrl: '',
        }
    },
    methods: {
        getoffres_condidats() {
            let token = localStorage.getItem('token')
            axios.get('/recruteur/Offrescondidatures', {  
                    headers: {
                        Authorization: `Bearer ${token}`
                    }
                })
                .then(response => {
                    this.Offrescondidatures = response.data.Offrescondidatures;
                })
                .catch((error) => {
                    console.error(error);  
                });
        },
        viewPdf(cv) {
            this.UsersTable = 'cv';
            this.pdfUrl = `/storage/pdfs/${cv}`;  
        },
  
        showUsersTable(id_offre) {
            this.selectedOffreId = id_offre;
            this.UsersTable = 'users';
            axios.get('/recruteur/mescondidaturs/' + id_offre, )
                .then(response => {
                    this.mescondidatures = response.data.mescondidatures;

                })
                .catch((error) => {
                    console.error(error);
                });
        }
    },
    created() {
        this.getoffres_condidats();
    }  
}
</script>

<style scoped>
table th,
td {
    text-align: center;
}

td {
    border-radius: 0px;
}

.table-hover tbody tr:hover {
    background-color: transparent !important;
}

.card-title {
    text-align: center;
}
</style>
