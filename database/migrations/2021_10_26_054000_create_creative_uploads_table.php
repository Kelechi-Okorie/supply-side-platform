<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCreativeUploadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('creative_uploads', function (Blueprint $table) {
            $table->id();

            $table->foreignId('advertising_campaign_id')->unsigned()->nullable();
            $table->foreign('advertising_campaign_id')->references('id')->on('advertising_campaigns');
    
            $table->string('filepath');
            
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
        Schema::dropIfExists('creative_uploads');
    }
}
