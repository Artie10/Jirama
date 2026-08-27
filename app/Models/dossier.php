<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class dossier extends Model
{
    //Composant editable
    protected $fillable = [
        'NumDossier',
        'Nom',
        'Mail',
        'Cin',
        'Dmd_img',
        'residence_img',
        'autorisation_img',
        'statut'
    ];

    //RELATION AVEC LE MODEL MESURE
    public function mesures(){
        return $this->belongsTo(Mesure::class);
    }
    //RELATION AVEC LE MODEL DEVIS
    public function devis(){
        return $this->belongsTo(Devis::class);
    }

}
