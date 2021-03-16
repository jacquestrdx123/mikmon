<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDevicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('devices', function (Blueprint $table) {
            $table->id();
            $table->string('ip');
            $table->integer('status')->default(4);
            $table->string('current_status')->default("Online");
            $table->integer('location_id');
            $table->string('username');
            $table->string('password');
            $table->string('snmp_community');
            $table->string('devicetype')->default('ping');
            $table->string('uptime')->default('0');
            $table->string('description');
            $table->string("fan-mode")->default(0);
            $table->string("use-fan")->default(0);
            $table->string("active-fan")->default(0);
            $table->string("cpu-overtemp-check")->default(0);
            $table->string("cpu-overtemp-threshold")->default(0);
            $table->string("cpu-overtemp-startup-delay")->default(0);
            $table->string("voltage")->default(0);
            $table->string("current")->default(0);
            $table->string("temperature")->default(0);
            $table->string("used_memory")->default(0);
            $table->string("total_memory")->default(0);
            $table->string("cpu-temperature")->default(0);
            $table->string("power-consumption")->default(0);
            $table->string("fan1-speed")->default(0);
            $table->string("fan2-speed")->default(0);
            $table->string("model")->default(0);
            $table->string("serial-number")->default(0);
            $table->string("firmware-type")->default(0);
            $table->string("factory-firmware")->default(0);
            $table->string("current-firmware")->default(0);
            $table->string("upgrade-firmware")->default(0);
            $table->timestamp('update_started')->default(\DB::raw('CURRENT_TIMESTAMP'));

            $table->timestamp('last_online')->useCurrent();
            $table->timestamp('last_offline')->useCurrent();
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
        Schema::dropIfExists('devices');
    }
}
