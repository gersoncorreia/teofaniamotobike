<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableVendas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('clientes_id')->nullable();
            $table->integer('desconto')->nullable();
            $table->integer('porcentagem')->nullable();
            $table->decimal('valor_venda', 8, 2);
            $table->decimal('valor_pagamento', 8, 2);
            $table->enum('tipo_pagamento',['dinheiro','debito','credito'])->nullable();
            $table->enum('status',['pendente','pago','cancelado'])->nullable();
            $table->timestamps();

           
            $table->foreign('clientes_id')->references('id')->on('clientes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vendas');
    }
}
