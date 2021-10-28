<?php

namespace Tests\Feature\Http\Controllers\Api;

use App\Models\AdvertisingCampaign;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AdvertisingCampaignControllerTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_user_can_get_list_of_all_advertising_campaigns()
    {
        $this->withoutExceptionHandling();

        // we want to hit the /api/v1/advertising-campaign endpoint
        $response = $this->get('/api/v1/advertising-campaign');

        $response->assertStatus(200);
    }

    public function test_users_can_create_advertisign_campaigns() {
        $this->withoutExceptionHandling();


        // we want to hit the /api/v1/advertising-campaign with a post request
        $response = $this->post('/api/v1/advertising-campaign', [
            'name' => 'first advertising campaign',
            'date_from' => '2021-05-05',
            'date_to' => '2021-07-07',
            'total_budget' => 58595.89,
            'daily_budget' => 858.85,
        ]);

        $response->assertStatus(200);

        // we got the find the last advertising_campaign created
        $advertising_campaign = AdvertisingCampaign::first();

        // we only have one advertising_campaign in the database
        $this->assertEquals(1, AdvertisingCampaign::count());

        $this->assertEquals('first advertising campaign', $advertising_campaign->name);
        $this->assertEquals('2021-05-05', $advertising_campaign->date_from);
        $this->assertEquals('2021-07-07', $advertising_campaign->date_to);
        $this->assertEquals(58595.89, $advertising_campaign->total_budget);
        $this->assertEquals(858.85, $advertising_campaign->daily_budget);
    }
}
