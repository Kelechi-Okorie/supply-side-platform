<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AdvertisingCampaign;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AdvertisingCampaignController extends Controller
{
    public function index() {
        return AdvertisingCampaign::all();
    }

    public function edit(Request $request) {

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

        $file_names_to_store_to_db = Array();

        foreach($request->file('files') as $file) {
            if($file->isValid()) {
                $name = time() . Str::random(15) . '-' . $file->getClientOriginalExtension();
                Storage::disk('public')->put($name, $file);

                $file_names_to_store_to_db[] = $name;
            }
        }

        if($advertising_campaign->save()) {
            $response = [
                'msg' => 'Campaign created',
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
