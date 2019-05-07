<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAsPluginsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('as_plugins', function (Blueprint $table) {
            $table->increments('plugin_id');
            $table->enum('plugins_type', ['public', 'private', 'custom']);
            $table->string('plugins_image');
            $table->enum('plugins_billing', ['free', 'monthly', 'onetime', 'yearly']);
            $table->string('plugins_name');
            $table->string('plugins_unique_name')->unique();
            $table->string('plugins_page');
            $table->string('plugins_page_file');
            $table->enum('plugins_page_required', ['true', 'false']);
            $table->mediumtext('plugins_details');
            $table->string('plugins_software_id');
            $table->float('plugins_price', 10, 2);
            $table->dateTime('plugins_published_date');
            $table->dateTime('plugins_update_date');
            $table->dateTime('plugins_unpublished_date');
            $table->string('plugins_version');
            $table->enum('plugins_update_type', ['auto', 'manual']);
            $table->enum('plugins_status', ['active', 'inactive', 'disable']);
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
        Schema::dropIfExists('as_plugins');
    }
}
