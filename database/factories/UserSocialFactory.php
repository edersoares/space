<?php

declare(strict_types=1);

namespace Dex\Laravel\Space\Database\Factories;

use Dex\Laravel\Space\Models\User;
use Dex\Laravel\Space\Models\UserSocial;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserSocialFactory extends Factory
{
    protected $model = UserSocial::class;

    public function definition(): array
    {
        return [
            'provider' => $this->faker->randomElement(['github', 'google', 'microsoft']),
            'provider_id' => $this->faker->numerify('########'),
            'user_id' => fn () => User::factory()->create(),
            'name' => $this->faker->name(),
            'email' => $this->faker->email(),
            'nickname' => $this->faker->name(),
            'avatar' => $this->faker->imageUrl(),
        ];
    }
}
