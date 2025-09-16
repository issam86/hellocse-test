<?php

declare(strict_types=1);

namespace Database\Factories;

use Infrastructure\Models\Admin;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @template TModelClass of Admin
 *
 * @extends Factory<TModelClass>
 */
class AdminFactory extends Factory
{
    protected $model = Admin::class;

    public function definition(): array
    {
        return [

            'email' => $this->faker->unique()->safeEmail(),
            'password' => Hash::make('password123'),

        ];
    }



    public function setEmail(string $email): static
    {
        return $this->state(['email' => $email]);
    }

    public function setPassword(string $password): static
    {
        return $this->state(['password' => Hash::make($password)]);
    }
}
