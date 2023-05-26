<template>
<div class="dashboard">
    <div class="content mt-3">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title ">Liste des offres ajouté</h4>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="typeSelect">Lister les offres de : </label>
                                <select id="typeSelect" v-model="selectedType">
                                    <option value="Stage">Stage</option>
                                    <option value="Emploi">Emploi</option>
                                </select>
                            </div>

                            <table class="table table-striped walla table-hover">
                                <thead>
                                    <tr>
                                        <th>Titre</th>
                                        <th>N° Postes</th>
                                        <th>Precense</th>
                                        <th>Date Creation</th>
                                        <th>lien Offre</th>
                                        <th>Status</th>
                                        <th v-if="selectedType === 'Stage'">Duree</th>
                                        <th v-if="selectedType === 'Stage'">Convension</th>
                                        <th v-if="selectedType === 'Emploi'">Annee_Experience</th>
                                       
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="offre in filteredOffres" :key="offre.id_offre">
                                        <td>{{ offre.titre_offre }}</td>
                                        <td>{{ offre.n_postes }}</td>
                                        <td>{{ offre.presence}}</td>
                                        <td>{{ calculateTimeDifference(offre.created_at)}}</td>
                                        <td><a :href="'/offre_emploi?key=' + offre.id_offre + '&slug=' +offre.slug">lien offre</a></td>
                                        <td v-if=" offre.deleted_at" > <p id="status_draft"> Draft</p> </td>
                                        <td v-else > <p id="status_live">Live</p></td>
                                        <td v-if="selectedType === 'Stage'">{{ offre.duree }}</td>
                                        <td v-if="selectedType === 'Stage'">{{ offre.convension }}</td>
                                        <td v-if="selectedType === 'Emploi'">A partir {{ offre.annee_experience }} ans </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
  
    
</div>
</template>

<script>
import '@fortawesome/fontawesome-free/css/all.css';
import moment from 'moment';
export default{
    name: 'Dashboard',
    data(){
        return {
        allOffers: {},
          selectedType: 'Stage', // Default selected type
            offre: {},
        }
    },
    methods:{
        getallOffers(){
            axios.get('/admin/getallOffers')
                .then(response => {
                    this.allOffers = response.data.allOffers;
                })
                .catch((error) => {
                    console.error(error);  
                });
        },
    calculateTimeDifference(dateTime) {
      const start = moment(dateTime);
      const now = moment();
      return start.from(now);
    },
          
    },
   computed: {
        filteredOffres(){
            // Filter products based on the selected type
            if (Array.isArray(this.allOffers)) {
                if (this.selectedType === 'Stage') {

                    return this.allOffers.filter((offre) => offre.type_offre === 'Stage');
                } else if (this.selectedType === 'Emploi') {
                    return this.allOffers.filter((offre) => offre.type_offre === 'Emploi');
                }
                return true;
            }
            return [];
        },
    },
    created(){   
        this.getallOffers();
    }
};
</script>

<style scoped>
.modal-backdrop {
    display: none !important;
}

table th,
td {
    text-align: center;
}

.card-title {
    text-align: center;
}

.dashboard {
    margin: 10px 10px 10px 10px;
}

td {
    border-radius: 0px;
}

.cards {
    padding: 20px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    background-color: #fff;
    border-radius: 10px;
    box-shadow: 0 7px 25px rgba(0, 0, 0, 0.08);
}

.table-hover tbody tr:hover {
    background-color: transparent !important;
}

.number {
    font-size: 35px;
    font-weight: 500;
    color: #299B63;
}

.card-name {
    color: #888;

}

.icon-box i {
    font-size: 45px;
    color: #299b63;
}
#status_live{
    background-color: deepskyblue;
    border-radius: 10px;

}
#status_draft{
    background-color: red;
    border-radius: 10px;

}
p{
    color: #fff;
font-size: 15px;
text-decoration-style: solid;
}
</style>
