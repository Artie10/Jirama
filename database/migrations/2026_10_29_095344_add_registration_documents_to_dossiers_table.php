<?php
//PHOTOS ET CIN
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
          Schema::table('dossiers', function (Blueprint $table) {
        $table->string('photo_identite')->nullable();
        $table->string('cin_document')->nullable();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
         Schema::table('dossiers', function (Blueprint $table) {
        $table->dropColumn([
            'photo_identite',
            'cin_document']);
    });
    }
};
