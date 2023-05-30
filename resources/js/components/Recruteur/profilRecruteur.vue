<template>
<div class="profil_recruteur">

    <!--<div class="row mt-4">
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
                <img v-if="company && company.photo" :src="getBase64Image()" alt="Image" />
            </div>
            <div class="cardprofil">
                <h4>Mise a jour logo de l'entreprise</h4>
                <div class="mb-4">
                    <div class="photo-upload-container" :style="{ 'background-image': `url(${logoUrl})`}">
                        <div class="photo-upload-overlay" @click="handlePhotoUploadClick">
                            <input ref="logo" type="file" id="logo" name='logo' accept="image/*" class="photo-upload-input" @change="handlePhotoInputChange">
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
                    <select value="Ville" class="form-select form-select-sm mb-4" id="ville" name="ville" aria-label=".form-select-sm example" v-model="updatedCompany.ville">
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
                    <input type="text" required id="telephone" v-model="updatedCompany.telephone">
                    <label for="telephone">Telephone</label>
                </div>
                <div class="input-field">
                    <input type="text" required id="code_postal" v-model="updatedCompany.code_postal">
                    <label for="code_postal">Code Postal</label>
                </div>
                <textarea class="form-control mb-4" rows="10" id="description" name="description" placeholder="Description de votre Entreprise" v-model="updatedCompany.description"></textarea>
                <div>
                    <button class="btn btn-primary btn_condidat" @click="updateCompany">Mise a jour</button>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-sm-12 col-md-6">
            <div class="cardprofil">
                <h4>A propos de votre entreprise</h4>
                <div v-if="company">
                    <p> Nom :{{company.company_name}}</p>
                </div>
                <div v-if="company">
                    <p> Telephone:{{ company.telephone}}</p>
                </div>
                <div v-if="company">
                    <p> Ville :{{company.ville}}</p>
                </div>
                <div v-if="company">
                    <p> Code Postal :{{company.code_postal}}</p>
                </div>
                <div v-if="company">
                    <p> Description : </p>
                    <textarea class="form-control" v-model="company.description" readonly>
                    </textarea>
                </div>
            </div>
        </div>
        <h4 class="title_profil">Informations sur votre Entreprise</h4>
    </div>-->

    <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);">
        <div class="row cardprofil">
            <h3 class="title_profil">Informations sur votre Entreprise</h3>
            <div class="row mb-3">
                <div class="col-sm-12 col-lg-6 col-md-6">
                    <div class="circle-image mb-4">
                        <img v-if="company && company.photo" :src="getBase64Image()" alt="Image" />
                    </div>
                </div>
                <div class="col-sm-12 col-lg-6 col-md-6">
                    <div v-if="company">
                        <h6>Nom Societe</h6>
                        <p class="company_name">{{company.company_name}}</p>
                    </div>
                    <div v-if="company">
                        <h6>Num RC</h6>
                        <p>{{ company.num_rc}}</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div v-if="company">
                        <h6>Ville</h6>
                        <p>{{company.ville}}</p>
                    </div>
                </div>
                <div class="col">
                    <div v-if="company">
                        <h6>Code Postal</h6>
                        <p>{{company.code_postal}}</p>
                    </div>
                </div>
                 <div class="col">
                    <div v-if="company">
                        <h6>Telephone</h6>
                        <p>{{company.telephone}}</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div v-if="company">
                    <h6>Decription</h6>
                    <p> {{company.description}} </p>

                </div>
            </div>
            <div class="row">
                <div>
                    <button class="btn_condidat" @click="showAlert()">Edit</button>
                </div>
            </div>
        </div>

        <div class="row">

            <div class="cardprofil">
                <h4>Mise a jour logo de l'entreprise</h4>
                <div class="mb-4">
                    <div class="photo-upload-container" :style="{ 'background-image': `url(${logoUrl})`}">
                        <div class="photo-upload-overlay" @click="handlePhotoUploadClick">
                            <input ref="logo" type="file" id="logo" name='logo' accept="image/*" class="photo-upload-input" @change="handlePhotoInputChange">
                        </div>
                    </div>
                </div>
                <div>
                    <button class="btn_condidat" @click="updatelogo">Mise a jour</button>
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
                        <h5 class="modal-title" id="exampleModalLabel">Modifier les informations de la societe</h5>
                    </div>
                    <button type="button" class="close" data-dismiss="modal" id="closebutton" aria-label="Close" @click="closeAlert">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" v-if="company">
                    <div class="input-field">
                        <h6 id="title_component">Ville</h6>
                        <select value="Ville" class="form-select form-select-sm mb-4" id="ville" name="ville" aria-label=".form-select-sm example" v-model="company.ville">
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
                        <input type="text" required id="telephone" v-model="company.telephone">
                        <label for="telephone">Telephone</label>
                    </div>
                    <div class="input-field">
                        <input type="text" required id="code_postal" v-model="company.code_postal">
                        <label for="code_postal">Code Postal</label>
                    </div>
                    <textarea class="form-control mb-4" rows="10" id="description" name="description" placeholder="Description de votre Entreprise" v-model="company.description"></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" @click="updateCompany">Edit</button>
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
            logoUrl: 'https://i.pinimg.com/originals/76/30/ad/7630ad49bdc79b8482c8627c663a1373.png',
            khalid: 'khalid',
            company: null,
            /*updatedCompany: {
                ville: '',
                telephone: '',
                code_posstal: '',
                description: '',
                logo: null,
            },*/
        }
    },
    methods: {
        handlePhotoUploadClick() {
            //this.$refs.photoInput.click();
            this.$refs.logo.click();
        },
        handlePhotoInputChange(event) {
            const file = event.target.files[0];
            this.updatedCompany.logo = file;
            const reader = new FileReader();
            reader.readAsDataURL(this.updatedCompany.logo);
            reader.onload = (e) => {
                this.logoUrl = e.target.result;
            };
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
        updatelogo() {
            let token = localStorage.getItem('token');
            let formData = new FormData();
            formData.append('logo', this.updatedCompany.logo);
            console.log(formData);
            axios.post('/recruteur/profil/updatelogo', formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data',
                        Authorization: `Bearer ${token}`
                    }
                })
                .then(response => {
                    let message = response.data.message;
                    if (message == 'Company logo updated successfully.') {
                        this.profilRecruteur();
                        this.logoUrl = 'https://i.pinimg.com/originals/76/30/ad/7630ad49bdc79b8482c8627c663a1373.png';
                    }
                })
                .catch(error => {});
        },
        profilRecruteur() {
            let token = localStorage.getItem('token');
            axios.get('/recruteur/profil/getinfos', {
                    headers: {
                        Authorization: `Bearer ${token}`
                    }
                })
                .then(response => {
                    this.company = response.data.company[0];
                    // retrieve the data returned by Laravel
                })
                .catch(error => {
                    // console.log(error.response.data); // retrieve any error messages returned by Laravel
                });
        },
        updateCompany() {
            let token = localStorage.getItem('token');
            axios.put('/recruteur/profil/updatcompany', this.updatedCompany, {
                    headers: {
                        Authorization: `Bearer ${token}`
                    }
                })
                .then(response => {
                    let message = response.data.message;
                    if (message == 'Company information updated successfully.') {
                        this.updatedCompany = {
                            ville: '',
                            telephone: '',
                            code_postal: '',
                            description: ''
                        };
                        this.profilRecruteur();
                    } else {}
                })
                .catch(error => {});
        },
        getBase64Image() {
            if (this.company && this.company.photo) {
                //return `data:image/jpg;base64,${btoa(String.fromCharCode.apply(null, this.company.photo))}`;
                return `/storage/images/${this.company.photo}`;
            }
            return null;
        },
    },
    mounted() {
        //this.getImageSrc(this.company.photo);
        this.profilRecruteur();

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

.circle-image {
    width: 130px;
    height: 130px;
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
    width: 230px;
    height: 40px;
    font-size: 17px;
    outline: none;
    padding: 0;
    text-align: center;
    background-color: #b9c01a;
    display: flex;
    align-items: center;
    justify-content: center;
    text-decoration: none;
    color: #FFF;
    border: 1px solid transparent;
    border-radius: 4px;
    font-weight: 600;
    transition: all .35s ease-in-out;
    box-shadow: 0 20px 15px 0 rgba(92, 148, 207, 0.1);
}

span {
    color: #165aa2;
}

p {
    font-size: 20px;
}

textarea,
textarea:focus {

    resize: none;
    background-color: #FFF;
    box-shadow: none;
}

h6 {
    font-size: 15px;
    color: #000;
    font-weight: 600;
    padding-left: 10px;
    border-left: 4px solid #165aa2;
}

.btn_condidat {
    width: 200px;
    height: 40px;
    font-size: 17px;
    outline: none;
    padding: 0;
    text-align: center;
    background-color: #b9c01a;
    display: flex;
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
