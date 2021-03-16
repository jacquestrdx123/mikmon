<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNeighborsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('neighbors', function (Blueprint $table) {
            $table->id();
            $table->integer('device_id')->default(0);
            $table->string("interface")->default(0);
            $table->string("address")->default(0);
            $table->string('mac_address')->default(0);
            $table->string("address4")->default(0);
            $table->string("identity")->default(0);
            $table->string("platform")->default(0);
            $table->string("version")->default(0);
            $table->string("unpack")->default(0);
            $table->string("age")->default(0);
            $table->string("uptime")->default(0);
            $table->string("software_id")->default(0);
            $table->string("board")->default(0);
            $table->string("ipv6")->default(0);
            $table->string("interface_name")->default(0);
            $table->string("system_caps")->default(0);
            $table->string("system_caps_enabled")->default(0);
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
        Schema::dropIfExists('neighbors');
    }
}
