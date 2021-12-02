<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEProvidersTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('e_providers', function (Blueprint $table) {
            $table->increments('id');
			$table->integer('user_id')->unsigned()->index();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');	
            $table->longText('name')->nullable();
            $table->integer('e_provider_type_id')->unsigned();
            $table->longText('description')->nullable();
            $table->string('phone', 50)->nullable();
			$table->string('address')->nullable();
			$table->string('email')->nullable();
			$table->string('website')->nullable();
			$table->string('logo')->nullable();
            $table->double('availability_range', 9, 2)->nullable()->default(0);
            $table->boolean('available')->nullable()->default(1);
            $table->boolean('featured')->nullable()->default(0);
            $table->boolean('accepted')->nullable()->default(0);
            $table->timestamps();
            $table->foreign('e_provider_type_id')->references('id')->on('e_provider_types')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('e_providers');
    }
}
