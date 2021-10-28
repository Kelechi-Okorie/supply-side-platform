<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AdvertisingCampaign;

class HomeController extends Controller
{
    //

    function index(Request $request) {
        return view('campaign-list');
    }

    function new(Request $request) {
        return view('campaign-edit');
    }

    function edit(Request $request, $id) {
        $advertising_campaign = AdvertisingCampaign::find($id);
        $creative_uploads = $advertising_campaign->creativeUploads;
    
        return view('campaign-edit')
            ->with('advertising_campaign', $advertising_campaign)
            ->with('creative_uploads', $creative_uploads);
    
    }
}
