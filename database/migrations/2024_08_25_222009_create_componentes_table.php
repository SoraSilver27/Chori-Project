
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
            $table->string("numero_de_serie")->default("Sin identificador");
            $table->binary("imagen")->nullable();
            $table->string("modelo");
            $table->string("descripcion")->default("Sin descripción");
            $table->enum("estado", ["En uso", "Disponible", "Indisponible"]);
            $table->unsignedBigInteger("ubicacion")->nullable();
            $table->integer("periodo_mantenimiento")->nullable();
            $table->date("ultimo_mantenimiento")->nullable();
            $table->date("proximo_mantenimiento")->nullable();
            $table->string("mantenimiento")->nullable();
            $table->string("mantenimiento_detallado")->nullable();
            $table->date("fecha_ingreso")->nullable();
            $table->foreign("ubicacion")->references("id")->on("maquinarias");
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
