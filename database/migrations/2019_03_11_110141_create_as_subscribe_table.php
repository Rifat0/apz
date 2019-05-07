<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAsSubscribeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('as_subscribe', function (Blueprint $table) {
            $table->increments('subscribe_id');
            $table->integer('user_id');
            $table->integer('agent_id');
            $table->integer('software_id');
            $table->integer('software_variation_id');
            $table->enum('subscribe_type', ['software', 'service', 'plugins']);
            $table->string('plugins_id');
            $table->dateTime('subscribe_date');
            $table->string('subscribe_billing_trams',10);
            $table->string('subscribe_cupon',30);
            $table->enum('subscribe_status', ['active', 'inactive', 'cancel', 'expire']);
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
        Schema::dropIfExists('as_subscribe');
    }
}
