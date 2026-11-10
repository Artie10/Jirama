<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('mesures', function (Blueprint $table) {

            // Longueur avec décimales
            $table->decimal('longueur', 8, 2)->change();

            // Localisation du site
            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();
            $table->text('adresse_localisation')->nullable();

        });
    }

    public function down(): void
    {
        Schema::table('mesures', function (Blueprint $table) {

            $table->dropColumn([
                'latitude',
                'longitude',
                'adresse_localisation'
            ]);

        });
    }
};
