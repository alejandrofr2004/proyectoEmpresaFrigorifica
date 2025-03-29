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
        Schema::create('pedidos', function (Blueprint $table) {
            $table->id();
            //Almacena el id del cliente, que es una clave foránea de la tabla clientes
            $table->foreignId('cliente_id')->constrained('clientes')->onDelete('cascade');
            $table->decimal('total', 10, 2);
            $table->enum('estado', ['pendiente', 'enviado', 'entregado'])->default('pendiente');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pedidos');
    }
};
