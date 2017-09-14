<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMediaTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('media', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type', 20);
            $table->string('titre');
            $table->text('texte');
            $table->string('repertoire', 40);
            $table->string('fichier');
            $table->string('url')->nullable();
            $table->nullableTimestamps();

            $table->engine = 'InnoDB';
        });

        Schema::create('media_publication', function (Blueprint $table) {
            $table->integer('media_id')->unsigned();
            $table->integer('publication_id')->unsigned();
            $table->string('publication_type');

            $table->primary(['media_id', 'publication_id', 'publication_type'], 'media_publication_index_unique');
            $table->foreign('media_id')->references('id')->on('media')->onDelete('cascade');

            $table->engine = 'InnoDB';
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('media');
        Schema::drop('media_publication');
    }
}
