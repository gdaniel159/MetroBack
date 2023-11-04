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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('fecha_orden')->nullable();
            $table->string('fecha_requerimiento')->nullable();
            $table->string('fecha_envio')->nullable();
            $table->string('via_envio')->nullable();
            $table->string('transporte')->nullable();
            $table->string('nombre_envio')->nullable();
            $table->string('envio_direccion')->nullable();
            $table->string('envio_region')->nullable();
            $table->string('envio_codigo_postal')->nullable();
            $table->string('envio_pais')->nullable();
            $table->foreignId('customers_id')->nullable()->references('id')->on('customers');
            $table->foreignId('employee_id')->nullable()->references('id')->on('employees');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
