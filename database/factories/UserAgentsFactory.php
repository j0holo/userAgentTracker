<?php

namespace Database\Factories;

use App\Models\UserAgents;
use GuzzleHttp\Psr7\Uri;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserAgentsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = UserAgents::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $url = $this->faker->url();
        $path = parse_url($url, PHP_URL_PATH);
        $query = parse_url($url, PHP_URL_QUERY);
        $fragment = parse_url($url, PHP_URL_FRAGMENT);
        return [
            'uri' => $path.$query.$fragment,
            'user_agent' => $this->faker->freeEmailDomain,
            'visited_at' => $this->faker->dateTimeBetween('-1 month'),
            'status_code' => $this->faker->numberBetween(200, 500),
        ];
    }
}
