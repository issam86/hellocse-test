<?php

namespace Tests\Unit\Actions;

use Database\Factories\AdminFactory;
use Domain\Profile\Actions\CreateProfileAction;
use Domain\Profile\Dto\CreateProfileDto;
use Domain\Profile\Enums\ProfileStatus;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Infrastructure\Models\Profile;
use Tests\TestCase;

class CreateProfileActionTest extends TestCase
{
    use RefreshDatabase;

    private CreateProfileAction $action;

    protected function setUp(): void
    {
        parent::setUp();
        $this->action = new CreateProfileAction;
    }

    public function test_create_profile_action_without_image(): void
    {
        $admin = AdminFactory::new()->createOne();
        $dto = new CreateProfileDto(
            first_name: 'John',
            last_name: 'Doe',
            image: null,
            status: ProfileStatus::Active,
            admin_id: $admin->id
        );
        $profile = ($this->action)($dto);

        $this->assertNull($profile->image);
        $this->assertInstanceOf(Profile::class, $profile);
        $this->assertEquals($dto->first_name, $profile->first_name);
        $this->assertEquals($dto->last_name, $profile->last_name);
        $this->assertEquals($dto->status, $profile->status);
        $this->assertEquals($dto->admin_id, $profile->admin_id);
        $this->assertDatabaseHas('profile', [
            'first_name' => $dto->first_name,
            'last_name' => $dto->last_name,
            'status' => $dto->status,
            'admin_id' => $dto->admin_id,
        ]);
    }

    public function test_create_profile_action_with_image(): void
    {
        $admin = AdminFactory::new()->createOne();
        Storage::fake('public');
        $image = UploadedFile::fake()->image('profile.jpg',300, 300);

        $dto = new CreateProfileDto(
            first_name: 'John',
            last_name: 'Doe',
            image: $image,
            status: ProfileStatus::Active,
            admin_id: $admin->id
        );
        $profile = ($this->action)($dto);

        Storage::disk('public')->assertExists($profile->image);

        $this->assertInstanceOf(Profile::class, $profile);
        $this->assertEquals($dto->first_name, $profile->first_name);
        $this->assertEquals($dto->last_name, $profile->last_name);
        $this->assertEquals($dto->status, $profile->status);
        $this->assertEquals($dto->admin_id, $profile->admin_id);
        $this->assertDatabaseHas('profile', [
            'first_name' => $dto->first_name,
            'last_name' => $dto->last_name,
            'status' => $dto->status,
            'admin_id' => $dto->admin_id,
        ]);
    }
}
