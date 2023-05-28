<!DOCTYPE html>
<!-- Created by CodingLab |www.youtube.com/CodingLabYT-->
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <!-- Boxicons CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="stylesheet" href="{{asset('css/app.css')}}">
     <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" />
     <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
     <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Add this in the <head> section of your HTML file -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.8.335/pdf.min.js"></script>

     <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
     <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
     <script src="sweetalert2.all.min.js"></script>
     <!-- Optional: include a polyfill for ES6 Promises for IE11 -->
     <script src="//cdn.jsdelivr.net/npm/promise-polyfill@8/dist/polyfill.js"></script>
   <style>
    body{
      background-color: cornsilk;
      padding: 10px;

    }
   </style>
    </head>
   

<body>
<div >
    <h1 style="text-align: center;">FORSASTI</h1>
    @if($data['type']=='inscription recruteur')
    <p>
      Cher {{$data['name']}}<br><br>

Votre compte recruteur a été créé avec succès. Vous pouvez maintenant vous connecter à votre compte et commencer à publier des offres d’emploi et à gérer votre processus de recrutement.<br><br>

Veuillez conserver vos identifiants de connexion en sécurité et ne les partagez avec personne.<br><br>

Si vous avez des questions ou avez besoin d’aide, n’hésitez pas à contacter notre équipe d’assistance.<br><br>

Merci d’avoir choisi notre plateforme.<br><br>

Sinceres salutations

</p>
    @elseif($data['type']=='inscription condidat')
    <p>
      Cher {{$data['name']}} <br><br>
      Votre compte candidat a été créé avec succès. Vous pouvez maintenant vous connecter à votre compte et commencer à explorer les opportunités d’emploi, à soumettre des candidatures et à gérer votre profil.<br><br>

Veuillez conserver vos identifiants de connexion en sécurité et ne les partagez avec personne.<br><br>

Si vous avez des questions ou avez besoin d’aide, n’hésitez pas à contacter notre équipe d’assistance.<br><br>

Merci d’avoir rejoint notre plateforme.
</p>
  
    
@elseif($data['type']=='postulement')

<p>
  Nous avons le plaisir de vous informer que votre candidature pour le poste de {{ $data['offre_name'] }} à {{ $data['company'] }} a été soumise avec succès. <br><br> Nous vous remercions de l’intérêt que vous portez à cette opportunité.<br><br>

  Détails de l’application : <br><br>
  - poste: {{ $data['offre_name']}} <br><br>
  - Entreprise : {{ $data['company'] }}<br><br>
  - Date d’application: {{ $data['date']->format('Y-m-d H:i:s') }}<br><br>
  Merci encore de l’intérêt que vous portez à l'entreprise {{ $data['company'] }} .  Nous apprécions votre temps et vos efforts pour postuler.<br><br>

Sinceres salutations
    </p>
    @endif
  </div>
</body>
</html>