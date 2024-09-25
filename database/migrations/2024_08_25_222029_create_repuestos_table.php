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
            $table->id();
            $table->string("categoria");
            $table->integer("cantidad")->default(0);
            $table->string("nombre");
            $table->string("descripcion");
            $table->binary("imagen")->nullable();
            $table->string("fabricante");
            $table->string("modelo");
            $table->foreign("categoria")->references("nombre")->on("categoria_repuestos");
            $table->timestamps();
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
