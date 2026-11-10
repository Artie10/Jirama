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
       Schema::create('mesures', function (Blueprint $table) {
    $table->id();

    $table->string('NumMesure')->unique();

    $table->string('NumDossier');

    $table->foreign('NumDossier')
        ->references('NumDossier')
        ->on('dossiers')
        ->onDelete('cascade');

    $table->string('autorisation');
    $table->date('date');
    $table->decimal('longueur', 8, 2);

    $table->decimal('latitude', 10, 7)->nullable();
    $table->decimal('longitude', 10, 7)->nullable();
    $table->text('adresse_localisation')->nullable();

    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mesures');
    }
};
