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
            .card{
  background: white !important;
  box-shadow: 0 20px 15px 0 rgba(92, 148, 207, 0.1) !important;

}
.card-link {
    text-decoration: none; /* Set the text-decoration to none */
    color: inherit; /* Inherit the color from the parent element */
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
          <Myheader></Myheader>
        </div>
      
        @if(count($allpublications) > 0)
          <div class="search-results">
            <ul>
                <div class="row mt-4 ">
                    @foreach($allpublications as $publication)
                      <div class="col-md-4 mb-4">
                        <div class="card" style="width: 18rem;">
                          <img src="/storage/posts/{{$publication->image}}" class="card-img-top"  style="height: 15rem;">
                          <div class="card-body">
                            <a href="/publication?key={{$publication->post_id}}?slug={{ urlencode($publication->slug)}}" class="card-link">
                              <h5 class="card-title">{{$publication->title}}</h5>
                              <p class="card-text">{{$publication->content}}</p>
                            </a>
                            
                          </div>
                        </div>
                      </div>
                    @endforeach
                </div>
            </ul>
          </div>
        @else
          <div class="message_exist">
            <h1>Il n’y a pas de publications sur la plateforme</h1> 
          </div>
        @endif
        <div id="footer_home"> 
            <footer_home>
            </footer_home>
    </div>
        <script src="{{ asset('js/app.js') }}"></script>
        <script>
          function calculateTimeDifference(dateTime) {
            const start = moment(dateTime);
            const now = moment();
      
            return start.from(now);
          }
        </script>
      </body>
      
</html>
