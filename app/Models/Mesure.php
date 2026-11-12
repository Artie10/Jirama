<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Dossier;

class Mesure extends Model
{
    protected $table = 'mesures';

    protected $fillable = [
        'NumMesure',
        'NumDossier',
        'autorisation',
        'date',
        'longueur',
        'latitude',
        'longitude',
        'adresse_localisation',
    ];

    protected $casts = [
        'date' => 'date',
        'longueur' => 'decimal:2',
        'latitude' => 'decimal:7',
        'longitude' => 'decimal:7',
    ];

    public function dossier()
    {
        return $this->belongsTo(
            Dossier::class,
            'NumDossier',
            'NumDossier'
        );
    }
}
