<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  public function up(): void
{
    Schema::table('mesures', function (Blueprint $table) {
        $table->string('plan_image')->nullable();
    });
}

public function down(): void
{
    Schema::table('mesures', function (Blueprint $table) {
        $table->dropColumn('plan_image');
    });
}
};
