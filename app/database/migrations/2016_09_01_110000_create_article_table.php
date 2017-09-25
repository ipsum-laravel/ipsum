<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateArticleTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('article', function (Blueprint $table) {
            $table->increments('id');
            $table->string('slug')->unique();
            $table->string('type', 20)->nullable();
            $table->tinyInteger('etat')->unsigned()->default(0);
            $table->integer('categorie_id')->unsigned()->index();
            $table->integer('media_id')->nullable();
            $table->string('titre');
            $table->text('extrait');
            $table->text('texte');
            $table->text('texte_md');
            $table->string('seo_title')->nullable();
            $table->text('seo_description')->nullable();
            $table->nullableTimestamps();
        });

        Schema::create('article_categorie', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nom');
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('article');
        Schema::drop('article_categorie');
    }
}
