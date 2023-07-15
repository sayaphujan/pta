<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trans', function (Blueprint $table) {
            $table->increments('trans_id');
            $table->string('trans_category')->length(50);
            $table->string('trans_destination')->length(50);
            $table->longtext('trans_phone')->length(13);
            $table->longtext('trans_note')->nullable();
            $table->string('price_volume')->length(255);
            $table->string('price_net')->length(255)->nullable();
            $table->string('price_deliv')->length(255)->nullable();
            $table->string('price_sum')->length(255)->nullable();
            $table->string('payment')->length(50)->nullable;
            $table->string('payment_status')->length(50)->nullable;
            $table->string('payment_photo')->length(50)->nullable;
            $table->string('trans_delivery')->length(2)->nullable;
            $table->string('user_id');
            $table->string('price_id');
            $table->string('loc_id');
            $table->string('order_id');
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
        Schema::dropIfExists('trans');
    }
}
