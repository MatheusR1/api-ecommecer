<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grupo_cidades', function (Blueprint $table) {
            $table->id();
            $table->string('nome', 255);
            $table->foreignId('id_cidade')->references('id')->on('cidades');
            $table->foreignId('id_campanha')->references('id')->on('campanhas');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('grupo_cidades');
    }
};
