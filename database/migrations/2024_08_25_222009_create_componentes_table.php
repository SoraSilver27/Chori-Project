
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
            $table->id("ubicacion")->default(null)->autoIncrement(false);
            $table->enum("estado", ["En uso", "Disponible", "Indisponible"]);
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
