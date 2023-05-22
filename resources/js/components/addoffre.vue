<template>
<div>
    <div>
        <Popup :message="popupMessage" v-if="popupMessage" @close="clearError" />
    </div>
    <div class="row mb-4">

        <div class="col">

            <div class="card_offre">
                <div>
                    <h4>Ajouter Offre</h4>
                </div>
                <div class="input-field">
                    <input type="text" required id="titre_offre" name="titre_offre" v-model="offre.titre_offre">
                    <label>Titre</label>
                </div>
                <div>
                    <textarea class="form-control mb-4" id="description" name="description" placeholder="Description de votre offre" v-model="offre.description"></textarea>
                </div>
                <div class="input-field">
                    <input type="number" required v-model="offre.n_postes">
                    <label>N° Postes</label>
                </div>
                <h6 id="title_component">Type Offre</h6>
                <select class="form-select form-select-sm mb-4" id="type_offre" name="type_offre" aria-label=".form-select-sm example" v-model="offre.type_offre">
                    <option value="Stage">Stage</option>
                    <option value="Emploi">Emploi</option>
                </select>
                <div v-if="offre.type_offre === 'Stage'">
                    <h6 id="title_component">Duree</h6>
                    <select class="form-select form-select-sm mb-4" id="duree" name="duree" aria-label=".form-select-sm example" v-model="offre.duree">
                        <option value="1 moi">1 moi</option>
                        <option value="2 moi">2 moi</option>
                        <option value="3 moi">3 moi</option>
                        <option value="4 moi">4 moi</option>
                        <option value="5 moi">5 moi</option>
                        <option value="6 moi">6 moi</option>
                    </select>
                    <h6 id="title_component">Convention</h6>
                    <select class="form-select form-select-sm mb-4" id="convention" name="convention" aria-label=".form-select-sm example" v-model="offre.convention">
                        <option value="oui">oui</option>
                        <option value="non">Non</option>
                    </select>
                </div>
                <div v-if="offre.type_offre === 'Emploi'">
                    <h6 id="title_component">Annee Experience</h6>
                    <div class="input-field">
                        <input type="number" required name="annee_experience" v-model="offre.annee_experience">
                        <label>Experience</label>
                    </div>
                </div>
                <h6 id="title_component">Presence</h6>
                <select class="form-select form-select-sm mb-4" id="presence" name="presence" aria-label=".form-select-sm example" v-model="offre.presence">
                    <option value="Distanciel">Distanciel</option>
                    <option value="Presenciel">Presenciel</option>
                </select>
                <div>
                    <button class="btn btn-primary btn_condidat" @click="addoffre">Ajouter offre</button>
                </div>
            </div>
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
            popupMessage: "",
            offre: {
                titre_offre: '',
                description: '',
                n_postes: null,
                type_offre: '',
                duree: '',
                convention: '',
                annee_experience: null,
                presence: ''
            },
            errors_offre: {
                titre_offre: {},
                description: {},
                n_postes: {},
                status: {},
                type_offre: {},
                type_temp: {},
                presence: {}
            },

        }
    },
    methods: {
        addoffre() {
            let token = localStorage.getItem('token');
            axios.post('/recruteur/addoffre', this.offre, {
                headers: {
                    Authorization: `Bearer ${token}`
                }
            }).then(response => {}).catch((errors) => {
                this.errors_offre = errors.response.data.errors
                this.checkErrors(this.errors_offre);
                if (response.data.message == 'offre ajoute') {
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Votre offre ajouter avec succe',
                        showConfirmButton: false,
                        timer: 1500
                    })
                }
            })
        },
        handleUploadClick() {
            document.querySelector("#hidden-upload").click();
        },
        checkErrors(errors) {
            // Check if there are any errors in the form

            for (let key in this.errors_offre) {
                if (Object.keys(this.errors_offre[key]).length > 0) {
                    this.popupMessage = Object.values(this.errors_offre[key])[0];
                    return;
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
.card_offre {
    padding: 20px;
    align-items: center;
    justify-content: space-between;
    background-color: #fff;
    border-radius: 10px;
    box-shadow: 0 7px 25px rgba(0, 0, 0, 0.08);
    margin-top: 10px;
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
    height: 200px !important;
    resize: none;
    background-color: #FFF;
    box-shadow: none;
    height: 20px;
}

h6 {
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
</style>
