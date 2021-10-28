<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AdvertisingCampaign;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class ImageController extends Controller
{
    //

    function showImages(REQUEST $request, $campaign_id) {

        $advertising_campaign = AdvertisingCampaign::find($campaign_id);
        $filepaths = $advertising_campaign->creativeUploads->pluck('filepath');
        $images = $filepaths->map(function($image) {
            return Storage::url($image);
        });
        
        return response()->json($images, 200);
    }

}
