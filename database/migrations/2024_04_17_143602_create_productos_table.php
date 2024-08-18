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
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_talla');
            $table->unsignedBigInteger('id_colores');
            $table->unsignedBigInteger('id_modelo');
            $table->unsignedBigInteger('id_sucursal');//agregado recien 19-5-24 (esta parte debe llenarse con la session al iniciar session el usuario )
            $table->string('nombre');
            $table->decimal('precio_estimado');
            $table->decimal('precio_vendedor');
            $table->integer('cantidad');
            $table->string('descripcion');
            $table->enum('tipo',['cotizacion','venta','pedido']);
            $table->timestamps();

            $table->foreign('id_modelo')->references('id')->on('modelos');
            $table->foreign('id_colores')->references('id')->on('colores');
            $table->foreign('id_talla')->references('id')->on('tallas');
            $table->foreign('id_sucursal')->references('id')->on('sucursales');
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};
