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
        Schema::create('imagen_colores', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('color_id');
            $table->string('url');
            $table->timestamps();

            $table->foreign('color_id')->references('id')->on('colores');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('imagen_colores');
    }
};
