<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePppconnectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pppconnections', function (Blueprint $table) {
            $table->id();
            $table->integer("device_id");
            $table->string("name");
            $table->string("service");
            $table->string("caller-id");
            $table->string("address");
            $table->string("uptime");
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
        Schema::dropIfExists('pppconnections');
    }
}
