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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();

            $table->string('nombre')->nullable();
            $table->string('apellido')->nullable();
            $table->string('titulo')->nullable();
            $table->string('titulo_de_cortesia')->nullable();
            $table->string('fecha_nacimiento')->nullable();
            $table->date('fecha_contrato')->nullable();
            $table->string('direccion')->nullable();
            $table->string('cuidad')->nullable();
            $table->string('region')->nullable();
            $table->string('codigo_postal')->nullable();
            $table->string('pais')->nullable();
            $table->integer('telefono')->digits(10);
            $table->string('extension')->nullable();
            $table->text('foto')->nullable();
            $table->string('notas')->nullable();
            $table->string('reportes')->nullable();
            $table->string('foto_path')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
