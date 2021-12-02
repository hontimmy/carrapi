<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBanksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banks', function (Blueprint $table) {
            $table->id();
			$table->integer('user_id')->unsigned()->index();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
			$table->string('trx')->nullable();
			$table->string('bank')->nullable();
            $table->string('code')->nullable();            
            $table->string('accountnum')->nullable();
			$table->string('accountname')->nullable();
			$table->string('accounttype')->nullable();
			$table->string('status')->nullable();
            $table->integer('default')->default(0);			
            $table->string('misc')->nullable(); 
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
        Schema::dropIfExists('banks');
    }
}
