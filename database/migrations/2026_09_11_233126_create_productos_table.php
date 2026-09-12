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
            $table->string('sku')->unique();
            $table->string('nombre');
            $table->string('descripcion_corta', 250);
            $table->text('descripcion_larga');
            $table->string('imagen');
            $table->unsignedInteger('precio_neto');
            $table->unsignedInteger('precio_de_venta');
            $table->unsignedInteger('stock_actual');
            $table->unsignedInteger('stock_alto');
            $table->unsignedInteger('stock_bajo');
            $table->unsignedInteger('stock_minimo');
            $table->timestamps();
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
