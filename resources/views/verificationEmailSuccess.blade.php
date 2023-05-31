<!-- verification-success.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Verification Success</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"></script>
    <style scoped>
       
        .emailcontainer {
            
            height: 330px;
            max-width: 400px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 40px;
            border-radius: 4px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        h1 {
            font-size: 24px;
            margin-bottom: 20px;
        }
        .emailcontainer p {
            font-size: 18px;
            color: #555555;
            margin-bottom: 30px;
        }
        .success-icon {
            font-size: 48px;
            color: #42b983;
            margin-bottom: 30px;
        }
        .btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #42b983;
            color: #ffffff;
            text-decoration: none;
            border-radius: 4px;
            transition: background-color 0.3s ease;
        }
        .btn:hover {
            background-color: #2b7a54;
        }
    </style>
      <link rel="stylesheet" href="{{asset('css/app.css')}}">
</head>
<body>
    <div id="header" class="mb-4"> 
        <Myheader>
        </Myheader>
        </div>
    <div class="emailcontainer">
        <i class="success-icon fas fa-check-circle"></i>
        <h1>Email Verified</h1>
        <p>Congratulations! Your email has been successfully verified.</p>
        <a href="/" class="btn">Go to Homepage</a>
    </div>
    <div id="footer_home" style="margin-top: 35px;"> 
        <footer_home>
        </footer_home>
</div>
<script src="{{asset('js/app.js')}}">
</script>
</body>
</html>
