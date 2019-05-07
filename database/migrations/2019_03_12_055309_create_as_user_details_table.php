<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAsUserDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('as_user_details', function (Blueprint $table) {
            $table->increments('id_user_details');
            $table->integer('user_id');
            $table->integer('domain_id');
            $table->integer('agent_id');
            $table->integer('added_by');
            $table->integer('store_id');
            $table->string('first_name',50);
            $table->string('last_name',50);
            $table->string('dob',20);
            $table->string('phone',20);
            $table->string('address',200);
            $table->string('permanent_address',200);
            $table->string('country',20);
            $table->string('country_code',20);
            $table->mediumtext('zone');
            $table->mediumtext('area');
            $table->string('profile_image',100);
            $table->string('nid_card',50);
            $table->string('attach',100);
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
        Schema::dropIfExists('as_user_details');
    }
}
