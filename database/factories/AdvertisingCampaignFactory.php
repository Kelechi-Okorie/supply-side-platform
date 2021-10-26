<?php

namespace Database\Factories;

use Carbon\Carbon;
use App\Models\AdvertisingCampaign;
use Illuminate\Database\Eloquent\Factories\Factory;

class AdvertisingCampaignFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = AdvertisingCampaign::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        return [
            'name' => $this->faker->sentence($nbWords = 5, $variableNbWords = true),
            'date_from' => $this->faker->date($format = 'Y-m-d', $max = 'now'),
            'date_to' => $this->faker->date($format = 'Y-m-d', $max = 'now'),
            'total_budget' => $this->faker->numberBetween($min = 1000, $max = 9000),
            'daily_budget' => $this->faker->numberBetween($min = 1000, $max = 9000),
            'created_at' => $this->faker->date($format = 'Y-m-d', $max = 'now'),
            'updated_at' => $this->faker->date($format = 'Y-m-d', $max = 'now')

        ];
    }
}
