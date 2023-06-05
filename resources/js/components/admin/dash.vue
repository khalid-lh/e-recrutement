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
                    <div class="card-name">Nombre Utilisateurs</div>
                </div>
                <div class="icon-box">
                  <i class="fa-sharp fa-solid fa-users"></i>
                </div>
            </div>
        </div>     
    </div>
<div class="content mt-4">
        <div class="row">
            <div class="col-sm-12" >
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title ">Tous les posts</h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped walla table-hover">
                            <thead>
                                <tr>
                                    <th>image</th>
                                    <th>Titre</th>
                                    <th>Content</th>
                                    <th>Date Creation</th>
                                    <th>lien Post</th>
                                    <th>Status</th>
                                    <th>Actions</th>                                   
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="post in  allposts" :key="post.post_id">
                                    <td><img :src="`/storage/posts/${post.image}`" alt="Image" class="circle-image " /></td>
                                    <td>{{ post.title}}</td>
                                    <td>{{ post.content}}</td>
                                    <td>{{ calculateTimeDifference(post.created_at)}}</td>
                                        <td><a :href="'/Post?key=' + post.post_id + '&slug=' +post.slug">lien offre</a></td>
                                    <td v-if=" post.deleted_at" > <p id="status_draft"> Draft</p> </td>
                                        <td v-else > <p id="status_live">Live</p></td>
                                    <td><button class="btn btn-success btn-sm" @click="showAlert(post.post_id)"><i class="fa fa-edit"></i></button>
                                        <button class="btn btn-danger btn-sm" @click="deletepost(post.post_id)"><i class="fa fa-trash"></i></button></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            
    
        </div>
    </div>
    <div class="modal fade show" id="myModal" ref="myModal" tabindex="1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="text-center w-100">
                        <h5 class="modal-title" id="exampleModalLabel">Modifier Post</h5>
                    </div>
                    <button type="button" class="close" data-dismiss="modal" id="closebutton" aria-label="Close" @click="closeAlert">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    
                   <div class="input-field">
                    <input type="text" required id="titre_post" name="titre_post" v-model="selectedpost.title">
                    <label>Titre</label>
                   </div>
                <div>
                    <textarea class="form-control mb-4" id="content" name="content" placeholder="Content" v-model="selectedpost.content"></textarea>
                </div>
               <h4>Image</h4>
                    <div class="photo-upload-container" :style="{ 'background-image': `url(${photoUrl})` }">
                        <div class="photo-upload-overlay" @click="handlePhotoUploadClick">
                            <input ref="image" type="file" id="image" name="image" accept="image/*" class="photo-upload-input" @change="handlePhotoInputChange">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" @click="closeAlert">Cancel</button>
                    <button type="button" class="btn btn-primary" @click="modifyPost">Modifier</button>
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
        photoUrl: 'https://i.pinimg.com/originals/76/30/ad/7630ad49bdc79b8482c8627c663a1373.png',
        StageCount: null,
        UsersCount: null,
        companyCount: null,
        EmploiCount: null,
           allposts: {},
            selectedpost: {
                title:'',
                content:'',
            },
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
                    if(this.EmploiCount == null){
                        this.EmploiCount = 0;
                    }
                    if(this.UsersCount == null){
                        this.UsersCount = 0;
                    }
                    if(this.companyCount == null){
                        this.companyCount = 0;
                    }
                })
                .catch(error=>{
                    console.log(error);
                });
        },
        
         closeAlert() {
            $('#myModal').modal('hide');
        },
        showAlert(postid){
axios.get(`/getPost/${postid}`)
                .then(response => {
                    this.selectedpost=response.data.post;
                })
                .catch(error=>{
                    console.log(error);
                });
            $('#myModal').modal('show');
            var backdrop = document.querySelector('.modal-backdrop');
            backdrop.classList.remove('fade');
            backdrop.classList.remove('modal-backdrop');
            backdrop.classList.add('show');
        },
        modifyPost(){
    const url = `/admin/modifypost/${this.selectedpost.post_id}`;
   let selectedpost = new FormData();
           selectedpost.append('title', this.selectedpost.title);
            selectedpost.append('content', this.selectedpost.content);
           selectedpost.append('image', this.selectedpost.image);

    axios.post(url, selectedpost)
      .then(response => {
        if(response.data.message_succes == 'post updated successfully'){
 this.closeAlert();
        this.selectedOffre={};
        this.getallposts();
        }
      })
      .catch(error => {
        // Handle the error
        console.error('Error modifying post:', error);
        
      });
  },
        getallposts() {
            axios.get('/admin/getallposts')
                .then(response => {
                    this.allposts = response.data.allposts;
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
          handlePhotoUploadClick() {
            this.$refs.image.click();
        },
        handlePhotoInputChange(event) {
            const reader = new FileReader();
            this.selectedpost.image = event.target.files[0];
            reader.readAsDataURL(this.selectedpost.image);
            reader.onload = (e) => {
                this.photoUrl = e.target.result;
            };
        },
        deletepost(id){
        const swalWithBootstrapButtons = Swal.mixin({
  customClass: {
    confirmButton: 'btn btn-success',
    cancelButton: 'btn btn-danger'
  },
  buttonsStyling: false
})

swalWithBootstrapButtons.fire({
  text: "Voulez vous vraiment supprimer cette post!",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonText: 'Supprimer!',
  cancelButtonText: 'Exit!',
  reverseButtons: true
}).then((result) => {
  if(result.isConfirmed){
axios.delete(`/admin/deletepost/${id}`)
                .then(res => {
                    swalWithBootstrapButtons.fire(
      'Supprimer!',
      'Votre post a été mit en brouillant.',
      'success'
    )
                  this.getallposts();
                })
                .catch(error => 
                console.log(error.response)            
                )
  } else if(
    /* Read more about handling dismissals below */
    result.dismiss === Swal.DismissReason.cancel
  ) {
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
        this.getallposts();
        this.statistiques();
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
.cards{
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
text-decoration-style: dashed;
}
.photo-upload-container {
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    background-color: aliceblue;
    width: 100px;
    height: 100px;
}

.photo-upload-overlay {
    display: flex;
    justify-content: center;
    align-items: center;
    width: 100%;
    height: 100%;

    cursor: pointer;
}

.photo-upload-overlay i {
    font-size: 30px;
    color: white;
}

.photo-upload-input {
    display: none;
}

.photo-upload-overlay i {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
}
</style>
