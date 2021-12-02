<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEServicesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('e_services', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->index();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');	
            $table->longText('name')->nullable();
			$table->longText('description')->nullable();
            $table->double('price', 10, 2)->default(0);
            $table->double('discount_price', 10, 2)->nullable()->default(0);
            $table->enum('price_unit', ['hourly', 'fixed']);
            $table->longText('quantity_unit')->nullable()->default(null);
            $table->string('duration', 16)->nullable();
            $table->boolean('featured')->nullable()->default(0);
            $table->boolean('available')->nullable()->default(1);
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
        //Schema::drop('e_services');
    }
}
