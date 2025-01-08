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
        Schema::create('TAX_FAMILIAS', function (Blueprint $table) {
            $table->id('fam_id');
            $table->foreignId('fam_reino_id')->constrained('TAX_REINOS', 'reino_id')->onUpdate('cascade')->onDelete('restrict');
            $table->string('fam_nombre', 50)->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('TAX_FAMILIAS');
    }
};
