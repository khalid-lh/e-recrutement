<template>
<div class="dashboard">
    <div class="row mt-4">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header" >
                    <h4 class="card-title ">Liste des posts supprime</h4>
                </div>
                <div class="card-body">
                    <table class="table table-striped walla table-hover" >
                        <thead>
                            <tr>
                                <th>image</th>
                                    <th>Titre</th>
                                    <th>Content</th>
                                    <th>Date Creation</th>
                                    <th>lien Post</th>
                                    <th>Date Suppression</th>
                              
                            </tr>
                        </thead>   
                        <tbody>
                            <tr v-for="post in  allpoststrashed" :key="post.post_id">
                                    <td><img :src="`/storage/posts/${post.image}`" alt="Image" class="circle-image " /></td>
                                    <td>{{ post.title}}</td>
                                    <td>{{ post.content}}</td>
                                    <td>{{ calculateTimeDifference(post.created_at)}}</td>
                                        <td><a :href="'/Post?key=' + post.post_id + '&slug=' +post.slug">lien offre</a></td>
                                    <td>{{ calculateTimeDifference(post.deleted_at)}}</td>
                                    <!--<button class="btn btn-danger btn-sm" @click="deleteOffre(offre.id_offre)"><i class="fa fa-trash"></i> Permanent</button>-->
                                    <td><button class="btn btn-success btn-sm" @click="restorepost(post.post_id)"><i class="fa-sharp fa-regular fa-trash-can-undo"></i> Restor</button>

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
          
         allpoststrashed: {},
        }
    },
    methods: {
        getmespostsdeleted() {  
              axios.get('/admin/mespostsdeleted')
                .then(response => {
                    this.allpoststrashed = response.data.allpoststrashed;
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
        restorepost(id){
            const swalWithBootstrapButtons = Swal.mixin({
  customClass: {
    confirmButton: 'btn btn-success',
    cancelButton: 'btn btn-danger'
  },
  buttonsStyling: false
})

swalWithBootstrapButtons.fire({
  text: "Voulez vous vraiment Restorer cette poste !",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonText: 'Restorer !',
  cancelButtonText: 'Exit!',
  reverseButtons: true
}).then((result) => {
  if(result.isConfirmed){
    axios.patch(`/admin/restorepost/${id}`)
                .then(res => {
                    swalWithBootstrapButtons.fire(
      'Restored!',
      'Votre post a été Restorer .',
      'success'
    )
        this.getmespostsdeleted();
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
      'Votre post n\'est pas Restorer.',
      'error'
    )
  }
})        
        },
    },
    computed:{    
    },
    created(){   
        this.getmespostsdeleted();
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
