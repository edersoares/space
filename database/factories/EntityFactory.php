<?php

declare(strict_types=1);

namespace Dex\Laravel\Space\Database\Factories;

use Dex\Laravel\Space\Models\Entity;
use Illuminate\Database\Eloquent\Factories\Factory;

class EntityFactory extends Factory
{
    protected $model = Entity::class;

    public function definition(): array
    {
        return [
            'label' => $this->faker->colorName(),
            'slug' => $this->faker->colorName(),
            'table_name' => $this->faker->colorName(),
            'class' => $this->faker->colorName(),
        ];
    }
}
