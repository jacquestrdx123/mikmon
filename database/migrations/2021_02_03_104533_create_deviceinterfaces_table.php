<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeviceinterfacesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deviceinterfaces', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 255)->default('0');
            $table->string('default_name', 255)->default('0');
            $table->string('mac_address', 45)->default('none');
            $table->string('type', 255)->default('none');
            $table->string('internet', 255)->default('0');
            $table->string('last_link_down_time', 45)->default(0);
            $table->string('last_link_up_time', 45)->default(0);
            $table->string('mtu', 45)->default(0);
            $table->string('actual_mtu', 45)->default(0);
            $table->string('running', 45)->default(0);
            $table->string('previous_running_state', 64)->default(0);
            $table->string('link_speed', 64)->default('0');
            $table->string('previous_link_speed', 64);
            $table->string('disabled', 45)->default(0);
            $table->integer('device_id')->default(0);
            $table->integer('txspeed')->default('0');
            $table->integer('rxspeed')->default('0');
            $table->integer('maxtxspeed')->default(0);
            $table->integer('maxrxspeed')->default(0);
            $table->integer('threshholds_today')->default('0');
            $table->integer('threshhold')->default('100');
            $table->integer('acknowledged')->default('0');
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
        Schema::dropIfExists('deviceinterfaces');
    }
}
