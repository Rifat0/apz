<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAsSoftwareTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('as_software', function (Blueprint $table) {
            $table->increments('software_id');
            $table->string('software_title',100);
            $table->string('software_banner',130);
            $table->mediumtext('software_short_des');
            $table->longtext('software_long_des');
            $table->float('software_price', 10, 2);
            $table->mediumtext('software_tagline');
            $table->enum('software_status', ['Active', 'Inactive']);
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
        Schema::dropIfExists('as_software');
    }
}
