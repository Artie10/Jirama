<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Auth\MustVerifyEmail as MustVerifyEmailContract;
use Illuminate\Auth\MustVerifyEmail;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;

use App\Models\Mesure;

class Dossier extends Authenticatable implements MustVerifyEmailContract
{
    use HasFactory, MustVerifyEmail, Notifiable;

    protected $table = 'dossiers';

    protected $fillable = [
        'NumDossier',
        'Nom',
        'Mail',
        'Cin',
        'telephone',
        'password',
        'Dmd_img',
        'residence_img',
        'autorisation_img',
        'statut',
        'photo_identite',
        'cin_document',
        'statut_demandeur',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function getAuthPasswordName(): string
    {
        return 'password';
    }

    public function getEmailForVerification(): string
    {
        return $this->Mail;
    }

    // Utiliser la colonne Mail comme adresse de notification
    public function routeNotificationForMail($notification = null): string
    {
        return $this->Mail;
    }

    // Relation : un dossier peut avoir plusieurs mesures
    public function mesures(): HasMany
    {
        return $this->hasMany(
            Mesure::class,
            'NumDossier',
            'NumDossier'
        );
    }

    // Relation : un dossier peut avoir plusieurs événements dans le journal
    public function evenements()
{
    return $this->hasMany(
        \App\Models\JournalEvenement::class,
        'NumDossier',
        'NumDossier'
    );
}
}
