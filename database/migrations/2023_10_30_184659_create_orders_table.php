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

            $table->date('fecha_orden')->nullable();
            $table->string('fecha_requirimiento')->nullable();
            $table->date('fecha_envio')->nullable();
            $table->string('vio_envia')->nullable();
            $table->string('transporte')->nullable();
            $table->date('nombre_envio')->nullable();
            $table->date('envio_direccion')->nullable();
            $table->date('envio_region')->nullable();
            $table->date('envio_codigo_postal')->nullable();
            $table->date('envio_pais')->nullable();


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
