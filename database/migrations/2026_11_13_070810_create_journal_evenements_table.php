<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('journal_evenements', function (Blueprint $table) {
            $table->id();

            $table->string('NumDossier');
            $table->string('type', 50);
            $table->string('titre');
            $table->text('description');
            $table->string('acteur')->nullable();

            $table->timestamps();

            $table->index('NumDossier');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('journal_evenements');
    }
};
