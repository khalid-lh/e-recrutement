<template>
<div class="content mt-3">
    <div class="row tableau">
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
                                <td>{{ calculateTimeDifference(offre.created_at) }}</td>
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
                                 <!-- <td>
                                  <button class="btn btn-success btn-sm" @click="showAlert(user.email)">
                                        Envoyer email
                                    </button>
                                </td>-->
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
    <!-- Alert for send Email to condidature -->
    <div class="modal fade show" id="myModal" ref="myModal" tabindex="1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="text-center w-100">
                        <h5 class="modal-title" id="exampleModalLabel">Envoyer Email </h5>
                    </div>
                    <button type="button" class="close" data-dismiss="modal" id="closebutton" aria-label="Close" @click="closeAlert">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                   <div class="input-field">
                    <input type="text" required id="titre_offre" name="titre_offre" v-model="emailSender">
                    <label>du</label>
                </div>
                <div class="input-field">
                    <input type="text" required  v-model="emailReceiver">
                    <label>À</label>
                </div> 
                <div class="input-field">
                    <input type="text" required  v-model="emailSubject">
                    <label>Sujet</label>
                </div> 
                 <div>
                    <textarea class="form-control mb-4" id="body" name="body" placeholder="content" v-model="emailBody"></textarea>
                </div>
               
                </div>
                <div class="modal-footer"> 
                    <button type="button" class="btn btn-primary" @click="sendEmail">Envoyer</button>
                </div>
            </div>
        </div>
    </div>
</div>
</template>

<script>
import moment from 'moment';
export default {
    name: 'mescondidats',
    data(){
        return {
            mescondidatures: {},
            Offrescondidatures: {},
            UsersTable: 'offres',
            selectedOffreId: null,
            selectedOffreCondidatures: {},
            pdfUrl: '',
            emailSender: '',
      emailReceiver: '',
      emailSubject: '',
      emailBody: '',
        }
    },
    methods: {
        sendEmail() {
      // Send the email data to the backend API
      axios.post('/send-email', {
         email_sender: this.emailSender,
        email_receiver: this.emailReceiver,
        email_subject: this.emailSubject,
        email_body: this.emailBody,
      })
        .then(response => {
          console.log(response.data.message);
          
          this.emailSender = '';
          this.emailReceiver = '';
          this.emailSubject = '';
          this.emailBody = '';
        })
        .catch(error => {
          console.error(error);
        });
    },
        closeAlert() {
            $('#myModal').modal('hide');
        },
        showAlert(email_receveir) {
            this.emailReceiver=email_receveir;
            $('#myModal').modal('show');
            var backdrop = document.querySelector('.modal-backdrop');

            // Update the class to remove 'fade'
            backdrop.classList.remove('fade');
            backdrop.classList.remove('modal-backdrop');
            backdrop.classList.add('show');
        },
        calculateTimeDifference(dateTime) {
      const start = moment(dateTime);
      const now = moment();

      return start.from(now);
    },
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
td{
    text-align: center;
}

td{
    border-radius: 0px;
}

.table-hover tbody tr:hover {
    background-color: transparent !important;
}

.card-title {
    text-align: center;
}
.tableau{
    width: 100%;
}
</style>
