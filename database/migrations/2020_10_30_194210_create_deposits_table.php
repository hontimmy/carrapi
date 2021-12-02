<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDepositsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deposits', function (Blueprint $table) {
			$table->Increments('id');
			$table->string('trx')->unique()->nullable();
			$table->string('ref')->nullable();
			$table->integer('user_id')->unsigned()->index();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');	
			$table->integer('method')->nullable();
			$table->string('gateway')->nullable();
			$table->string('currency')->nullable();
			$table->string('amount')->nullable();
			$table->string('description')->nullable();
            $table->string('misc')->nullable();            
            $table->string('status')->nullable();            
            $table->string('remarks')->nullable();
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
        Schema::dropIfExists('deposits');
    }
}
