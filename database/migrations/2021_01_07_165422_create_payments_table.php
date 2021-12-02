<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePaymentsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->index();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');	
            $table->double('amount', 10, 2)->default(0);
            $table->string('description', 255)->nullable();
			$table->integer('eservice_id')->unsigned();
            $table->integer('payment_method_id')->unsigned();
            $table->integer('payment_status_id')->unsigned();
            $table->foreign('payment_status_id')->references('id')->on('payment_statuses')->onDelete('cascade')->onUpdate('cascade');
            $table->string('details')->default('');
            $table->text('extra')->nullable();
            $table->string('status')->default('');
            $table->integer('misc')->default(0);
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
        Schema::drop('payments');
    }
}
