<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AdvertisingCampaign;
use App\Models\CreativeUpload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AdvertisingCampaignController extends Controller
{
    public function index() {
        return AdvertisingCampaign::all();
    }

    public function store(Request $request) {

        $this->validate($request, [
            'name' => 'required'
        ]);

        $name = $request->input('name');
        $date_from = $request->input('date_from');
        $date_to = $request->input('date_to');
        $total_budget = $request->input('total_budget');
        $daily_budget = $request->input('daily_budget');


        $advertising_campaign = new AdvertisingCampaign([
            'name' => $name,
            'date_from' => $date_from,
            'date_to' => $date_to,
            'total_budget' => $total_budget,
            'daily_budget' => $daily_budget
        ]);



        if($advertising_campaign->save()) {
            foreach($request->files as $file) {
                if($file->isValid()) {
                    $name = time() . '-' . Str::random(15) . '.' . $file->getClientOriginalExtension();
                    Storage::disk('public')->put($name, file_get_contents($file->getRealPath()));

                    $creative_upload = new CreativeUpload();
                    $creative_upload->campaign_id = $advertising_campaign->id;
                    $creative_upload->filepath = $name;

                    $creative_upload->save();
    
                }
            }
    
            $response = [
                'msg' => 'Successful! Campaign created',
                'campaign' => $advertising_campaign
            ];
    
            return response()->json($response, 200);    
        }

        $response = [
            'msg' => 'An error occured',
            'campaign' => $advertising_campaign
        ];

        return response()->json($response, 404);    

    }
}   
