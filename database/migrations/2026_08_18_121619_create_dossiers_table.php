<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('dossiers', function (Blueprint $table) {
            $table->id();
            $table->string('NumDossier',)->unique();
            $table->string('Nom');
            $table->string('Mail')->unique();
            $table->integer('Cin')->unique();
            $table->string('telephone', 20)->unique();
            $table->string('password');
            $table->string('Dmd_img');
            $table->string('residence_img');
            $table->string('autorisation_img')->nullable();
            $table->string('statut');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dossiers');
    }
};
