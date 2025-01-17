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
        Schema::create('tax_registros', function (Blueprint $table) {
            $table->id('regis_id');
            $table->foreignId('esp_id')->constrained('tax_especies', 'esp_id')->onUpdate('cascade')->onDelete('restrict');
            $table->foreignId('user_id')->constrained('usuarios', 'user_id')->onUpdate('cascade')->onDelete('restrict');
            $table->string('regis_estado', 20);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tax_registros');
    }
};
