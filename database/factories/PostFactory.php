<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Nette\Utils\Random;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $city = ['Yangon', 'Mandalay', 'TaungGyi', 'PyinOoLwin', 'Bago', 'MyitKyiNar'];
        return [
            'title' => $this->faker->text(20),
            'description' => $this->faker->text(500),
            'price' => rand(2000, 5000),
            'rating' => rand(0, 5),
            'city' => $city[array_rand($city)],
        ];
    }
}
