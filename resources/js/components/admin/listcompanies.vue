<template>
<div class="dashboard">
    <div class="content mt-3">
        <div class="row">
            <div class="col-sm-12" v-if="this.rc==false">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title ">Tous les societes</h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped walla table-hover">
                            <thead>
                                <tr>
                                    <th>image</th>
                                    <th>Nom</th>
                                    <th>Num RC</th>
                                    <th>Telephone</th>
                                    <th>Description</th>
                                    <th>Nom Recruteur</th>
                                    <th>Status</th>
                                    <th>Detail</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="companie in  allcompanies" :key="companie.company_id">
                                    <td><img :src="`/storage/images/${companie.photo}`" alt="Image" class="circle-image " /></td>
                                    <td>{{ companie.company_name}}</td>
                                    <td>{{ companie.num_rc}}</td>
                                    <td>{{ companie.telephone}}</td>
                                    <td>{{ companie.description}}</td>
                                    <td>{{ companie.recruteur.name}}</td>
                                    <td v-if=" companie.status=='Unverified'">
                                        <p id="status_draft">Unverified </p>
                                    </td>
                                    <td v-else>
                                        <p id="status_live">Verified</p>
                                    </td>
                                    <td><button class="btn btn-success" @click="viewrc(companie,companie.register_commerce)">view</button></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div v-else style="display=block;">

                <button class="btn btn-primary btn-sm mb-4" style="float :right;" @click="rc=false">
                    Retour
                </button>

                <div class="row mt-4">
                    <div class="col-sm-12 col-lg-4 col-md-4">
                        <h4 class="mb-4">Informations de la société</h4>
                        <div class="detail">
                            <h6>Nom Société : </h6>
                            <p>{{ selectedcompanie.company_name}}</p>
                        </div>
                        <div class="detail">
                            <h6>Numero Register Commerce : </h6>
                            <p>{{ selectedcompanie.num_rc}}</p>
                        </div>
                        <div class="detail">
                            <h6>Telephone : </h6>
                            <p>{{ selectedcompanie.telephone}}</p>
                        </div>
                        <div class="detail">
                            <h6>Ville : </h6>
                            <p>{{ selectedcompanie.ville}}</p>
                        </div>
                        <div class="detail">
                            <h6>Description : </h6>
                            <p>{{ selectedcompanie.description}}</p>
                        </div>
                        <h4>Informations de recruteur</h4>
                        <div class="detail">
                            <h6>Email : </h6>
                            <p>{{ selectedcompanie.recruteur.email}}</p>
                        </div>
                        <div class="detail">
                            <h6>Nom : </h6>
                            <p>{{ selectedcompanie.recruteur.name}}</p>
                        </div>
                        <button class="btn btn-success" @click="valider(selectedcompanie.company_id)">valider</button>
                    </div>
                    <div class="col-sm-12 col-lg-8 col-md-4">
                        <div style=" display=flex; justify-content: center; align-items: center;" class="mt-2">
                            <iframe :src="rcUrl" width="700px" height="700px" frameborder="0"></iframe>
                        </div>
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
export default {
    name: 'Dashboard',
    data() {
        return {
            allcompanies: {},
            selectedcompanie: null,
            rc: false,
            rcUrl: ''
        }
    },
    methods: {
        getallcompanies() {
            axios.get('/admin/getallcompanies')
                .then(response => {
                    this.allcompanies = response.data.allcompanies;
                })
                .catch((error) => {
                    console.error(error);
                });
        },
        valider(id) {
            axios.post(`/admin/allcompanies/validercompany/${id}`)
                .then(response => {
                    if (response.data.message == 'societe verified') {
                        Toast.fire({
                            icon: 'success',
                            title: 'Société Verifier Maintenant'
                        })
this.getallcompanies();
                    }
                })
                .catch((error) => {
                    console.error(error);
                });
        },
        viewrc(company, rc) {
            this.rc = true;
            this.selectedcompanie = company;
            console.log(this.selectedcompanie);
            this.rcUrl = `/storage/pdfs/${rc}`;
        },

        calculateTimeDifference(dateTime) {
            const start = moment(dateTime);
            const now = moment();
            return start.from(now);
        },

    },
    computed: {

    },
    created() {
        this.getallcompanies();
    }
};
</script>

<style scoped>
.circle-image {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    overflow: hidden;
    justify-content: center;
}

.circle-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

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

.detail {
    display: flex;
    margin-bottom: 10px;
}

h4 {
    font-size: 20px;
    color: #000;
    font-weight: 600;

}

h6 {
    font-size: 15px;
    color: #000;
    font-weight: 600;
    color: cadetblue;
    margin-top: 5px;
    margin-right: 10px;
}

#status_live {
    background-color: mediumseagreen;
    border-radius: 10px;

}

#status_draft {
    background-color: deepskyblue;
    border-radius: 10px;

}

#status_draft,#status_live,
p {
    color: #fff;
    font-size: 15px;
    
    text-decoration-style: dashed;
}

p {
    color: #000;
    font-size: 15px;
    margin-top: 2px;
    text-decoration-style: dashed;
}
</style>
