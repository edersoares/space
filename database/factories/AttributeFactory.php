<?php

declare(strict_types=1);

namespace Dex\Laravel\Space\Database\Factories;

use Dex\Laravel\Space\Models\Attribute;
use Dex\Laravel\Space\Models\Entity;
use Illuminate\Database\Eloquent\Factories\Factory;

class AttributeFactory extends Factory
{
    protected $model = Attribute::class;

    public function definition(): array
    {
        return [
            'entity_id' => fn () => Entity::factory()->create(),
            'name' => $this->faker->colorName(),
            'slug' => $this->faker->colorName(),
            'column_name' => $this->faker->colorName(),
        ];
    }
}
