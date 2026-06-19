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
    <div class="container">
        <h2 class="my-4">Ajouter Un Stage</h2>
        <form action="{{route('stages.store')}}" method="post">
            @csrf
            <input type="text" placeholder="Entrer titre" class="form-control my-3" name="titre">
            <input type="text" placeholder="Entrer duree_mois" class="form-control my-3" name="duree_mois">
            <input type="text" placeholder="Entrer date_debut" class="form-control my-3" name="date_debut">
            <input type="text" placeholder="Entrer entreprise_id" class="form-control my-3" name="entreprise_id">
            <button class="btn btn-primary" type="submit">Ajouter</button>
        </form>
    </div>
</body>
</html>