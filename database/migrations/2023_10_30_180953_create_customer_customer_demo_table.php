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
        Schema::create('customer_customer_demo', function (Blueprint $table) {
            $table->id();

            $table->foreignId('customer_typer_id')->nullable()->references('id')->on('customer_demographics');

            $table->foreignId('customer_id')->nullable()->references('id')->on('customers');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customer_customer_demo');
    }
};
