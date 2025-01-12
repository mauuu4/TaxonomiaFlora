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
        Schema::create('tax_especies', function (Blueprint $table) {
            $table->id('esp_id');
            $table->foreignId('esp_gene_id')->constrained('tax_generos', 'gene_id')->onUpdate('cascade')->onDelete('restrict');
            $table->string('esp_nombre_cientifico', 50);
            $table->string('esp_nombre_comun', 50);
            $table->text('esp_descripcion')->nullable();
            $table->boolean('esp_estado_valid')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tax_especies');
    }
};
