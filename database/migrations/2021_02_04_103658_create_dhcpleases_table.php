<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDhcpleasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dhcpleases', function (Blueprint $table) {
            $table->id();
            $table->string("device_id")->default(0);
            $table->string("address")->default(0);
            $table->string("mac_address")->default(0);
            $table->string("client_id")->default(0);
            $table->string("status")->default(0);
            $table->string("expires_after")->default(0);
            $table->string("last_seen")->default(0);
            $table->string("active_address")->default(0);
            $table->string("active_mac_address")->default(0);
            $table->string("active_client_id")->default(0);
            $table->string("host_name")->default(0);
            $table->string("dynamic")->default(0);
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
        Schema::dropIfExists('dhcpleases');
    }
}
