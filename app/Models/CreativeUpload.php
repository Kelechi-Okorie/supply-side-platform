<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CreativeUpload extends Model
{
    use HasFactory;

    public function AdvertisingCampaign() {
        return $this->belongsTo(AdvertisingCampaign::class);
    }
}
