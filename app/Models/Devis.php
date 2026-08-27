<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Devis extends Model
{
    protected $fillable = [
        'NumDossier',
        'Materiel',
        'Prix'
    ];
    
    //relation avec tables dossier
    public function dossier(){
        return $this->belongsTo(dossier::class);
    }
}
