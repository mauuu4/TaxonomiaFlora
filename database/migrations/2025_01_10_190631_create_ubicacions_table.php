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
        Schema::create('tax_mapas', function (Blueprint $table) {
            $table->id('mapa_id');
            $table->string('mapa_nombre', 50);
            $table->string('mapa_url', 255);
            $table->timestamps();
        });

        Schema::create('tax_ubicaciones', function (Blueprint $table) {
            $table->id('ubi_id');
            $table->foreignId('ubi_mapa_id')->constrained('tax_mapas', 'mapa_id')->onUpdate('cascade')->onDelete('restrict');
            $table->foreignId('ubi_esp_id')->constrained('tax_especies', 'esp_id')->onUpdate('cascade')->onDelete('restrict');
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
        Schema::dropIfExists('tax_ubicaciones');
        Schema::dropIfExists('tax_mapas');
    }
};
