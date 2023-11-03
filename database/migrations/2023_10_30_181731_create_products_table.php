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
        Schema::create('products', function (Blueprint $table) {

            $table->id();
            $table->string('nombre_producto')->nullable();
            $table->foreignId('categoria_id')->nullable()->references('id')->on('categories');
            $table->foreignId('supplier_id')->nullable()->references('id')->on('suppliers');
            $table->string('cantidad_unidad')->nullable();
            $table->string('precio_unidad')->nullable();
            $table->integer('unidades_stock')->nullable();
            $table->string('unidades_orden')->nullable();
            $table->string('reorden_nivel')->nullable();
            $table->char('estado')->default(1);
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
