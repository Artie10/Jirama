<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mesure extends Model
{
    protected $fillable = [
        'NumMesure',
        'NumDossier',
        'autorisation',
        'date',
        'longueur'
    ];
    
    //relation avec le model dossier
    public function dossier()
    {
        return $this->belongTo(dossier::class, 'NumDossier', 'NumDossier');
    }
}
