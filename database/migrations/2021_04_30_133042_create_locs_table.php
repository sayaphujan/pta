<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLocsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('locs', function (Blueprint $table) {
            $table->increments('loc_id');
            $table->string('loc_address1')->length(255);
            $table->string('loc_address2')->length(255)->nullable();
            $table->string('loc_lng')->nullable();
            $table->string('loc_lat')->nullable();
            $table->string('loc_img')->nullable();
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
        Schema::dropIfExists('locs');
    }
}
