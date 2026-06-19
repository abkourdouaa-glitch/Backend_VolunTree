<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body>
    <div class="container d-flex justify-content-center  mt-4">
        <div class="card border border-rounded-3 w-50 p-3">
            <p><strong>Titre : </strong>{{$stage->titre}} </p>
            <p><strong>Duree_Mois : </strong>{{$stage->duree_mois}} </p>
            <p><strong>Date Debut : </strong>{{$stage->date_debut}} </p>
            <p>Id de l'entreprise : {{$stage->entreprise_id}}</p>
        </div>
    </div>
</body>
</html>