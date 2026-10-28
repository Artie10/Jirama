<?php

namespace App\Models;






use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Dossier extends Authenticatable
{
    use HasFactory;

    protected $table = 'dossiers';

    protected $fillable = [
        'NumDossier',
        'Nom',
        'Mail',
        'telephone',
        'password',
        'Cin',
        'Dmd_img',
        'residence_img',
        'autorisation_img',
        'statut',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function getAuthPasswordName(): string
    {
        return 'password';
    }


    //RELATION AVEC LE MODEL MESURE
    public function mesures(){
        return $this->belongsTo(Mesure::class);
    }
    //RELATION AVEC LE MODEL DEVIS
    public function devis(){
        return $this->belongsTo(Devis::class);
    }

}
