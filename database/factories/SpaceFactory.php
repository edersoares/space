<?php

declare(strict_types=1);

namespace Dex\Laravel\Space\Database\Factories;

use Dex\Laravel\Space\Models\Space;
use Illuminate\Database\Eloquent\Factories\Factory;

class SpaceFactory extends Factory
{
    protected $model = Space::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'authorization' => $this->faker->url(),
            'url' => $this->faker->url(),
        ];
    }
}
