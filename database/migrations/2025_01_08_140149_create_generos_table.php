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
        Schema::create('TAX_GENEROS', function (Blueprint $table) {
            $table->id('gene_id');
            $table->foreignId('gene_fam_id')->constrained('TAX_FAMILIAS', 'fam_id')->onUpdate('cascade')->onDelete('restrict');
            $table->string('gene_nombre', 50)->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('TAX_GENEROS');
    }
};
