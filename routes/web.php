<?php

use App\Http\Controllers\Api\AdvertisingCampaignController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\AdvertisingCampaign;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [AdvertisingCampaignController::class, 'index']);


Route::get('/edit', function () {
    return view('campaign-edit');
});

Route::post('/test', function(Request $request) {
    ddd($request);
});

Route::get('/view/{id}', function(Request $request) {
    $advertising_campaign = AdvertisingCampaign::find($request->id);
    
    if($advertising_campaign == null) {
        return view('not-found');
    }



    $creative_uploads = $advertising_campaign->creativeUploads;

    // dd($creative_uploads);
    return view('campaign-view')
    ->with('advertising_campaign', $advertising_campaign)
    ->with('creative_uploads', $creative_uploads);

})->name('view-campaign');
