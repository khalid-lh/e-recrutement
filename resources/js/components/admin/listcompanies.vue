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
                                    <th>Ville</th>
                                    <th>Telephone</th>
                                    <th>Description</th>
                                    <th>Nom Recruteur</th>
                                    <th>Register Commerce</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="companie in  allcompanies" :key="companie.company_id">
                                    <td><img :src="`/storage/images/${companie.photo}`" alt="Image" class="circle-image " /></td>
                                    <td>{{ companie.company_name}}</td>
                                    <td>{{ companie.ville}}</td>
                                    <td>{{ companie.telephone}}</td>
                                    <td>{{ companie.description}}</td>
                                    <td>{{ companie.recruteur.name}}</td>
                                    <td><button class="btn btn-success" @click="viewrc(companie.register_commerce)">view</button></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div v-else style="display: block;">
                <button class="btn btn-primary btn-sm mb-4" style="float :right;" @click="rc=false">
                    Retour
                </button>
                <div style="display: flex; justify-content: center; align-items: center;" class="mt-2">
                    <iframe :src="rcUrl" width="700px" height="700px" frameborder="0"></iframe>
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
        viewrc(rc) {
            this.rc = true;
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
</style>
