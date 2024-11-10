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
        Schema::create('rol_permiso', function (Blueprint $table) {
            $table->id('id_rol_permiso');
            $table->unsignedBigInteger('id_roles'); 
            $table->unsignedBigInteger('id_permisos'); 

            // Actualizar la referencia a la columna correcta
            $table->foreign('id_roles')->references('id_roles')->on('roles')->onDelete('cascade');
            $table->foreign('id_permisos')->references('id_permisos')->on('permisos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rol_permiso');
    }
};
