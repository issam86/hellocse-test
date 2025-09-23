<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Infrastructure\Models\Comment;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class CommentFactory extends Factory
{
    protected $model = Comment::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'content' => fake()->text(),
        ];
    }

    public function setProfileId(int $profileId): static
    {
        return $this->state(['profile_id' => $profileId]);
    }

    public function setAdminId(int $adminId): static
    {
        return $this->state(['admin_id' => $adminId]);
    }
}
