<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use App\Models\AdvertisingCampaign;

class AdvertisingCampaignTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        AdvertisingCampaign::factory()->count(50)->create();
    }
}
