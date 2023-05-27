<template>
<div>
    <div>
        <Popup :message="popupMessage" v-if="popupMessage" @close="clearError" />
    </div>
    <div class="row mb-4">
        <div class="col">
            <div class="card_offre">
                <div>
                    <h4>Ajouter Post</h4>
                </div>
                <div class="input-field">
                    <input type="text" required id="title" name="title" v-model="post.title">
                    <label>Titre</label>
                </div>
                <div>
                    <textarea class="form-control mb-4" id="content" name="content" placeholder="Content" v-model="post.content"></textarea>
                </div>
                <div>
                    <h4>Image</h4>
                    <div class="photo-upload-container" :style="{ 'background-image': `url(${photoUrl})` }">
                        <div class="photo-upload-overlay" @click="handlePhotoUploadClick">
                            <input ref="image" type="file" id="image" name="image" accept="image/*" class="photo-upload-input" @change="handlePhotoInputChange">
                        </div>
                    </div>
                </div>
                <div>
                    <button class="btn btn-primary btn_condidat mt-4" @click="addpost">Ajouter Post</button>
                </div>
            </div>
        </div>
    </div>
</div>
</template>

<script>
import Popup from "../Other/alertError.vue";
export default {

    components: {
        Popup,
    },
    data() {
        return {
            photoUrl: 'https://i.pinimg.com/originals/76/30/ad/7630ad49bdc79b8482c8627c663a1373.png',

            popupMessage: "",
            post: {
                title: '',
                content: '',
                image: null,

            },
            errors_post: {
                title: {},
                content: {},
                image: {},

            },

        }
    },
    methods: {
        handlePhotoUploadClick() {
            this.$refs.image.click();
        },
        handlePhotoInputChange(event) {
            const reader = new FileReader();

            this.post.image = event.target.files[0];
            reader.readAsDataURL(this.post.image);

            reader.onload = (e) => {

                this.photoUrl = e.target.result;

            };
        },
        addpost() {
            let post = new FormData();
            post.append('title', this.post.title);
            post.append('content', this.post.content);
            post.append('image', this.post.image);
            axios.post('/admin/addPost', post).then(response => {

                if (response.data.message == 'post ajouté'){
                    Toast.fire({
                    icon: 'success',
                    title: 'Post ajoute avec success'
                })
                    this.post={
                    title: '',
                    content: '',
                };
                    this.photoUrl = 'https://i.pinimg.com/originals/76/30/ad/7630ad49bdc79b8482c8627c663a1373.png';
                   
                }
            }).catch((errors) =>{
                this.errors_offre = errors.response.data.errors
                this.checkErrors(this.errors_offre);
                
            })
        },

        checkErrors(errors) {
            // Check if there are any errors in the form

            for (let key in this.errors_post) {
                if (Object.keys(this.errors_post[key]).length > 0) {
                    this.popupMessage = Object.values(this.errors_post[key])[0];
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
