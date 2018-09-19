<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMembrosCelulasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('membros_celulas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->String('cpf');
            $table->String('email');
            $table->String('nome');
            $table->String('endereco');
            $table->bigInteger('celula_id')->unsigned();
            $table->timestamps();
            $table->unique('cpf');
            $table->engine = 'InnoDB';
            $table->charset = 'utf8';
            $table->collation = 'utf8_unicode_ci';
            $table->foreign('celula_id')->references('id')->on('celulas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        
        //$table->dropForeign('membros_celulas_celula_id_foreign');
        Schema::dropIfExists('membros_celulas');
    }
}
