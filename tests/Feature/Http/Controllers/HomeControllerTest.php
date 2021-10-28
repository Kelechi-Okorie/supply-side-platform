<?php

namespace Tests\Feature\Http\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\AdvertisingCampaign;

class HomeControllerTest extends TestCase
{
    use RefreshDatabase;


    public function test_user_can_reach_the_index_page() {
        $this->withoutExceptionHandling();

        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_user_can_reach_the_create_new_advertising_campaign_page() {
        $this->withoutExceptionHandling();

        $response = $this->get('/campaign/new');

        $response->assertStatus(200);
    }

    public function test_user_can_reach_the_advertising_campaign_edit_page()
    {
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

        // check we can get the newly created advertising campaign for editing
        $response = $this->get('campaign/edit/' . $advertising_campaign->id);

        $response->assertStatus(200);


    }
        
        
}
