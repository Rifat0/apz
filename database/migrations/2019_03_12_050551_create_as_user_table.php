<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAsUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('as_user', function (Blueprint $table) {
            $table->increments('user_id');
            $table->string('email',40)->unique();
            $table->string('username',200)->unique();
            $table->string('password',200);
            $table->string('confirmation_key',40);
            $table->string('sms_verify_key',6);
            $table->enum('sms_confirmed', ['Y', 'N']);
            $table->enum('confirmed', ['Y', 'N']);
            $table->string('password_reset_key',200);
            $table->enum('password_reset_confirmed', ['Y', 'N']);
            $table->datetime('password_reset_timestamp');
            $table->timestamp('register_date')->default(DB::raw('CURRENT_TIMESTAMP(0)'));
            $table->integer('user_role');
            $table->datetime('last_login');
            $table->enum('banned', ['Y', 'N'])->default('N');
            $table->enum('status_now', ['followup', 'followed']);
            $table->string('permission', 30)->nullable();
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
        Schema::dropIfExists('as_user');
    }
}
