<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('facturas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pedido_id')->constrained('pedidos')->onDelete('cascade');
            $table->string('numero_factura')->unique();
            $table->date('fecha_emision');
            $table->decimal('total', 10, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('facturas');
    }
};
