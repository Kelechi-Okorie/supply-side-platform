<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdvertisingCampaignsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('advertising_campaigns', function (Blueprint $table) {
            $table->id();

            $table->string('name');

            $table->dateTime('date_from')->nullable();
            $table->dateTime('date_to')->nullable();

            $table->integer('total_budget')->nullable();
            $table->integer('daily_budget')->nullable();

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
        Schema::dropIfExists('advertising_campaigns');
    }
}
