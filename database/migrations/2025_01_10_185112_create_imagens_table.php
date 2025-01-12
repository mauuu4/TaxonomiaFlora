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
        Schema::create('tax_imagenes', function (Blueprint $table) {
            $table->id('img_id');
            $table->foreignId('img_esp_id')->constrained('tax_especies', 'esp_id')->onUpdate('cascade')->onDelete('restrict');
            $table->string('img_ruta');
            $table->text('img_descripcion')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tax_imagenes');
    }
};
