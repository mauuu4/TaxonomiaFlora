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
        Schema::create('TAX_IMAGENES', function (Blueprint $table) {
            $table->id('img_id');
            $table->foreignId('img_esp_id')->constrained('TAX_ESPECIES', 'esp_id')->onUpdate('cascade')->onDelete('restrict');
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
        Schema::dropIfExists('TAX_IMAGENES');
    }
};
