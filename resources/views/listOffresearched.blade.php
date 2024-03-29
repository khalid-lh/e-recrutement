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
                        /*! normalize.css v8.0.1 | MIT License | github.com/necolas/normalize.css */html{line-height:1.15;-webkit-text-size-adjust:100%}body{margin:0}a{background-color:transparent}[hidden]{display:none}html{font-family:system-ui,-apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Helvetica Neue,Arial,Noto Sans,sans-serif,Apple Color Emoji,Segoe UI Emoji,Segoe UI Symbol,Noto Color Emoji;line-height:1.5}*,:after,:before{box-sizing:border-box;border:0 solid #e2e8f0}a{color:inherit;text-decoration:inherit}svg,video{display:block;vertical-align:middle}video{max-width:100%;height:auto}.bg-white{--bg-opacity:1;background-color:#fff;background-color:rgba(255,255,255,var(--bg-opacity))}.bg-gray-100{--bg-opacity:1;background-color:#f7fafc;background-color:rgba(247,250,252,var(--bg-opacity))}.border-gray-200{--border-opacity:1;border-color:#edf2f7;border-color:rgba(237,242,247,var(--border-opacity))}.border-t{border-top-width:1px}.flex{display:flex}.grid{display:grid}.hidden{display:none}.items-center{align-items:center}.justify-center{justify-content:center}.font-semibold{font-weight:600}.h-5{height:1.25rem}.h-8{height:2rem}.h-16{height:4rem}.text-sm{font-size:.875rem}.text-lg{font-size:1.125rem}.leading-7{line-height:1.75rem}.mx-auto{margin-left:auto;margin-right:auto}.ml-1{margin-left:.25rem}.mt-2{margin-top:.5rem}.mr-2{margin-right:.5rem}.ml-2{margin-left:.5rem}.mt-4{margin-top:1rem}.ml-4{margin-left:1rem}.mt-8{margin-top:2rem}.ml-12{margin-left:3rem}.-mt-px{margin-top:-1px}.max-w-6xl{max-width:72rem}.min-h-screen{min-height:100vh}.overflow-hidden{overflow:hidden}.p-6{padding:1.5rem}.py-4{padding-top:1rem;padding-bottom:1rem}.px-6{padding-left:1.5rem;padding-right:1.5rem}.pt-8{padding-top:2rem}.fixed{position:fixed}.relative{position:relative}.top-0{top:0}.right-0{right:0}.shadow{box-shadow:0 1px 3px 0 rgba(0,0,0,.1),0 1px 2px 0 rgba(0,0,0,.06)}.text-center{text-align:center}.text-gray-200{--text-opacity:1;color:#edf2f7;color:rgba(237,242,247,var(--text-opacity))}.text-gray-300{--text-opacity:1;color:#e2e8f0;color:rgba(226,232,240,var(--text-opacity))}.text-gray-400{--text-opacity:1;color:#cbd5e0;color:rgba(203,213,224,var(--text-opacity))}.text-gray-500{--text-opacity:1;color:#a0aec0;color:rgba(160,174,192,var(--text-opacity))}.text-gray-600{--text-opacity:1;color:#718096;color:rgba(113,128,150,var(--text-opacity))}.text-gray-700{--text-opacity:1;color:#4a5568;color:rgba(74,85,104,var(--text-opacity))}.text-gray-900{--text-opacity:1;color:#1a202c;color:rgba(26,32,44,var(--text-opacity))}.underline{text-decoration:underline}.antialiased{-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale}.w-5{width:1.25rem}.w-8{width:2rem}.w-auto{width:auto}.grid-cols-1{grid-template-columns:repeat(1,minmax(0,1fr))}@media (min-width:640px){.sm\:rounded-lg{border-radius:.5rem}.sm\:block{display:block}.sm\:items-center{align-items:center}.sm\:justify-start{justify-content:flex-start}.sm\:justify-between{justify-content:space-between}.sm\:h-20{height:5rem}.sm\:ml-0{margin-left:0}.sm\:px-6{padding-left:1.5rem;padding-right:1.5rem}.sm\:pt-0{padding-top:0}.sm\:text-left{text-align:left}.sm\:text-right{text-align:right}}@media (min-width:768px){.md\:border-t-0{border-top-width:0}.md\:border-l{border-left-width:1px}.md\:grid-cols-2{grid-template-columns:repeat(2,minmax(0,1fr))}}@media (min-width:1024px){.lg\:px-8{padding-left:2rem;padding-right:2rem}}@media (prefers-color-scheme:dark){.dark\:bg-gray-800{--bg-opacity:1;background-color:#2d3748;background-color:rgba(45,55,72,var(--bg-opacity))}.dark\:bg-gray-900{--bg-opacity:1;background-color:#1a202c;background-color:rgba(26,32,44,var(--bg-opacity))}.dark\:border-gray-700{--border-opacity:1;border-color:#4a5568;border-color:rgba(74,85,104,var(--border-opacity))}.dark\:text-white{--text-opacity:1;color:#fff;color:rgba(255,255,255,var(--text-opacity))}.dark\:text-gray-400{--text-opacity:1;color:#cbd5e0;color:rgba(203,213,224,var(--text-opacity))}.dark\:text-gray-500{--tw-text-opacity:1;color:#6b7280;color:rgba(107,114,128,var(--tw-text-opacity))}}

            .offre_detail{
  background: white;
  padding:40px;
  box-shadow: 0 20px 15px 0 rgba(92, 148, 207, 0.1);
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
  .footer{
    margin-top: 380px;
  }
  .pagination {
    display: flex;
    justify-content: center;
    align-items: center;
    margin-top: 20px;
}

.pagination > li {
    margin: 0 5px;
    list-style-type: none;
}

.pagination > li > a,
.pagination > li > span {
    padding: 5px 10px;
    color: #333;
    background-color: #fff;
    border: 1px solid #ccc;
    text-decoration: none;
}

.pagination > .active > a {
    background-color: #007bff;
    color: #fff;
    border-color: #007bff;
}

.pagination > li > a:hover {
    background-color: #f2f2f2;
}

        </style>
        <style>
            body {
                font-family: 'Nunito', sans-serif;
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
                {{ $offres->links() }}
            </ul>
         </div>
         <div id="footer_home"> 
            <footer_home>
            </footer_home>
    </div>
          @else
            <div  class="message_exist">
               <h1>Il n’y a pas d’offres sur la ville ou la profession que vous avez choisie</h1> 
            </div>
            <div id="footer_home"> 
                <footer_home>
                </footer_home>
        </div>
          @endif
          
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
                // Handle the error
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
