<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class JournalEvenement extends Model
{
    protected $table = 'journal_evenements';

    protected $fillable = [
        'NumDossier',
        'type',
        'titre',
        'description',
        'acteur',
    ];

    public function dossier(): BelongsTo
    {
        return $this->belongsTo(
            Dossier::class,
            'NumDossier',
            'NumDossier'
        );
    }
}
