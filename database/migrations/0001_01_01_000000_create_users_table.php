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
        Schema::create('permisos_usuarios', function (Blueprint $table) {
            $table->id('perus_id');
            $table->string('perus_detalle', 50);
        });

        Schema::create('tipos_usuarios', function (Blueprint $table) {
            $table->id('tipus_id');
            $table->foreignId('perus_id')->constrained('permisos_usuarios', 'perus_id')->onUpdate('restrict')->onDelete('restrict');
            $table->string('tipus_detalles', 50);
        });

        Schema::create('usuarios', function (Blueprint $table) {
            $table->id('user_id');
            $table->foreignId('tipus_id')->constrained('tipos_usuarios', 'tipus_id')->onUpdate('cascade')->onDelete('restrict');
            $table->string('user_nombre', 50);
            $table->string('user_apellido', 50);
            $table->string('user_email', 35)->unique();
            $table->string('user_password');
            $table->string('user_telefono', 10);
            $table->boolean('user_estado')->default(false);
            $table->timestamps();
        });

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
        //     $table->foreignId('user_id')->constrained('usuarios', 'user_id')->onUpdate('cascade')->onDelete('restrict');
        //     $table->timestamps();
        // });

        // Schema::create('permission_role', function (Blueprint $table) {
        //     $table->id();
        //     $table->foreignId('permission_id')->constrained()->onUpdate('cascade')->onDelete('restrict');
        //     $table->foreignId('role_id')->constrained()->onUpdate('cascade')->onDelete('restrict');
        //     $table->timestamps();
        // });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permisos_usuarios');
        Schema::dropIfExists('tipos_usuarios');
        Schema::dropIfExists('usuarios');
    }
};
