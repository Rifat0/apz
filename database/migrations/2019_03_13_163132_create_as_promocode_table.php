<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAsPromocodeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('as_promocode', function (Blueprint $table) {
            $table->increments('promocode_id');
            $table->string('title',30);
            $table->string('code',10);
            $table->integer('amount');
            $table->string('publish_for',30);
            $table->integer('use_limit');
            $table->integer('used')->nullable();
            $table->date('expiry');
            $table->string('document')->nullable();
            $table->enum('status', ['active', 'deactive'])->default('active');
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
        Schema::dropIfExists('as_promocode');
    }
}
