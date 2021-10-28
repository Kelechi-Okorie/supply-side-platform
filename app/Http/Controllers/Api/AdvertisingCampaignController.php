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
        $advertising_campaign = AdvertisingCampaign::all();

        $data = [
            'msg' => 'Success!',
            'data' => $advertising_campaign
        ];

        return response()->json($data, 200);
    
    }

    public function store(Request $request) {

        $this->validate($request, [
            'name' => 'required'
        ]);

        $is_edit = $request->input('is_edit');
        $id = $request->input('id');

        $name = $request->input('name');
        $date_from = $request->input('date_from');
        $date_to = $request->input('date_to');
        $total_budget = $request->input('total_budget');
        $daily_budget = $request->input('daily_budget');

        if($is_edit == '1') {
            $advertising_campaign = AdvertisingCampaign::find($id);
        } else {
            $advertising_campaign = new AdvertisingCampaign();
        }

        $advertising_campaign->name = $name;
        $advertising_campaign->date_from = $date_from;
        $advertising_campaign->date_to = $date_to;
        $advertising_campaign->total_budget = $total_budget;
        $advertising_campaign->daily_budget = $daily_budget;




        if($advertising_campaign->save()) {
            foreach($request->files as $file) {
                if($file->isValid()) {
                    $path = time() . '-' . Str::random(15) . '.' . $file->getClientOriginalExtension();
                    Storage::disk('public')->put($path, file_get_contents($file->getRealPath()));

                    $creative_upload = new CreativeUpload();
                    $creative_upload->filepath = $path;
                    $creative_upload->advertising_campaign_id = $advertising_campaign->id;

                    $creative_upload->save();
    
                }
            }
    
            $response = [
                'msg' => 'Successful!',
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
