<?php

namespace Tests\Unit\Actions;

use Database\Factories\AdminFactory;
use Database\Factories\ProfileFactory;
use Domain\Profile\Actions\UpdateProfileAction;
use Domain\Profile\Dto\UpdateProfileDto;
use Domain\Profile\Enums\ProfileStatus;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Infrastructure\Models\Profile;
use Tests\TestCase;

class UpdateProfileActionTest extends TestCase
{
    use RefreshDatabase;
    private UpdateProfileAction $action;
    public function setUp(): void
    {
        parent::setUp();
        $this->action = new UpdateProfileAction;
    }

    public function test_update_profile_action(): void
    {
        $admin = AdminFactory::new()->createOne();
        $profile = ProfileFactory::new()
            ->setAdminId($admin->id)
            ->createOne();
        $dto = new UpdateProfileDto(
            first_name: 'John',
            last_name: 'Doe',
            status: ProfileStatus::Active,
        );
        $updatedProfile = ($this->action)($profile, $dto);
        $this->assertInstanceOf(Profile::class, $updatedProfile);;
        $this->assertEquals($dto->first_name, $updatedProfile->first_name);
        $this->assertEquals($dto->last_name, $updatedProfile->last_name);
        $this->assertEquals($dto->status, $updatedProfile->status);
    }

}
