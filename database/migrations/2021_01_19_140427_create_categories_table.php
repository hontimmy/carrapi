<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCategoriesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id');
            $table->foreign('parent_id')->references('id')->on('categories')->onDelete('set null')->onUpdate('set null');
            $table->longText('name')->nullable();
            $table->string('color', 36);
            $table->longText('description')->nullable();
            $table->integer('order')->nullable()->default(0);
            $table->boolean('featured')->nullable()->default(0);
            $table->integer('parent_id')->nullable()->unsigned();
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
        Schema::drop('categories');
    }
}
