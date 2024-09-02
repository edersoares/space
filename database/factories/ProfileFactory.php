<?php

declare(strict_types=1);

namespace Dex\Laravel\Space\Database\Factories;

use Dex\Laravel\Space\Models\Profile;
use Dex\Laravel\Space\Models\Space;
use Dex\Laravel\Space\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProfileFactory extends Factory
{
    protected $model = Profile::class;

    public function definition(): array
    {
        return [
            'space_id' => fn () => Space::factory()->create(),
            'user_id' => fn () => User::factory()->create(),
            'name' => $this->faker->name(),
            'token' => $this->faker->uuid(),
            'is_default' => $this->faker->boolean(),
        ];
    }
}
