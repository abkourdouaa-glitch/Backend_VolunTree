<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Candidature extends Model
{
    protected $fillable = ([
        'message','statut','benevole_id','mission_id'
    ]);

    public function benevole() {
        return $this->belongsTo(Benevole::class); 
    }

    public function mission() {
        return $this->belongsTo(Mission::class);
    }
}
