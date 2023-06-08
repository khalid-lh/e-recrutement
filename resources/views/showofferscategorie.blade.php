<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css">
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"></script>
        
        <style scoped>
            .offre_detail{
  background: white;
  padding:40px;
  box-shadow: 0 20px 15px 0 rgba(92, 148, 207, 0.1);
}

    .footer{
    margin-top: 380px;
  }

.offre_header,.offre_information{
    margin: 0px 20px 0px 20px;
}
.btn_condidat{
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
    margin-bottom: 10px;
}
img {
    width: 100px;
    height: 100px;
}
i{
    margin-right: 10px;
}
.offre_titre {
    color: #b9c01a;
    font-size: 30px;
    font-family:Arial, Helvetica, sans-serif;
}
        </style>
        <style>
            body{
                font-family: 'Nunito', sans-serif;
            }
            #alertContainer {
    position: absolute;
    top: 0;
    width: 300px;
    left: 0;
    right: 0;
    text-align: center;
justify-content: center;
align-items: center;
    padding: 10px;
    z-index: 9999;
  }
  .message_exist{
    padding: 20px;
    text-align: center;
    justify-content: center;
    position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);
    box-shadow: 0 7px 25px rgba(0, 0, 0, 0.08);
    background-color: #fff;
    border-radius: 10px;
    margin-top: -50px;
  }
  .buttons_offre{
    float: right;
  }

        </style>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    </head>
    <body>
        <div id="header"> 
        <Myheader>
        </Myheader>
        </div>
        @if(count($offres)>0)
          <div class="search-results">
            <div id="alertContainer"></div>
            <ul>
                @foreach($offres as $offre)
                <div class="offre_header">
                    <div class="row justify-content-center mt-4 mb-4">
                        <div class="col-sm-12 col-lg-2 col-md-2">
                        </div>
                        <div class="col-sm-12 col-lg-8 col-md-8 offre_detail">
                            <div class="row">
                                <div class="col-sm-12 col-lg-4 col-md-4 mb-4">
                                    <div style="display: flex; justify-content: center; align-items: center; height: 100%;">
                                      <img src="/storage/images/{{$offre->company->photo}}" alt="Image" style="max-width: 100%; max-height: 100%;"/>
                                    </div>
                                  </div>
                                  <div class="col-sm-12 col-lg-8 col-md-8">
                                    <div class="row mb-2">
                                      <h5 class="card-title offre_titre">{{$offre->titre_offre}}</h5>
                                    </div>
                                    <div class="row">
                                        <div class="content" style="display: flex;">      
                                            <i class="fa-solid fa-location-dot"></i>  
                                            <p class="offre_ville">{{$offre->company->ville}}</p>
                                        </div>
                                    </div> 
                                    <div class="row content" style="display: flex;">
                                    <div class="col">
                                        <div class="content_detail" style="display: flex;">      
                                            <i class="fa-sharp fa-solid fa-building"></i>
                                            <p class="offre_comany">{{$offre->company->company_name}}</p>
                                    </div>
                                    </div>
                                    <div class="col ">
                                        <div class="content_detail" style="display: flex;">      
                                            
                                            <p class="offre_type"> Type Offre : {{$offre->type_offre}}</p>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="content_detail" style="display: flex;">      
                                           
                                            <p class="offre_presence"> Presence : {{$offre->presence}}</p>
                                        </div>
                                    </div>
                                    </div>                  
                                  </div>
                            </div>
                            <div class="row buttons_offre">
                                <div class="buttons_offre" >
                                    <button onclick="postuler_offre({{ $offre->id_offre }})" class="btn_condidat mr-2">Postuler</button>
                                    <button class=" btn_condidat mr-2 " onclick="enregistrer_offre({{ $offre->id_offre }})">Enregistrer</button>
                                    <a href="/offre_emploi?key={{ urlencode($offre->id_offre) }}&slug={{ urlencode($offre->slug)}}"><button class=" btn_condidat mr-2" >Plus de details</button></a>
                                </div>
                            </div>
                           
                        </div>
                        <div class="col-sm-12 col-lg-2 col-md-2">
                        </div>
                      </div>   
                </div>
                @endforeach
            </ul>
         </div>
          @else
            <div  class="message_exist" >
               <h1>Il n’y a pas des offres d'emplois de cette categorie</h1> 
            </div>
          @endif
          <div id="footer_home"> 
            <footer_home>
            </footer_home>
    </div>
<script src="{{asset('js/app.js')}}">
</script>
<script>
    // Function to fetch data
    let token = localStorage.getItem('token');
    function postuler_offre(id_offre) {
        axios.post('/postuler_offres', null,{
  params: {
     id: id_offre,
     token:token
  }
   }).then(response =>{        
        let message = response.data.message;
        if(message=='Votre condidature a été bien enregistrer'){
            let alertHTML = `
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Votre condidature a été bien enregistrer</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        `;
        document.getElementById('alertContainer').innerHTML = alertHTML;
    
        }else if(message=='Data already exists.'){
            let alertHTML = `
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Vous avez deja postuler a cette offre </strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        `;
        document.getElementById('alertContainer').innerHTML = alertHTML;
       
        }else if(message=='You do not have the privilege to postuler.'){
            let alertHTML = `
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Vous n’avez pas le droit de postuler.</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        `;
        document.getElementById('alertContainer').innerHTML = alertHTML;
        scrollToTop();
        }else if(message=='You need to be logged in to postuler'){
            let alertHTML = `
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Vous devez Authentifier pour postuler a cette offre</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        `;
        document.getElementById('alertContainer').innerHTML = alertHTML;
        }
            })
            .catch(error => {
                console.error(error);
            });
    }
    function enregistrer_offre(id_offre) {
        axios.post('/enregistrer_offre', null , {
  params: {
     id: id_offre,
     token:token
  }
   }).then(response =>{
        let message = response.data.message;
        if(message=='Votre enregistrement a été bien enregistrer'){
            let alertHTML = `
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Votre offre a été bien enregistrer</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        `;
        document.getElementById('alertContainer').innerHTML = alertHTML;
        }else if(message=='Data already exists.'){
            let alertHTML = `
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Vous avez deja enregistrer cette offre </strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        `;
        document.getElementById('alertContainer').innerHTML = alertHTML;
        }else if(message=='You do not have the privilege to postuler.'){
            let alertHTML = `
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Vous n’avez pas le droit d'enregistrer l'offre.</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        `;
        document.getElementById('alertContainer').innerHTML = alertHTML;
        }else if(message=='You need to be logged in to postuler'){
            let alertHTML = `
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Vous devez Authentifier pour enregistrer cette offre</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        `;
        document.getElementById('alertContainer').innerHTML = alertHTML;
        }
            })
            .catch(error => {
                // Handle the error
                console.error(error);
            });
    }
</script>
    </body>
</html>
