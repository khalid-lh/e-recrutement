<template>
<div class="dashboard">
    <div class="row mt-4">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header" >
                    <h4 class="card-title ">Liste des offres postuler par vous</h4>
                </div>
                <div class="card-body">
                    <table class="table table-striped walla table-hover" >
                        <thead>
                            <tr>
                                <th>Titre</th>
                                <th>Type Offre</th>  
                                <th>lien</th>
                                <th>Date creation</th>
                                <th>Date Postulement</th>
                            </tr>
                        </thead>   
                        <tbody>
                            <tr v-for="condidature in mescondidatures " :key="condidature.postule_id">
                                <td>{{ condidature.offre.titre_offre }}</td>
                                <td>{{ condidature.offre.type_offre }}</td>
                                <td><a :href="'/offre_emploi?key=' + condidature.offre.id_offre + '&slug=' + condidature.offre.slug">lien offre</a></td>
                                <td>{{ calculateTimeDifference(condidature.offre.created_at) }}</td>
                                <td>{{ calculateTimeDifference(condidature.created_at)}}</td>
                                <td>
                                    <button class="btn btn-danger btn-sm" @click="deleteOffre(condidature.postule_id)"><i class="fa fa-trash"></i></button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div>
        <!-- 19880/OP1/23 -->
       
    </div>
    
</div>
</template>

<script>
import '@fortawesome/fontawesome-free/css/all.css';
import moment from 'moment';
export default{
    name: 'Dashboard',
    data() {
        return {
          
         mescondidatures: {},
        }
    },
    methods: {
        getmescondidature() {
            let token = localStorage.getItem('token')
            axios.get('/condidat/mescondidatures', {  
                    headers: {
                        Authorization: `Bearer ${token}`
                    }
                })
                .then(response => {
                    this.mescondidatures = response.data.mescondidatures;
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
        deleteOffre(id){
            const swalWithBootstrapButtons = Swal.mixin({
  customClass: {
    confirmButton: 'btn btn-success',
    cancelButton: 'btn btn-danger'
  },
  buttonsStyling: false
})

swalWithBootstrapButtons.fire({

  text: "Voulez vous vraiment supprimer cette offre!",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonText: 'Supprimer!',
  cancelButtonText: 'Exit!',
  reverseButtons: true
}).then((result) => {
  if(result.isConfirmed){
    axios.delete(`/recruteur/dashboard/deleteoffre/${id}`)
                .then(res => {
                    swalWithBootstrapButtons.fire(
      'Supprimer!',
      'Votre offre a été supprimé.',
      'success'
    )
        this.fetchOffres();
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
      'Votre offre n\'est pas supprimé.',
      'error'
    )
  }
})        
        },   
    },
    computed:{    
    },
    created(){   
        this.getmescondidature();
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
