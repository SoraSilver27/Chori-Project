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
        Schema::create('componentes', function (Blueprint $table) {
            $table->id();
            $table->string("nombre");
            $table->string("numero_de_serie");
            $table->binary("imagen")->nullable(true);
            $table->string("modelo");
            $table->string("descripcion")->nullable(true);
            $table->id("ubicacion")->autoIncrement(false);
            $table->enum("estado", ["en_uso", "disponible", "indisponible"]);
            $table->foreign("ubicacion")->references("id")->on("maquinarias"); //hay que cambiar
            $table->timestamps();
        });
    }



    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('componentes');
    }
};
