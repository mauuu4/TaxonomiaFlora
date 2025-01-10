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
        Schema::create('TAX_UBICACIONES', function (Blueprint $table) {
            $table->id('ubi_id');
            // $table->foreignId('ubi_mapa_id')->constrained('TAX_MAPAS', 'mapa_id')->onUpdate('cascade')->onDelete('restrict');
            $table->foreignId('ubi_esp_id')->constrained('TAX_ESPECIES', 'esp_id')->onUpdate('cascade')->onDelete('restrict');
            $table->double('ubi_longitud');
            $table->double('ubi_latitud');
            $table->string('ubi_region', 30);
            $table->text('ubi_descripcion')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('TAX_UBICACIONES');
    }
};
