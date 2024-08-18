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
        Schema::create('historial_estados', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_estado');
            $table->unsignedBigInteger('id_destinatario');
            $table->unsignedBigInteger('id_usuarios')->nullable();
            $table->date('fecha');
            $table->timestamps();

            $table->foreign('id_estado')->references('id')->on('estados');
            $table->foreign('id_destinatario')->references('id')->on('destinatarios');
            $table->foreign('id_usuarios')->references('id')->on('usuarios');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('historial_estados');
    }
};
