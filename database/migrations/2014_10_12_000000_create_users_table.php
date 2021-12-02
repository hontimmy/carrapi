<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
			$table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone', 24)->nullable()->unique()->default(null);
            $table->timestamp('phone_verified_at')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
			$table->string('bvn')->nullable();
			$table->string('bvname')->nullable();
            $table->string('bvnphone')->nullable();
			$table->string('bvndob')->nullable();
            $table->string('gender')->nullable();
			$table->string('address', 600)->nullable();
            $table->string('city')->nullable();
			$table->string('state')->nullable();
            $table->string('country')->default('Nigeria');  
            $table->char('api_token', 60)->unique()->nullable()->default(null);
            $table->string('device_token')->nullable();
            $table->string('mac_adddress')->nullable();
            $table->string('ip_address')->nullable();
            $table->string('acctype')->nullable();
            $table->string('referral')->nullable();
		    $table->string('kycverify')->default(0);
			$table->longText('about')->nullable();
			$table->string('image')->nullable();          
            $table->string('sociallink', 3000)->nullable();
            $table->string('creditcard', 1000)->nullable();
			$table->string('taxinfo', 1000)->nullable();
			$table->longText('skillset')->nullable();			
			$table->string('balance')->default(0);
			$table->string('intbalance')->default(0);
            $table->integer('notify_admin')->default(0);
            $table->integer('newsletter')->default(1);
            $table->integer('unusual')->default(1);
            $table->string('save_activity')->default('TRUE');
			$table->string('status')->default('active');
            $table->timestamp('trial_ends_at')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
