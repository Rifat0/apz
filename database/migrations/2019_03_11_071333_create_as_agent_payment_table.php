<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAsAgentPaymentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('as_agent_payment', function (Blueprint $table) {
            $table->increments('agent_payment_id');
            $table->integer('user_id');
            $table->integer('agent_id');
            $table->enum('payment_type', ['receive', 'withdraw']);
            $table->integer('subscribe_id');
            $table->string('subscribe_payment_id',30);
            $table->dateTime('payment_date');
            $table->string('payment_method',30);
            $table->decimal('payment_amount',20,2);
            $table->decimal('payment_charge',20,2);
            $table->mediumText('payment_details');
            $table->string('pay_document')->nullable();
            $table->mediumText('pay_note')->nullable();
            $table->dateTime('pay_date')->nullable();
            $table->enum('payment_status', ['paid', 'due', 'cancel'])->default('cancel');
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
        Schema::dropIfExists('as_agent_payment');
    }
}
