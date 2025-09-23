<?php

namespace Database\Factories;

use Domain\Profile\Enums\ProfileStatus;
use Illuminate\Database\Eloquent\Factories\Factory;
use Infrastructure\Models\Profile;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ProfileFactory extends Factory
{
    protected $model = Profile::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'first_name' => fake()->firstName(),
            'last_name' => fake()->lastName(),
            'status' => fake()->randomElement(ProfileStatus::cases()),
            'admin_id' => null,
        ];
    }

    public function setAdminId(int $adminId): static
    {
        return $this->state(['admin_id' => $adminId]);

    }
}
