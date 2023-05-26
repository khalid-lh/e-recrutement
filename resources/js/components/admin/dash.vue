<template>
<div class="dashboard">
    <div class="row">
        <div class="col">
            <div class="cards">
                <div class="card-content">
                    <div class="number">
                        {{StageCount}}
                    </div>
                    <div class="card-name">Totale Stage</div>
                </div>
                <div class="icon-box">
                   <i class="fas fa-briefcase"></i>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="cards">
                <div class="card-content">
                    <div class="number">{{EmploiCount}}</div>
                    <div class="card-name">Totale Emplois</div>
                </div>
                <div class="icon-box">
                  <i class="fas fa-briefcase"></i>
                </div>
            </div>
        </div>    
        <div class="col">
            <div class="cards">
                <div class="card-content">
                    <div class="number">{{companyCount}}</div>
                    <div class="card-name">Nombre Sociétés</div>
                </div>
                <div class="icon-box">
                 <i class="fa-sharp fa-solid fa-building mt-2"></i>
                </div>
            </div>
        </div>  
        <div class="col">
            <div class="cards">
                <div class="card-content">
                    <div class="number">{{UsersCount}}</div>
                    <div class="card-name">Nombre Users</div>
                </div>
                <div class="icon-box">
                  <i class="fa-sharp fa-solid fa-users"></i>
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
    name: 'admin_dashboard',
    data() {
        return{
        StageCount: null,
        UsersCount: null,
        companyCount: null,
        EmploiCount: null,
        }
    },
    methods:{
        statistiques(){
            axios.get('/admin/dashboard/statistiques')
                .then(response => {
                    this.StageCount = response.data.StageCount;
                    this.EmploiCount= response.data.EmploiCount;
                    this.UsersCount= response.data.UsersCount;
                    this.companyCount= response.data.companyCount;
                    if(this.StageCount== null){
                        this.StageCount = 0;
                    }
                    if(this.EmploiCount == null) {
                        this.EmploiCount = 0;
                    }
                    if(this.UsersCount == null) {
                        this.UsersCount = 0;
                    }
                    if(this.companyCount == null) {
                        this.companyCount = 0;
                    }
                })
                .catch(error=>{
                    console.log(error);
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
       
        this. statistiques();
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

.cards_condidat{
    justify-content: center;

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
