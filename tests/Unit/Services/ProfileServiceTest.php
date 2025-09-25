<?php

namespace Tests\Unit\Services;

use Database\Factories\AdminFactory;
use Database\Factories\ProfileFactory;
use Domain\Profile\Actions\CreateProfileAction;
use Domain\Profile\Actions\DeleteImageAction;
use Domain\Profile\Actions\DeleteProfileAction;
use Domain\Profile\Actions\ListActiveProfilesAction;
use Domain\Profile\Actions\UpdateProfileAction;
use Domain\Profile\Actions\UploadImageAction;
use Domain\Profile\Dto\CreateProfileDto;
use Domain\Profile\Dto\UpdateProfileDto;
use Domain\Profile\Enums\ProfileStatus;
use Domain\Profile\Services\ProfileService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Infrastructure\Models\Profile;
use Tests\TestCase;

class ProfileServiceTest extends TestCase
{
    use RefreshDatabase;
    private ProfileService $profileService;
    public function setUp(): void
    {
        parent::setUp();

        $this->createProfileActionMock = $this->createMock(CreateProfileAction::class);
        $this->updateProfileActionMock = $this->createMock(UpdateProfileAction::class);
        $this->deleteProfileActionMock = $this->createMock(DeleteProfileAction::class);
        $this->listActiveProfilesActionMock = $this->createMock(ListActiveProfilesAction::class);
        $this->uploadImageActionMock = $this->createMock(UploadImageAction::class);
        $this->deleteImageActionMock = $this->createMock(DeleteImageAction::class);

        $this->profileService = new ProfileService(
            $this->createProfileActionMock,
            $this->updateProfileActionMock,
            $this->deleteProfileActionMock,
            $this->listActiveProfilesActionMock,
            $this->uploadImageActionMock,
            $this->deleteImageActionMock
        );

    }

    public function test_create_profile_without_image_success():void
    {
        //Arrange
        $admin = AdminFactory::new()->createOne();
        $dto = new CreateProfileDto(
            first_name: 'Dupont',
            last_name: 'Dupond',
            image: null,
            status: ProfileStatus::Active,
            admin_id: $admin->id,
        );

        $expectsProfile = new Profile([
            'first_name' => $dto->first_name,
            'last_name' => $dto->last_name,
            'status' => $dto->status,
            'admin_id' => $dto->admin_id,
        ]);

        $this->uploadImageActionMock
            ->expects($this->never())
            ->method('__invoke');

        $this->createProfileActionMock
            ->expects($this->once())
            ->method('__invoke')
            ->with($dto)
            ->willReturn($expectsProfile);


        //Act
        $result = $this->profileService->create($dto);

        //Assert
        $this->assertInstanceOf(Profile::class, $result);
        $this->assertEquals($dto->first_name, $result->first_name);
        $this->assertEquals($dto->last_name, $result->last_name);
        $this->assertEquals($dto->status, $result->status);
        $this->assertEquals($dto->admin_id, $result->admin_id);
    }

    public function test_create_profile_with_image_success():void
    {
        $admin = AdminFactory::new()->createOne();
        Storage::fake('public');
        $image = UploadedFile::fake()->image('profile.jpg', 300, 300);
        $dto = new CreateProfileDto(
            first_name: 'Dupont',
            last_name: 'Dupond',
            image: $image,
            status: ProfileStatus::Active,
            admin_id: $admin->id,
        );

        $expectsProfile = new Profile([
            'first_name' => $dto->first_name,
            'last_name' => $dto->last_name,
            'status' => $dto->status,
            'admin_id' => $dto->admin_id,
            'image' => $image->name,
        ]);

        $this->uploadImageActionMock
            ->expects($this->once())
            ->method('__invoke')
            ->with($dto->image)
            ->willReturn($image->name);

        $this->createProfileActionMock
            ->expects($this->once())
            ->method('__invoke')
            ->with($dto, $image->name)
            ->willReturn($expectsProfile);

        $result = $this->profileService->create($dto);

        $this->assertInstanceOf(Profile::class, $result);
        $this->assertEquals($dto->first_name, $result->first_name);
        $this->assertEquals($dto->last_name, $result->last_name);
        $this->assertEquals($dto->status, $result->status);
        $this->assertEquals($dto->admin_id, $result->admin_id);
        $this->assertEquals($dto->image->name, $result->image);
    }


    public function test_update_profile_without_image_success():void
    {
        $admin = AdminFactory::new()->createOne();
        $profile = ProfileFactory::new()
            ->setAdminId($admin->id)
            ->createOne();


        $dto = new UpdateProfileDto(
            first_name: 'Dupont',
            last_name: 'Dupond',
            image: null,
            status: ProfileStatus::Active,
        );

        $expectsProfile = new Profile([
            'first_name' => $dto->first_name,
            'last_name' => $dto->last_name,
            'status' => $dto->status,
            'image' => null,
        ]);

        $this->updateProfileActionMock
            ->expects($this->once())
            ->method('__invoke')
            ->with($profile, $dto)
            ->willReturn($expectsProfile);

        $this->uploadImageActionMock
            ->expects($this->never())
            ->method('__invoke');

        $result = $this->profileService->update($profile, $dto);

        $this->assertInstanceOf(Profile::class, $result);
        $this->assertNull($result->image);
        $this->assertEquals($dto->first_name, $result->first_name);
        $this->assertEquals($dto->last_name, $result->last_name);
        $this->assertEquals($dto->status, $result->status);
    }


}
