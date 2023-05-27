<template>
<div class="profil_recruteur">

    <!--<div class="row mt-4" v-if="profil">
        <div class="col-lg-4 col-sm-12 col-md-6">
            <div class="cardprofil">
                <h4>Changer Mot de Pass</h4>
                <div class="input-field">
                    <input type="password" required id="nv_password" placeholder="Nouveau Mot de Pass">
                </div>
                <div class="input-field">
                    <input type="password" required id="confirm_password" placeholder="Confirmation Mot de Pass">
                </div>
                <div>
                    <button class="btn btn-primary btn_condidat">Mettre a jour</button>
                </div>
            </div>

            <div class="circle-image">
                <img v-if="condidat && condidat.photo" :src="getBase64Image()" alt="Image" />
            </div>
            <div class="cardprofil">
                <h4>Mise a jour votre photo de profil</h4>
                <div class="mb-4">
                    <div class="photo-upload-container" :style="{ 'background-image': `url(${logoUrl})`}">
                        <div class="photo-upload-overlay" @click="handlePhotoUploadClick">
                            <input ref="photo" type="file" id="photo" name='photo' accept="image/*" class="photo-upload-input" @change="handlePhotoInputChange">
                        </div>
                    </div>
                </div>
                <div>
                    <button class="btn btn-primary btn_condidat" @click="updatelogo">Mise a jour</button>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-sm-12 col-md-6">
            <div class="cardprofil">
                <h4>Mise a jour les informations</h4>
                <div class="input-field">
                    <h6 id="title_component">Ville</h6>
                    <select value="Ville" class="form-select form-select-sm mb-4" id="ville" name="ville" aria-label=".form-select-sm example" v-model="updatedcondidat.ville">
                        <option value="">Ville</option>
                        <option value="Agadir">Agadir</option>
                        <option value="Casablanca">Casablanca</option>
                        <option value="Fez">Fez</option>
                        <option value="Marrakech">Marrakech</option>
                        <option value="Rabat">Rabat</option>
                        <option value="Tangier">Tangier</option>
                    </select>
                </div>
                <div class="input-field">
                    <h6 id="title_component">Pay</h6>
                    <select value="pays" class="form-select form-select-sm mb-4" id="pays" name="pays" aria-label=".form-select-sm example" v-model="updatedcondidat.pays">
                        <option value="Maroc">Maroc</option>
                    </select>
                </div>
                <div class="input-field">
                    <input type="text" required id="telephone" v-model="updatedcondidat.telephone">
                    <label for="telephone">Telephone</label>
                </div>

                <div>
                    <button class="btn btn-primary btn_condidat" @click="updatecondidat">Mise a jour</button>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-sm-12 col-md-6">
            <div class="cardprofil">
                <h4>A propos de votre Profil</h4>
                <div v-if="condidat">
                    <p> Nom :{{condidat.user.name}}</p>
                </div>
                <div v-if="condidat">
                    <p> Email :{{ condidat.user.email}}</p>
                </div>
                <div v-if="condidat">
                    <p> Telephone:{{ condidat.telephone}}</p>
                </div>
                <div v-if="condidat">
                    <p> Ville :{{condidat.ville}}</p>
                </div>
                <div v-if="condidat">
                    <p> pay :{{condidat.pays}}</p>
                </div>
                <button class="btn btn-success btn-sm" @click="viewcv(condidat.cv)">
                    cv
                </button>
            </div>
            <div class="cardprofil">
                <h4>Mise a jour votre cirriculum vitae</h4>
                <div id="upload-container">
                    <div id="upload-border">
                        <nobr>
                            <input type="text" id="upload-register cv" name="cv" :value="cv ? cv : ''" disabled />
                            <button id="upload-button" @click="handleUploadClick">upload
                            </button>
                        </nobr>
                    </div>
                    <input type="file" id="hidden-upload cv" name="cv" accept="application/pdf" style="display:none" ref="cv" @change="handleFileUpload($event)" />
                </div>
                <div>
                    <button class="btn btn-primary btn_condidat" @click="updatecv">Mise a jour cv </button>
                </div>
            </div>
        </div>
    </div>
    <div v-else style="display: block;">
        <button class="btn btn-primary btn-sm mb-4" style="float :right;" @click="profil=true">
            Retour
        </button>
        <div style="display: flex; justify-content: center; align-items: center;" class="mt-2">
            <iframe :src="cvUrl" width="700px" height="700px" frameborder="0"></iframe>
        </div>
    </div>
    -->

    <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);" v-if="profil">

        <div class="row cardprofil">
            <h3 class="title_profil">Informations sur votre Entreprise</h3>
            <div class="row mb-3">
                <div class="col-sm-12 col-lg-6 col-md-6">
                    <div class="circle-image mb-4">
                        <img v-if="condidat && condidat.photo" :src="getBase64Image()" alt="Image" />
                    </div>
                </div>
                <div class="col-sm-12 col-lg-6 col-md-6">
                    <div v-if="condidat">
                        <h6>Nom </h6>
                        <p class="company_name">{{condidat.user.name}}</p>
                    </div>
                    <div v-if="condidat">
                        <h6>Email</h6>
                        <p>{{ condidat.user.email}}</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div v-if="condidat">
                        <h6>Telephone</h6>
                        <p>{{condidat.telephone}}</p>
                    </div>
                </div>
                <div class="col">
                    <div v-if="condidat">
                        <h6>Ville</h6>
                        <p>{{condidat.ville}}</p>
                    </div>
                </div>
                <div class="col">
                    <div v-if="condidat">
                        <h6>Pay</h6>
                        <p>{{condidat.pays}}</p>
                    </div>
                </div>
            </div>
            <div class="row" style="display: flex; float: right;">
                <div>
                    <button class="btn_condidat"  @click="showAlert()">Edit</button>
                    <button class="btn_condidat"  style="margin-right: 20px;" @click="viewcv(condidat.cv)">cv</button>
                </div>
            </div>
        </div>

        <div class="row cardprofil">
            <div class="col mb-4">
                <h4>Mise a jour votre photo de profil</h4>
                <div class="mb-4">
                    <div class="photo-upload-container" :style="{ 'background-image': `url(${logoUrl})`}">
                        <div class="photo-upload-overlay" @click="handlePhotoUploadClick">
                            <input ref="photo" type="file" id="photo" name='photo' accept="image/*" class="photo-upload-input" @change="handlePhotoInputChange">
                        </div>
                    </div>
                </div>
                <div>
                    <button class="btn btn-primary btn_condidat" @click="updatelogo">Mise a jour</button>
                </div>
            </div>
            <div class="col">
                <h4>Mise a jour votre cirriculum vitae</h4>
                <div id="upload-container">
                    <div id="upload-border">
                        <nobr>
                            <input type="text" id="upload-register cv" name="cv" :value="cv ? cv : ''" disabled />
                            <button id="upload-button" @click="handleUploadClick">upload
                            </button>
                        </nobr>
                    </div>
                    <input type="file" id="hidden-upload cv" name="cv" accept="application/pdf" style="display:none" ref="cv" @change="handleFileUpload($event)" />
                </div>
                <div>
                    <button class="btn btn-primary btn_condidat " style="margin-top : 55px;" @click="updatecv">Mise a jour cv</button>
                </div>
            </div>
        </div>
    </div>
    <div v-else style="display: block;">
        <button class="btn btn-primary btn-sm mb-4" style="float :right;" @click="profil=true">
            Retour
        </button>
        <div style="display: flex; justify-content: center; align-items: center;" class="mt-2">
            <iframe :src="cvUrl" width="700px" height="700px" frameborder="0"></iframe>
        </div>
    </div>
    <!-- Alert for send Email to condidature -->
    <div class="modal fade show" id="myModal" ref="myModal" tabindex="1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="text-center w-100">
                        <h5 class="modal-title" id="exampleModalLabel">Modifier les informations de votre compte</h5>
                    </div>
                    <button type="button" class="close" data-dismiss="modal" id="closebutton" aria-label="Close" @click="closeAlert">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" v-if="condidat">
                    <div class="input-field">
                        <h6 id="title_component">Ville</h6>
                        <select value="Ville" class="form-select form-select-sm mb-4" id="ville" name="ville" aria-label=".form-select-sm example" v-model="this.condidat.ville">
                            <option value="">Ville</option>
                            <option value="Agadir">Agadir</option>
                            <option value="Casablanca">Casablanca</option>
                            <option value="Fez">Fez</option>
                            <option value="Marrakech">Marrakech</option>
                            <option value="Rabat">Rabat</option>
                            <option value="Tangier">Tangier</option>
                        </select>
                    </div>
                    <div class="input-field">
                        <h6 id="title_component">Pay</h6>
                        <select value="pays" class="form-select form-select-sm mb-4" id="pays" name="pays" aria-label=".form-select-sm example" v-model="this.condidat.pays">
                            <option value="Maroc">Maroc</option>
                        </select>
                    </div>
                    <div class="input-field">
                        <input type="text" required id="telephone" v-model="this.condidat.telephone">
                        <label for="telephone">Telephone</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" @click="updatecondidat">Edit</button>
                </div>
            </div>
        </div>
    </div>
</div>
</template>

<script>
export default {
    name: 'profil',
    data() {
        return {
            profil: true,
            cv: null,
            logoUrl: 'https://i.pinimg.com/originals/76/30/ad/7630ad49bdc79b8482c8627c663a1373.png',
            condidat: null,
            photo: null,
           /* updatedcondidat: {
                ville: '',
                telephone: '',
                pays: '',
                cv: null,
            },*/
            cvUrl: '',
        }
    },
    methods: {
        viewcv(cv) {
            this.profil = false;
            this.cvUrl = `/storage/pdfs/${cv}`;
        },

        handleFileUpload(event) {
            const file1 = event.target.files[0];
            this.cv = event.target.files[0].name;
            this.updatedcondidat.cv = file1;
        },
        handleUploadClick() {
            this.$refs.cv.click();
        },
        handlePhotoUploadClick() {
            //this.$refs.photoInput.click();
            this.$refs.photo.click();
        },
        handlePhotoInputChange(event) {
            const file = event.target.files[0];
            this.photo = file;
            const reader = new FileReader();
            reader.readAsDataURL(this.photo);
            reader.onload = (e) => {
                this.logoUrl = e.target.result;
            };
        },
        updatelogo() {
            let token = localStorage.getItem('token');
            let formData = new FormData();
            formData.append('photo', this.photo);

            axios.post('/condidat/profil/updatephoto', formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data',
                        Authorization: `Bearer ${token}`
                    }
                })
                .then(response => {
                    let message = response.data.message;
                    if (message == 'photo updated successfully.') {
                        this.profilCondidat();
                        this.logoUrl = 'https://i.pinimg.com/originals/76/30/ad/7630ad49bdc79b8482c8627c663a1373.png';
                    } else {
                        dd('ikhan');
                    }
                })
                .catch(error => {});
        },
        updatecv(){
            let token = localStorage.getItem('token');
            let formData = new FormData();
            formData.append('cv', this.updatedcondidat.cv);
            axios.post('/condidat/profil/updatecv', formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data',
                        Authorization: `Bearer ${token}`
                    }
                })
                .then(response => {
                    let message = response.data.message;
                    if (message == 'cv updated successfully.') {
                        this.profilCondidat();
                        this.cv = null;
                    } else {
                        dd('ikhan');
                    }
                })
                .catch(error => {});
        },
        closeAlert() {
            $('#myModal').modal('hide');
        },
        showAlert() {
            $('#myModal').modal('show');
            var backdrop = document.querySelector('.modal-backdrop');

            // Update the class to remove 'fade'
            backdrop.classList.remove('fade');
            backdrop.classList.remove('modal-backdrop');
            backdrop.classList.add('show');
        },
        profilCondidat() {
            let token = localStorage.getItem('token');
            axios.get('/condidat/profil/getinfos', {
                    headers: {
                        Authorization: `Bearer ${token}`
                    }
                })
                .then(response => {
                    this.condidat = response.data.condidat[0];
                   
                })
                .catch(error => {
                    // console.log(error.response.data); // retrieve any error messages returned by Laravel
                });
        },
        updatecondidat(){
            let token = localStorage.getItem('token');
            axios.put('/condidat/profil/updatecondidat', this.updatedcondidat, {
                    headers: {
                        Authorization: `Bearer ${token}`
                    }
                })
                .then(response => {
                    let message = response.data.message;
                    if(message == 'condidat information updated successfully.') {

                        this.profilCondidat();
                    }else{
                    }
                })
                .catch(error => {});
        },
        getBase64Image(){
            if (this.condidat && this.condidat.photo) {
                //return `data:image/jpg;base64,${btoa(String.fromCharCode.apply(null, this.company.photo))}`;
                return `/storage/images/${this.condidat.photo}`;
            }
            return null;
        },
    },
    mounted() {
        //this.getImageSrc(this.company.photo);
        this.profilCondidat();

    },
};
</script>

<style scoped>
.profil_recruteur {
    margin: 10px 10px 10px 10px;
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

h6 {
    font-size: 15px;
    color: #000;
    font-weight: 600;
    padding-left: 5px;
    border-left: 4px solid #165aa2;
}

.title_profil {
    font-size: 19px;
    color: #000;
    font-weight: 600;
    padding-left: 10px;
    margin-bottom: 20px;
    text-align: center;
    justify-content: center;
    align-content: center;
}

.circle-image {
    width: 150px;
    height: 150px;
    border-radius: 50%;
    overflow: hidden;

    justify-content: center;
}

.circle-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.btn_condidat {
    width: 150px;
    height: 40px;
    font-size: 17px;
    outline: none;
    padding: 0;
    text-align: center;
    background-color: #b9c01a;
    display: flex;
    margin-bottom: 20px;
    align-items: center;
    justify-content: center;
    text-decoration: none;
    color: #FFF;
    border: 1px solid transparent;
    border-radius: 4px;
    font-weight: 600;
    transition: all .35s ease-in-out;
    box-shadow: 0 20px 15px 0 rgba(92, 148, 207, 0.1);
    float: right;
}

#upload-border {
    height: 30px;
    border: 1px solid #2077C9;
    display: inline-block;
    padding-left: 7px;
    margin: 20px 0;
}

#upload-cv,
#upload-register {
    height: 70%;
    border: none;
}

#upload-button {
    height: 100%;
    padding: 0 20px;
    border: none;
    background: #2077C9;
    color: white;
    cursor: pointer;
}

#upload-name:focus,
#upload-button:focus {
    outline: none;
}

span {
    color: #165aa2;
}

p {
    font-size: 20px;
}

textarea,
textarea:focus {
    height: 200px !important;
    resize: none;
    background-color: #FFF;
    box-shadow: none;
}

h4 {
    font-size: 19px;
    color: #000;
    font-weight: 600;
    padding-left: 10px;
    border-left: 5px solid #165aa2;
}

.cardprofil {
    padding: 20px;
    background-color: #fff;
    border-radius: 10px;
    box-shadow: 0 7px 25px rgba(0, 0, 0, 0.08);
    margin-bottom: 10px;
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
