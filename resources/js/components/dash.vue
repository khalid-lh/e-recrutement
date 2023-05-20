<template>
<div class="dashboard">
    <div class="row ">
        <div class="col-lg-4 col-sm-12 col-md-6">
            <div class="cards">
                <div class="card-content">
                    <div class="number">
                        {{StageCount}}
                    </div>
                    <div class="card-name">Nombre des Stages</div>
                </div>
                <div class="icon-box">
                    <i class="fas fa-briefcase"></i>

                </div>
            </div>
        </div>
        <div class="col-lg-4 col-sm-12 col-md-6">
            <div class="cards">
                <div class="card-content">
                    <div class="number"> {{EmploiCount}}</div>
                    <div class="card-name">Nombre des Emplois</div>
                </div>
                <div class="icon-box">
                    <i class="fas fa-briefcase"></i>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-sm-12 col-md-6">
            <div class="cards">
                <div class="card-content">
                    <div class="number">1217</div>
                    <div class="card-name">Students</div>
                </div>
                <div class="icon-box">
                    <i class="fas fa-user-graduate"></i>
                </div>
            </div>
        </div>
    </div>
    <div>
        <!-- 19880/OP1/23 -->
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
                                        <th v-if="selectedType === 'Stage'">Duree</th>
                                        <th v-if="selectedType === 'Stage'">Convension</th>
                                        <th v-if="selectedType === 'Emploi'">Annee_Experience</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="offre in filteredOffres" :key="offre.id_offre">
                                        <td>{{ offre.titre_offre }}</td>
                                        <td>{{ offre.n_postes }}</td>
                                        <td>{{ offre.presence}}</td>
                                        <td v-if="selectedType === 'Stage'">{{ offre.duree }}</td>
                                        <td v-if="selectedType === 'Stage'">{{ offre.convension }}</td>
                                        <td v-if="selectedType === 'Emploi'">{{ offre.annee_experience }} ans </td>
                                        <td>
                                            <button class="btn btn-success btn-sm" @click="showAlert(offre)"><i class="fa fa-edit"></i></button>
                                            <button class="btn btn-danger btn-sm" @click="deleteOffre(offre.id_offre)"><i class="fa fa-trash"></i></button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Alert for modifing offre-->
    <div class="modal fade show" id="myModal" ref="myModal" tabindex="1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="text-center w-100">
                        <h5 class="modal-title" id="exampleModalLabel">Modifier Offre</h5>
                    </div>
                    <button type="button" class="close" data-dismiss="modal" id="closebutton" aria-label="Close" @click="closeAlert">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                   <div class="input-field">
                    <input type="text" required id="titre_offre" name="titre_offre" v-model="selectedOffre.titre_offre">
                    <label>Titre</label>
                </div>
                <div class="input-field">
                    <input type="number" required  v-model="selectedOffre.n_postes">
                    <label>N° Postes</label>
                </div>
                <div v-if="selectedType=='Stage'">
                    <h6 id="title_component">Duree</h6>
                    <select class="form-select form-select-sm mb-4" id="duree" name="duree" aria-label=".form-select-sm example" v-model="selectedOffre.duree">
                        <option value="1 moi">1 moi</option>
                        <option value="2 moi">2 moi</option>
                        <option value="3 moi">3 moi</option>
                        <option value="4 moi">4 moi</option>
                        <option value="5 moi">5 moi</option>
                        <option value="6 moi">6 moi</option>
                    </select>
                    <h6 id="title_component">Convention</h6>
                    <select class="form-select form-select-sm mb-4" id="convension" name="convension" aria-label=".form-select-sm example" v-model="selectedOffre.convension">
                        <option value="oui">oui</option>
                        <option value="non">Non</option>
                    </select>
                </div>
                    <div v-if="selectedType ==  'Emploi'">
                <h6 id="title_component">Annee Experience</h6>
                   <div class="input-field">
                    <input type="number" required name="annee_experience" v-model="selectedOffre.annee_experience">
                    <label>Experience</label>
                </div>
                </div>
                 <div>
                    <textarea class="form-control mb-4" id="description" name="description" placeholder="Description de votre offre" v-model="selectedOffre.description" ></textarea>
                </div>
                <h6 id="title_component">Presence</h6>
                <select class="form-select form-select-sm mb-4" id="presence" name="presence" aria-label=".form-select-sm example" v-model="selectedOffre.presence">
                    <option value="Distanciel">Distanciel</option>
                    <option value="Presence">Presence</option>
                </select>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" @click="closeAlert">Cancel</button>
                    <button type="button" class="btn btn-primary" @click="modifyOffer">Modifier</button>
                </div>
                
            </div>
        </div>
    </div>
</div>
</template>

<script>
import '@fortawesome/fontawesome-free/css/all.css';

export default{
    name: 'Dashboard',
    data() {
        return {
            selectedOffre: {},
           
            showModal: false,
            StageCount: null,
            EmploiCount: null,
            selectedType: 'Stage', // Default selected type
            offres: {},
            offre: {},
        }
    },
    methods: {
        
        closeAlert() {
            $('#myModal').modal('hide');
        },
        statistiques() {
            let token = localStorage.getItem('token');
            axios.get('/recruteur/dashboard/statistiques', {
                    headers: {
                        Authorization: `Bearer ${token}`
                    }
                })
                .then(response => {
                    this.StageCount = response.data.StageCount;
                    this.EmploiCount = response.data.EmploiCount;
                    if(this.offresCount == null){
                        this.offresCount = 0;
                    }
                    if (this.EmploiCount == null) {
                        this.EmploiCount = 0;
                    }
                })
                .catch(error=>{
                    console.log(error);
                });
        },
        showAlert(offre) {
            this.selectedOffre = Object.assign({}, offre);
            $('#myModal').modal('show');
            var backdrop = document.querySelector('.modal-backdrop');

            // Update the class to remove 'fade'
            backdrop.classList.remove('fade');
            backdrop.classList.remove('modal-backdrop');
            backdrop.classList.add('show');
        },
        fetchOffres() {
            let token = localStorage.getItem('token')
            axios.get('/recruteur/dashbaord/getoffres', {
                    headers: {
                        Authorization: `Bearer ${token}`
                    }
                })
                .then((response) => {
                    this.offres = response.data.offres;
                    
                })
                .catch((error) => {
                    console.error(error);
                });
        },
        deleteOffre(id){
            axios.delete(`/recruteur/dashboard/deleteoffre/${id}`)
                .then(res => {
                    this.fetchOffres();
                })
                .catch(error => console.log(error.response))
        },
        modifyOffer(){
    const url = `/recruteur/dashboard/modifyoffre/${this.selectedOffre.id_offre}`;
    const data = this.selectedOffre;

    axios.put(url, data)
      .then(response => {
        if(response.data.message_succes == 'Offer updated successfully'){
 this.closeAlert();
        this.selectedOffre={};
        this.fetchOffres();
        }
      })
      .catch(error => {
        // Handle the error
        console.error('Error modifying offer:', error);
        
      });
  },
    },
    computed: {
        filteredOffres() {
            // Filter products based on the selected type
            if (Array.isArray(this.offres)) {
                if (this.selectedType === 'Stage') {

                    return this.offres.filter((offre) => offre.type_offre === 'Stage');
                } else if (this.selectedType === 'Emploi') {
                    return this.offres.filter((offre) => offre.type_offre === 'Emploi');
                }
                // Return all products if no specific type is selected
                return true;
            }
            return [];
        },
    },
    created(){   
        this.statistiques();
        this.fetchOffres();
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
</style>
