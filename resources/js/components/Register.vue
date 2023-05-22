<template>
<div class="mt-4">
    <div class="row">
        <div>
            <Popup :message="popupMessage" v-if="popupMessage" @close="clearError" />
        </div>
        <div class="col-lg-2 col-md-2 col-sm-12">

        </div>
        <div class="col-lg-8 col-md-8 col-sm-12 col-tab-content">
            <nav>
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Condidat</button>
                    <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Recruteur</button>
                </div>
            </nav>
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab" tabindex="0">
                    <div class="row mb-4">
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="row mt-4">
                                <h4>Informations de contact</h4>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="input-field">
                                        <input type="text" required id="name" v-model="user_condidat.name">
                                        <label>Nom Complet</label>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="input-field">
                                        <input type="text" required id="telephone" v-model="profil.telephone">
                                        <label>Telephone</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div>
                                        <h6 id="title_component">Pays</h6>
                                        <select class="form-select form-select-sm mb-4" id="pays" name="pays" aria-label=".form-select-sm example" v-model="profil.pay">
                                            <option value="maroc">Maroc</option>
                                        </select>

                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div>
                                        <h6 id="title_component">Ville</h6>
                                        <select value="Ville" class="form-select form-select-sm mb-4" id="ville" name="ville" aria-label=".form-select-sm example" v-model="profil.ville">

                                            <option value="Casablanca">Casablanca</option>
                                            <option value="Marrakech">Marrakeech</option>
                                            <option value="Agadir">Agadir</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div id="upload-container">
                                        <div id="upload-border">
                                            <nobr>
                                                <input type="text" id="upload-cv cv" name="cv"  :value="cv ? cv : ''" disabled />
                                                <button id="upload-button" @click="handleUploadClick($refs.cv)">Upload your cv
                                                </button>
                                            </nobr>
                                        </div>
                                        <input ref="cv" type="file" id="hidden-upload cv" name="cv" accept="application/pdf" style="display:none" @change="handleFileUpload($event,$refs.cv)" />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div>
                                        <h6 id="title_component">Votre Photo</h6>
                                        <div class="photo-upload-container" :style="{ 'background-image': `url(${photoUrl})` }">
                                            <div class="photo-upload-overlay" @click="handlePhotoUploadClick($refs.photoInput)">
                                                <input ref="photoInput" type="file" id="image" name="image" accept="image/*" class="photo-upload-input" @change="handlePhotoInputChange($event, $refs.photoInput)">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <h4 class="mt-4">Informations de connexion</h4>
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="input-field">
                                        <input type="email" required id="email" v-model="user_condidat.email">
                                        <label>Email</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="input-field">
                                        <input type="password" required id="password" v-model="user_condidat.password">
                                        <label>Password</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group">
                                <div class="checkbox mb-4">
                                    <label>
                                        <input type="checkbox" id="vehicle3" name="vehicle3">
                                        J'accepte les Conditions Générales d'utilisation
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <button class="btn btn-primary btn_condidat" @click="register" style="float: right;">Register Condidat</button>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade " id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab" tabindex="0">
                    <div class="row mb-4">
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="row mt-4">
                                <h4>Informations sur l'entreprise</h4>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="input-field">
                                        <input type="text" required id="name_societe" v-model="company.name">
                                        <label>Nom Société</label>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="input-field">
                                        <input type="text" required id="telephone_societe" v-model="company.telephone">
                                        <label>Téléphone</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div>
                                        <h6 id="title_component">Pays</h6>
                                        <select class="form-select form-select-sm mb-4" id="pays_societe" name="pays" aria-label=".form-select-sm example" v-model="company.pay">

                                            <option value="maroc">Maroc</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="input-field">
                                        <input type="text" required id="code_postal" v-model="company.code_postal">
                                        <label>Code postal</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div>
                                        <h6 id="title_component">Ville</h6>
                                        <select value="Ville" class="form-select form-select-sm mb-4" id="ville_societe" name="ville" aria-label=".form-select-sm example" v-model="company.ville">
                                            <option value="Casablanca">Casablanca</option>
                                            <option value="Marrakech">Marrakeech</option>
                                            <option value="Agadir">Agadir</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <textarea class="form-control" rows="10" id="description" name="description" placeholder="Description de votre Entreprise*" v-model="company.description"></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div>
                                        <h4>Photo</h4>
                                        <div class="photo-upload-container" :style="{ 'background-image': `url(${logoUrl})` }">
                                            <div class="photo-upload-overlay" @click="handlePhotoUploadClick($refs.logo)">
                                                <input ref="logo" type="file" id="logo" name="logo" accept="image/*" class="photo-upload-input" @change="handlePhotoInputChange($event, $refs.logo)">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <h4 class="mt-4">Informations de recruteur</h4>
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="input-field">
                                        <input type="text" required id="name_recruteur" v-model="user_recruteur.name_recruteur">
                                        <label>Nom Complet</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="input-field">
                                        <input type="email" required id="email_recruteur" v-model="user_recruteur.email_recruteur">
                                        <label>Email</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="input-field">
                                        <input type="password" required id="password_recruteur" v-model="user_recruteur.password_recruteur">
                                        <label>Password</label>
                                    </div>
                                </div>
                            </div>
                            <h4 class="mt-4">Rgister de commerce </h4>
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <p class="alert alert-warning">Veuillez joindre votre RC pour accélérer
                                        l'activation de votre compte.</p>
                                </div>
                            </div>
                            <div class="row">
                                <div id="upload-container">
                                    <div id="upload-border">
                                        <nobr>
                                            <input type="text" id="upload-register register_commerce" name="register_commerce" :value="register_commerce ? register_commerce : ''" disabled />
                                            <button id="upload-button" @click="handleUploadClick($refs.rc)">Register Commerce
                                            </button>
                                        </nobr>
                                    </div>
                                    <input type="file" id="hidden-upload register_commerce" name="register_commerce" accept="application/pdf" style="display:none" ref="rc" @change="handleFileUpload($event,$refs.rc)" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group">
                                <div class="checkbox mb-4">
                                    <label>
                                        <input type="checkbox" id="vehicle3" name="vehicle3">
                                        J'accepte les Conditions Générales d'utilisation
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <button class="btn btn-primary btn_condidat" @click="register_recruteur" style="float: right;">Register Recruteur</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-2 col-md-2 col-sm-12">
        </div>
    </div>
</div>
</template>

<script>
import Popup from "./alertError.vue";
export default {

    components: {
        Popup,
    },
    data() {

        return {
            photoUrl: 'https://i.pinimg.com/originals/76/30/ad/7630ad49bdc79b8482c8627c663a1373.png',
            logoUrl: 'https://i.pinimg.com/originals/76/30/ad/7630ad49bdc79b8482c8627c663a1373.png',
            user_condidat: {
                name: '',
                email: '',
                password: ''
            },
            user_recruteur: {
                name_recruteur: '',
                email_recruteur: '',
                password_recruteur: ''
            },
            register_commerce: null,
            company: {
                name: '',
                telephone: '',
                ville: '',
                code_postal: '',
                pay: '',
                description: '',
                logo: null,
                register_commerce: null
            },
            cv: null,
            profil: {
                cv: null,
                telephone: '',
                photo: null,
                ville: '',
                pay: ''
            },
            errors_condidat: {
                con_err: {},
                name: {},
                email: {},
                password: {},
                telephone: {},
                cv: {},
                ville: {},
                image: {},
                pays: {}
            },
            popupMessage: "",
            errors_recruteur: {
                rec_err: {},
                name_recruteur: {},
                email_recruteur: {},
                password_recruteur: {},
                name_societe: {},
                telephone_societe: {},
                ville_societe: {},
                pays_societe: {},
                description: {},
                code_postal: {},
                register_commer: {},
                logo: {}
            }
        }
    },
    methods: {
        handlePhotoUploadClick(targetInput) {
            targetInput.click();
        },
        handlePhotoInputChange(event, targetInput) {
            const reader = new FileReader();
            if (targetInput === this.$refs.logo) {
                this.company.logo = event.target.files[0];
                reader.readAsDataURL(this.company.logo);
            } else if (targetInput === this.$refs.photoInput) {
                this.profil.photo = event.target.files[0];
                reader.readAsDataURL(this.profil.photo);
            }
            reader.onload = (e) => {
                if (targetInput === this.$refs.logo) {
                    this.logoUrl = e.target.result;
                } else if (targetInput === this.$refs.photoInput) {
                    this.photoUrl = e.target.result;
                }
            };
        },

        register() {
            let condidat = new FormData();
            condidat.append('name', this.user_condidat.name);
            condidat.append('email', this.user_condidat.email);
            condidat.append('password', this.user_condidat.password);
            condidat.append('telephone', this.profil.telephone);
            condidat.append('ville', this.profil.ville);
            condidat.append('pays', this.profil.pay);
            condidat.append('cv', this.profil.cv);
            condidat.append('image', this.profil.photo);
            axios.post('/Register/condidat', condidat).then(response => {
                this.user_condidat={
                    name: '',
                    email: '',
                    password: ''
                };
                this.cv = '';
                this.profil = {
                    cv: null,
                    telephone: '',
                    photo: null,
                    ville: '',
                    pay: ''
                };
                this.photoUrl = 'https://i.pinimg.com/originals/76/30/ad/7630ad49bdc79b8482c8627c663a1373.png';
                Toast.fire({
                    icon: 'success',
                    title: 'Signed up successfully'
                })
            }).catch((errors) => {
                this.errors_condidat = errors.response.data.errors
                this.checkErrors(this.errors_condidat);
            })
        },
        handleFileUpload( event , targetInput){
            if(targetInput === this.$refs.cv){
                const file1 = event.target.files[0];
                this.cv = event.target.files[0].name;
                this.profil.cv = file1;
            }else if (targetInput === this.$refs.rc){
                const file2 = event.target.files[0];
                this.register_commerce = event.target.files[0].name;
                this.company.register_commerce = file2;
            }
        },
        register_recruteur() {
            let Recruteur = new FormData();
            Recruteur.append('name_recruteur', this.user_recruteur.name_recruteur);
            Recruteur.append('email_recruteur', this.user_recruteur.email_recruteur);
            Recruteur.append('password_recruteur', this.user_recruteur.password_recruteur);
            Recruteur.append('name_societe', this.company.name);
            Recruteur.append('telephone_societe', this.company.telephone);
            Recruteur.append('ville_societe', this.company.ville);
            Recruteur.append('pays_societe', this.company.pay);
            Recruteur.append('description', this.company.description);
            Recruteur.append('code_postal', this.company.code_postal);
            Recruteur.append('register_commerce', this.company.register_commerce);
            Recruteur.append('logo', this.company.logo);
            console.log(Recruteur);
            axios.post('/Register/recruteur', Recruteur).then(response => {
                Toast.fire({
                    icon: 'success',
                    title: 'Signed up recruteur successfully'
                })
                this.user_recruteur = [];
                this.errors_recruteur = [];
                this.company = [];
                this.register_commerce = null;
                this.logoUrl = 'https://i.pinimg.com/originals/76/30/ad/7630ad49bdc79b8482c8627c663a1373.png';
            }).catch((errors) => {
                this.errors_recruteur = errors.response.data.errors
                this.checkErrors(this.errors_recruteur);
            })
        },
        handleUploadClick(targetInput) {
            targetInput.click();
        },
        checkErrors(errors) {
            if (Object.is(errors, this.errors_condidat)) {
                for (let key in this.errors_condidat) {
                    if (Object.keys(this.errors_condidat[key]).length > 0) {
                        // Set the error message and display the popup
                        this.popupMessage = Object.values(this.errors_condidat[key])[0];
                        return;
                    }
                }
            } else {
                for (let key in this.errors_recruteur) {
                    if (Object.keys(this.errors_recruteur[key]).length > 0) {
                        // Set the error message and display the popup
                        this.popupMessage = Object.values(this.errors_recruteur[key])[0];
                        return;
                    }
                }
            }
        },
        clearError() {
            this.popupMessage = "";
        }
    },
};
</script>

<style scoped>
@import url('https://fonts.googleapis.com/css?family=Montserrat:600|Noto+Sans|Open+Sans:400,700&display=swap');

.col-tab-content {
    background: white;
    padding: 40px;
    justify-content: center !important;
    align-items: center !important;
    box-shadow: 0 20px 15px 0 rgba(92, 148, 207, 0.1);
}

.nav-tabs {
    justify-content: center !important;
    border-style: none !important;
    tab-size: 100px !important;
}

label {
    font-size: 15px;
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

textarea,
textarea:focus {
    height: 200px !important;
    resize: none;
    background-color: #FFF;
    box-shadow: none;
}

.form-select {
    background-color: #FFF;
}

h4 {
    font-size: 19px;
    color: #000;
    font-weight: 600;
    padding-left: 10px;
    border-left: 5px solid #165aa2;
}

.nav-link {
    border-style: none !important;
    border-radius: 0px !important;
    font-size: 20px !important;
    font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif !important;
}

@media screen and (max-width: 1100px) {

    #upload-cv,
    #upload-register {
        width: 100px !important;
        background-color: #FFF;
    }
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

/*
 */
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

#title_component {
    color: dimgray;
}

select:focus,
textarea {
    outline: none;
    box-shadow: none !important;
}

.input-field {
    height: 40px;
}
</style>
