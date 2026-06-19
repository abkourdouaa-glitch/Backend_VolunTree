<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mission extends Model
{
    protected $fillable = ([
        'titre','description','date','image', 'statut','n_benevoles','lieu','categorie','association_id'
    ]);

    public function association() {
        return $this->belongsTo(Association::class);
    }

    public function candidatures() {
        return $this->hasMany(Candidature::class);
    }

}
