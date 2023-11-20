<?php

namespace Database\Factories;

use App\Traits\UnsplashTrait;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<Store>
 */
class ArticleFactory extends Factory
{

    use UnsplashTrait;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->sentence(2),
            'content' => $this->faker->text(255),
            'image' => $this->getUnsplashImage(),
        ];
    }
}
