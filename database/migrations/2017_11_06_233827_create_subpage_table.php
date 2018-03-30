<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubpageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subpages', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->boolean('titleVisibility');
            $table->text('description')->nullable(true);
            $table->boolean('descVisibility');
            $table->enum('type', ['text', 'bibtex', 'map', 'contact']);
            $table->longText('content')->nullable(true);
            $table->integer('page_id');
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
        Schema::dropIfExists('subpages');
    }
}
