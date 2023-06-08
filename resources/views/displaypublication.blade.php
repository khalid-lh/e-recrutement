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
          .card h5{
    text-align: center;
}
.card{
  background: white !important;
  box-shadow: 0 20px 15px 0 rgba(92, 148, 207, 0.1) !important;
}
.card-title{
    font-family:  Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
    font-size: 35px;
}
.card-text{
    font-family: Arial, Helvetica, sans-serif;

}
        </style>
        <link rel="stylesheet" href="{{asset('css/app.css')}}">
    </head>
    <body>
        <div id="header"> 
        <Myheader>
        </Myheader>
        </div>
        <div id="alertContainer"></div>
        <div class="offre_header">
            <div class="row justify-content-center mt-4 mb-4">
                <div class="col-sm-12 col-lg-2 col-md-2">
                </div>
                <div class="col-sm-12 col-lg-8 col-md-8">
                    <div class="card" >
                        <img src="/storage/posts/{{$publication->image}}" class="card-img-top" style="height: 18rem;">
                        <div class="card-body">
                            <h5 class="card-title">{{$publication->title}}</h5>
                            <p class="card-text">{{$publication->content}}</p>
                        </div>
                      </div>
                </div>
                <div class="col-sm-12 col-lg-2 col-md-2">
                </div>
              </div>   
        </div>   
        
        <div id="footer_home"> 
            <footer_home>
            </footer_home>
    </div>
<script src="{{asset('js/app.js')}}">
</script>


    </body>
</html>
