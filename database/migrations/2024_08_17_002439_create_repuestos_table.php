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
        Schema::create('repuestos', function (Blueprint $table) {
            $table->id("ID");
            $table->text("Categoria");
            $table->integer("Cantidad");
            $table->text("Nombre");
            $table->text("Descripcion");
            $table->binary("Imagen");
            $table->text("Fabricante");
            $table->text("Modelo");
            $table->foreign("Categoria")->references("Nombre")->on("categoria_repuestos");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('repuestos');
    }
};
