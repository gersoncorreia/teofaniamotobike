<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableEstoque extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estoque', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('entradas_id');
            $table->string('codigo_produto')->nullable();
            $table->integer('qtd')->nullable();
            $table->decimal('valor_total_estoque', 8, 2)->nullable();
            $table->timestamps();

            $table->foreign('entradas_id')->references('id')->on('entradas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('estoque');
    }
}
