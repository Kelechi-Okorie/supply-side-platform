<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdvertisingCampaign extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'date_from', 'date_to', 'total_budget', 'daily_budget'
    ];

    public function creativeUploads() {
        return $this->hasMany(CreativeUpload::class);
    }
}
