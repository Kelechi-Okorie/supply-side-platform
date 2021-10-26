<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AdvertisingCampaignResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'date_from' => $this->date_from,
            'date_to' => $this->date_to,
            'total_budget' => $this->total_budget,
            // 'daily_budget' => $this->daily_budget
        ];
        return parent::toArray($request);
    }
}
