<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
class Benevole extends Authenticatable
{
    use HasApiTokens;
    use Notifiable;
    
    protected $fillable = [
        'nom', 'email', 'photo_profile','password', 'ville', 'date_naissance', 'role'
    ];
    protected $hidden = [
        'password',
    ];
    public function candidatures(){
        return $this->hasMany(Candidature::class);
    }
}
