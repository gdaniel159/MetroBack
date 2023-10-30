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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_compañia')->nullable();
            $table->string('nombre_contacto')->nullable();
            $table->string('titulo_contacto')->nullable();
            $table->string('direccion')->nullable();
            $table->string('cuidad')->nullable();
            $table->string('region')->nullable();
            $table->string('codigo_postal')->nullable();
            $table->string('pais')->nullable();
            $table->integer('telefono')->digits(10);
            $table->string('fax')->nullable();
            

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
