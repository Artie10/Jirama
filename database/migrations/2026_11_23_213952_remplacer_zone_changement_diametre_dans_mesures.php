<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   public function up(): void
{
    Schema::table('mesures', function (Blueprint $table) {
        $table->dropColumn('zone_changement_diametre');
        $table->unsignedSmallInteger('nombre_changements_diametre')->default(0);
    });
}

public function down(): void
{
    Schema::table('mesures', function (Blueprint $table) {
        $table->dropColumn('nombre_changements_diametre');
        $table->text('zone_changement_diametre')->nullable();
    });
}};
