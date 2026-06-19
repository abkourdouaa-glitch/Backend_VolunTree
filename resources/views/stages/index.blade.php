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
        <div class="d-flex justify-content-between">
            <h2>List Des Stages</h2>
            <a href="{{route('stages.create')}}" class="btn btn-primary">+ Ajouter Un Nouveau Stage</a>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Titre</th>
                    <th>Duree_Mois</th>
                    <th>Dat_Debut</th>
                    <th>Entreprise_Id</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($stages as $stage)
                <tr>
                    <td>{{$stage->titre}}</td>
                    <td>{{$stage->duree_mois}}</td>
                    <td>{{$stage->date_debut}}</td>
                    <td>{{$stage->entreprise_id}}</td>
                    <td>
                        <a href={{route('stages.edit', $stage->id)}} class="btn btn-sucess">Modifier</a>
                        <a href="{{route('stages.show', $stage->id)}}" class="btn btn-warning">Détail</a>
                        <form method="post" action="{{route('stages.destroy', $stage->id)}}">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" type="submit">Supprimer</button>
                        </form>
                    </td>
                </tr>  
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>