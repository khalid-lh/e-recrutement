<template>
<div class="dashboard">
    <div class="content mt-3">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title ">Tous les emplois</h4>
                        </div>
                        <div class="row">
                            
                        </div>
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
    name: 'Dashboard',
    data(){
        return {
        allOffers: {},
          selectedType: 'Stage', // Default selected type
            offre: {},
        }
    },
    methods:{
        getallOffers(){
            axios.get('/admin/getallOffers')
                .then(response => {
                    this.allOffers = response.data.allOffers;
                })
                .catch((error) => {
                    console.error(error);  
                });
        },
    calculateTimeDifference(dateTime){
      const start = moment(dateTime);
      const now = moment();
      return start.from(now);
    },
          
    },
   computed: {
        filteredOffres(){
            // Filter products based on the selected type
            if (Array.isArray(this.allOffers)) {
                if (this.selectedType === 'Stage') {

                    return this.allOffers.filter((offre) => offre.type_offre === 'Stage');
                } else if (this.selectedType === 'Emploi') {
                    return this.allOffers.filter((offre) => offre.type_offre === 'Emploi');
                }
                return true;
            }
            return [];
        },
    },
    created(){   
        this.getallOffers();
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
</style>
