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
        Schema::create('TAX_REGISTROS', function (Blueprint $table) {
            $table->id('regis_id');
            $table->foreignId('esp_id')->constrained('TAX_ESPECIES', 'esp_id')->onUpdate('cascade')->onDelete('restrict');
            $table->foreignId('user_id')->constrained('USUARIOS', 'user_id')->onUpdate('cascade')->onDelete('restrict');
            $table->boolean('regis_estado')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('TAX_REGISTROS');
    }
};
