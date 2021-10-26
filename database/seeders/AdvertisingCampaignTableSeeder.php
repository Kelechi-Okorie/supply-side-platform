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
        // DB::table('advertising_campaigns')->insert([
        //     'name' => 'Kelechi Okorie K',
        //     'date_from' => '2021-10-14',
        //     'date_to' => '2021-10-30',
        //     'total_budget' => 1000,
        //     'daily_budget' => 100,
        //     'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        //     'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        // ]);
    }
}
