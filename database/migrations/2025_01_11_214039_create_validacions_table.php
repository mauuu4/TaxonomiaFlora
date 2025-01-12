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
        Schema::create('tax_validaciones', function (Blueprint $table) {
            $table->id('valid_id');
            $table->foreignId('valid_regis_id')->constrained('tax_registros', 'regis_id')->onUpdate('cascade')->onDelete('restrict');
            $table->integer('valid_user_id')->unsigned();
            $table->date('valid_fecha');
            $table->text('valid_comentarios');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tax_validaciones');
    }
};
