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
        Schema::create('invoices_details', function (Blueprint $table) {
            $table->id();
            $table->string('product', 50)->nullable();
            $table->integer('count')->nullable();       // الكمية
            $table->decimal('price', 8, 2)->nullable();       // السعر
            $table->unsignedBigInteger('id_Invoice');
            $table->foreign('id_Invoice')->references('id')->on('invoices')->onDelete('cascade');
            $table->text('note')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices_details');
    }
};
