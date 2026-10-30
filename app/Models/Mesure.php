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
    ];

    protected $casts = [
        'date' => 'date',
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
