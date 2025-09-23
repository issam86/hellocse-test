<?php

namespace Tests\Unit\Actions;

use Database\Factories\AdminFactory;
use Database\Factories\ProfileFactory;
use Domain\Profile\Actions\UpdateProfileAction;
use Domain\Profile\Actions\UploadImageAction;
use Domain\Profile\Dto\UpdateProfileDto;
use Domain\Profile\Enums\ProfileStatus;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Testing\File;
use Illuminate\Support\Facades\Storage;
use Infrastructure\Models\Profile;
use Tests\TestCase;

class UpdateProfileActionTest extends TestCase
{
    use RefreshDatabase;

    private UpdateProfileAction $action;

    protected function setUp(): void
    {
        parent::setUp();
        $this->action = new UpdateProfileAction(
            new UploadImageAction
        );
    }

    public function test_update_profile_action_whithout_image(): void
    {
        $admin = AdminFactory::new()->createOne();
        $profile = ProfileFactory::new()
            ->setAdminId($admin->id)
            ->createOne();
        $dto = new UpdateProfileDto(
            first_name: 'John',
            last_name: 'Doe',
            image: null,
            status: ProfileStatus::Active,
        );
        $updatedProfile = ($this->action)($profile, $dto);
        $this->assertNull($updatedProfile->image);
        $this->assertInstanceOf(Profile::class, $updatedProfile);
        $this->assertEquals($dto->first_name, $updatedProfile->first_name);
        $this->assertEquals($dto->last_name, $updatedProfile->last_name);
        $this->assertEquals($dto->status, $updatedProfile->status);
    }

    public function test_update_profile_action_whith_image(): void
    {

        $admin = AdminFactory::new()->createOne();
        $profile = ProfileFactory::new()
            ->setAdminId($admin->id)
            ->createOne();
        $image = File::image('profile.jpg', '300', '300');
        $dto = new UpdateProfileDto(
            first_name: 'John',
            last_name: 'Doe',
            image: $image,
            status: ProfileStatus::Active,
        );
        $updatedProfile = ($this->action)($profile, $dto);
        $this->assertNotNull($updatedProfile->image);
        Storage::disk('public')->assertExists($profile->image);

        $this->assertInstanceOf(Profile::class, $updatedProfile);
        $this->assertEquals($dto->first_name, $updatedProfile->first_name);
        $this->assertEquals($dto->last_name, $updatedProfile->last_name);
        $this->assertEquals($dto->status, $updatedProfile->status);
    }
}
