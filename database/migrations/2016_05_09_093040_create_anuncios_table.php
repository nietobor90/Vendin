<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnunciosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('anuncios', function(Blueprint $table)
		{
			$table->increments('id');
                        $table->string('titulo');
                        $table->string('descripcion');
                        $table->float('precio');
                        $table->timestamps();
                        $table->integer('categoria_id')->unsigned();
                        $table->foreign('categoria_id')->references('id')->on('categorias');
//                        $table->integer('user_id')->unsigned();
//                        $table->foreign('user_id')->references('id')->on('user');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('anuncios');
	}

}
