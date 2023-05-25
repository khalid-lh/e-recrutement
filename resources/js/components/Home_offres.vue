<template>
<div>
    <div v-if="offers.length >0" class="mt-4 mb-4">
        <h3 class="mb-3">Listes Offres du Moment</h3>
        <div id="carouselExampleControls" class="carousel slide mt-4" data-ride="carousel">
            <div class="carousel-inner mt-4">
                <div v-for="(chunk, index) in chunkedOffers" :key="index" :class="['carousel-item', index === activeIndex ? 'active' : ''] ">
                    <div class="row">
                        <div v-for="offer in chunk" :key="offer.id" class="col-md-3 ">
                            <a :href="getSearchUrl(offer.id_offre,offer.slug)" class="lien_offre nav-link">
                                <div class="card item_offre" >
                                    <div class="offer-status">
                                        <h5 class="offer-status-text">Nouveau</h5>
                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title offre_titre">{{offer.titre_offre}}</h5>
                                        <p class="offre_comany">{{offer.company.company_name}}</p>
                                        <p class="offre_ville">{{offer.company.ville}}</p>
                                         <p class="offre_description">{{offer.description}}</p>
                                        <p class="offre_description">{{calculateTimeDifference(offer.created_at)}}</p>

                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <a class="carousel-control-prev prev" href="#carouselExampleControls" role="button" data-slide="prev" @click="prevOffer">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next next" href="#carouselExampleControls" role="button" data-slide="next" @click="nextOffer">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>
</div>
</template>

<script>
import moment from 'moment';
export default {
    data(){
        return {
            offers: {}, // Initialize with an empty array for offers
            activeIndex: 0 // Chunks of offers for display
        };
    },
    mounted() {
        this.getOffers(); // Fetch the offers data on component mount
    },
    computed: {
        chunkedOffers() {
            return this.chunkArray(this.offers, 4); // Chunk offers into arrays of size 4
        }
    },
    methods: {
        calculateTimeDifference(dateTime) {
      const start = moment(dateTime);
      const now = moment();

      return start.from(now);
    },
        getOffers() {
            axios.get('/home_offers') // Replace '/offers' with your Laravel route to fetch offers
                .then(response => {
                    this.offers = response.data.offers; // Assign the retrieved offers data to the 'offers' array
                    this.chunks = this.chunkOffers(this.offers, 4); // Group offers into chunks of four
                })
                .catch(error => {
                    console.error(error);
                });
        },

        nextOffer() {
            this.activeIndex = (this.activeIndex + 1) % this.chunkedOffers.length; // Increment the active index
        },
        prevOffer() {
            this.activeIndex = (this.activeIndex - 1 + this.chunkedOffers.length) % this.chunkedOffers.length; // Decrement the active index
        },
        chunkArray(arr, size) {
            const chunkedArr = [];
            for (let i = 0; i < arr.length; i += size) {
                chunkedArr.push(arr.slice(i, i + size));
            }
            return chunkedArr;
        },
        getSearchUrl(id,slug) {
          return `/offre_emploi?key=${encodeURIComponent(id)}&slug=${encodeURIComponent(slug)}`;
    }
    }

};
</script>

<style scoped>
h3 {
    text-align: center;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    font-size: 20px;
}

.item_offre {
    box-shadow: 0 20px 20px 0 rgba(92, 148, 207, 0.1);
    background-color: transparent;
    height:100%;
    
    margin-bottom: 20px;
}

.carousel-control-prev-icon,
.carousel-control-next-icon {

    background-color: cadetblue;
}

.lien_offre {
    text-decoration: none !important;
}
.offre_description{
    width: 100%;
   
    overflow-wrap: break-word;
}
.prev,
.next {
    width: 20px;
    height: 20px;
    color: blue !important;
    margin: 90px 20px 20px 20px;
}

.offre_titre {
    color: darkolivegreen;
    font-size: 20px;
    font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
}

.carousel {

    margin: 0px 20px 0px 20px;
}

.card.item_offre:hover {
    transform: translateY(-10px);
}

.card.item_offre {
    transition: transform 0.3s ease;
}

.offer-status {
    width: 80px;
    border: 1px solid #165aa2;
    text-align: center;
    height: 25px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 4px;
    margin: 10px 10px 10px 10px;
}

.offer-status-text {
    color: #165aa2;
}
</style>
