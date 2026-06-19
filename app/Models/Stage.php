<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stage extends Model
{
    protected $fillable = ([
        'titre','duree_mois','date_debut','entreprise_id'
    ]);
}
