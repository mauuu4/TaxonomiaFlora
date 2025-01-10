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
        // Schema::create('roles', function (Blueprint $table) {
        //     $table->id();
        //     $table->string('name')->unique();
        //     $table->string('description')->nullable();
        //     $table->timestamps();
        // });

        // Schema::create('permissions', function (Blueprint $table) {
        //     $table->id();
        //     $table->string('name')->unique();
        //     $table->string('description')->nullable();
        //     $table->timestamps();
        // });

        // Schema::create('role_user', function (Blueprint $table) {
        //     $table->id();
        //     $table->foreignId('role_id')->constrained()->onUpdate('cascade')->onDelete('restrict');
        //     $table->foreignId('user_id')->constrained('USUARIOS', 'user_id')->onUpdate('cascade')->onDelete('restrict');
        //     $table->timestamps();
        // });

        // Schema::create('permission_role', function (Blueprint $table) {
        //     $table->id();
        //     $table->foreignId('permission_id')->constrained()->onUpdate('cascade')->onDelete('restrict');
        //     $table->foreignId('role_id')->constrained()->onUpdate('cascade')->onDelete('restrict');
        //     $table->timestamps();
        // });

        Schema::create('USUARIOS', function (Blueprint $table) {
            $table->id('user_id');
            $table->string('user_nombre', 50);
            $table->string('user_apellido', 50);
            $table->string('user_email', 35)->unique();
            $table->string('user_password');
            $table->string('user_telefono', 10);
            $table->boolean('user_estado')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Schema::dropIfExists('roles');
        // Schema::dropIfExists('permissions');
        // Schema::dropIfExists('role_user');
        // Schema::dropIfExists('permission_role');
        Schema::dropIfExists('USUARIOS');
    }
};
