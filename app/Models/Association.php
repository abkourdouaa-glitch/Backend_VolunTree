<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
class Association extends Authenticatable
{
    use HasApiTokens;
    use Notifiable;
    
    protected $fillable = [
        'nom', 'email','photo_profile','telephone', 'password', 'ville', 'description','role'
        //  'recepisse'
    ];
    protected $hidden = [
        'password',
    ];
    public function missions(){
        return $this->hasMany(Mission::class);
    }
}
