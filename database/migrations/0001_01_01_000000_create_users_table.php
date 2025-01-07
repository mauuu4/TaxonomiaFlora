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
        Schema::create('USUARIOS', function (Blueprint $table) {
            $table->id('user_id');
            $table->string('user_nombre', 50);
            $table->string('user_apellido', 50);
            $table->string('user_email', 35)->unique();
            $table->string('user_password');
            $table->string('user_telefono', 10);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('USUARIOS');
    }
};
