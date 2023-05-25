<template>
<div class="dashboard">
    <div class="row mt-4">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header" >
                    <h4 class="card-title ">Liste des offres supprime</h4>
                </div>
                <div class="card-body">
                    <table class="table table-striped walla table-hover" >
                        <thead>
                            <tr>
                                <th>Titre</th>
                                <th>Type Offre</th>  
                                <th>lien</th>
                                <th>Date creation</th>
                                <th>Date Suppression</th>
                                <th>Action</th>
                            </tr>
                        </thead>   
                        <tbody>
                            <tr v-for="offre in mesoffresdeleted"  :key="offre.id_offre">
                                <td>{{ offre.titre_offre }}</td>
                                <td>{{offre.type_offre }}</td>
                                <td><a :href="'/offre_emploi?key=' +offre.id_offre+ '&slug=' +offre.slug ">lien offre</a></td>
                                <td>{{ calculateTimeDifference(offre.created_at)}}</td>
                                <td>{{ calculateTimeDifference(offre.deleted_at)}}</td>
                                <td>
                                    <!--<button class="btn btn-danger btn-sm" @click="deleteOffre(offre.id_offre)"><i class="fa fa-trash"></i> Permanent</button>-->
                                    <button class="btn btn-success btn-sm" @click="restoreOffre(offre.id_offre)"><i class="fa-sharp fa-regular fa-trash-can-undo"></i> Restor</button>

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
          
         mesoffresdeleted: {},
        }
    },
    methods: {
        getmesoffresdeleted() {
            let token = localStorage.getItem('token')
            axios.get('/recruteur/mesoffresdeleted', {  
                    headers: {
                        Authorization: `Bearer ${token}`
                    }
                })
                .then(response => {
                    this.mesoffresdeleted = response.data.mesoffresdeleted;
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

  text: "Voulez vous vraiment supprimer cette offre Permanant!",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonText: 'Supprimer !',
  cancelButtonText: 'Exit!',
  reverseButtons: true
}).then((result) => {
  if(result.isConfirmed){
    axios.delete(`/recruteur/dashboard/forcedelete/${id}`)
                .then(res => {
                    swalWithBootstrapButtons.fire(
      'Supprimer!',
      'Votre offre a été supprimé definitivement.',
      'success'
    )
        this.getmesoffresdeleted();
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
        restoreOffre(id){
            const swalWithBootstrapButtons = Swal.mixin({
  customClass: {
    confirmButton: 'btn btn-success',
    cancelButton: 'btn btn-danger'
  },
  buttonsStyling: false
})

swalWithBootstrapButtons.fire({

  text: "Voulez vous vraiment Restorer cette offre !",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonText: 'Restorer !',
  cancelButtonText: 'Exit!',
  reverseButtons: true
}).then((result) => {
  if(result.isConfirmed){
    axios.patch(`/recruteur/dashboard/restoreOffre/${id}`)
                .then(res => {
                    swalWithBootstrapButtons.fire(
      'Restored!',
      'Votre offre a été Restorer .',
      'success'
    )
        this.getmesoffresdeleted();
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
      'Votre offre n\'est pas Restorer.',
      'error'
    )
  }
})        
        },
    },
    computed:{    
    },
    created(){   
        this.getmesoffresdeleted();
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
