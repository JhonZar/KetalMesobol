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
        Schema::create('existencias', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_producto');
            $table->unsignedBigInteger('id_usuario');
            $table->unsignedBigInteger('id_sucursal');
            $table->date('fecha');
            $table->integer('cantidad');
            $table->string('tipo_Transaccion',25);
            $table->timestamps();
            
            $table->foreign('id_producto')->references('id')->on('productos');
            $table->foreign('id_usuario')->references('id')->on('usuarios');
            $table->foreign('id_sucursal')->references('id')->on('sucursales');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('existencias');
    }
};
