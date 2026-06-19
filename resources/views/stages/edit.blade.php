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
        <h2 class="my-4">Modifier cette Stage</h2>
        <form action="{{route('stages.update')}}" method="post">
            @csrf
            <input type="text" placeholder="Entrer titre" class="form-control my-3" name="titre" value="{{old('titre')}}">
            <input type="text" placeholder="Entrer duree_mois" class="form-control my-3" name="duree_mois" value="{{old('duree_mois')}}">
            <input type="text" placeholder="Entrer date_debut" class="form-control my-3" name="date_debut" value="{{old('date_debut')}}">
            <button class="btn btn-primary" type="submit">Modifier</button>
        </form>
    </div>
</body>
</html>