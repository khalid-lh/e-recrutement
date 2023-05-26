<template>
<div class="dashboard">
    <div class="row mt-4">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title ">Liste des offres Enregistrer</h4>
                </div>
                <div class="card-body">
                    <table class="table table-striped walla table-hover">
                        <thead>
                            <tr>
                                <th>Titre</th>
                                <th>Type Offre</th>  
                                <th>lien</th>
                                <th>Date creation</th>
                                <th>Date Enregistrement</th>
                            </tr>
                        </thead>   
                        <tbody>
                            <tr v-for="enregistre in mesenregistrements " :key="enregistre.id_enregistrement">
                                <td>{{ enregistre.offre.titre_offre }}</td>
                                <td>{{ enregistre.offre.type_offre }}</td>
                                <td><a :href="'/offre_emploi?key=' + enregistre.offre.id_offre + '&slug=' + enregistre.offre.slug">lien offre</a></td>
                                <td>{{ calculateTimeDifference(enregistre.offre.created_at) }}</td>
                                <td>{{ calculateTimeDifference(enregistre.created_at)}}</td>
                                
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div>
 
       
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
        mesenregistrements: {},
        }
    },
    methods: {
        getmesenregistrement(){
            let token = localStorage.getItem('token')
            axios.get('/condidat/mesenregistrements', {  
                    headers: {
                        Authorization: `Bearer ${token}`
                    }
                })
                .then(response => {
                    this.mesenregistrements = response.data.mesenregistrements;
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
        deletepostule(id){
            const swalWithBootstrapButtons = Swal.mixin({
  customClass: {
    confirmButton: 'btn btn-success',
    cancelButton: 'btn btn-danger'
  },
  buttonsStyling: false
})

swalWithBootstrapButtons.fire({

  text: "Voulez vous vraiment supprimer cette condidature!",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonText: 'Supprimer!',
  cancelButtonText: 'Exit!',
  reverseButtons: true
}).then((result) => {
  if(result.isConfirmed){
    axios.delete(`/condidat/dashboard/deletepostule/${id}`)
                .then(res => {
                    swalWithBootstrapButtons.fire(
      'Supprimer!',
      'Votre condidature a été supprimé.',
      'success'
    )
        this.getmesenregistrement();
                })
                .catch(error => 
                console.log(error.response)            
                )
  }else if(
    /* Read more about handling dismissals below */
    result.dismiss === Swal.DismissReason.cancel
  ){
    swalWithBootstrapButtons.fire(
      'Cancelled',
      'Votre condidature n\'est pas supprimé.',
      'error'
    )
  }
})        
        },   
    },
    computed:{    
    },
    created(){   
        this.getmesenregistrement();
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
