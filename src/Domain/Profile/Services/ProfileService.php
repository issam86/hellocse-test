<?php

namespace Domain\Profile\Services;

use Domain\Profile\Actions\CreateProfileAction;
use Domain\Profile\Actions\DeleteImageAction;
use Domain\Profile\Actions\DeleteProfileAction;
use Domain\Profile\Actions\ListActiveProfilesAction;
use Domain\Profile\Actions\UpdateProfileAction;
use Domain\Profile\Actions\UploadImageAction;
use Domain\Profile\Dto\CreateProfileDto;
use Domain\Profile\Dto\ListActiveProfilesDto;
use Domain\Profile\Dto\UpdateProfileDto;
use Illuminate\Http\UploadedFile;
use Illuminate\Pagination\LengthAwarePaginator;
use Infrastructure\Models\Profile;

class ProfileService
{
    public function __construct(

        private readonly CreateProfileAction $createProfileAction,
        private readonly UpdateProfileAction $updateProfileAction,
        private readonly DeleteProfileAction $deleteProfileAction,
        private readonly ListActiveProfilesAction $listActiveProfilesAction,
        private readonly UploadImageAction $uploadImageAction,
        private readonly DeleteImageAction $deleteImageAction
    ) {}

    public function create(CreateProfileDto $dto): Profile
    {
        $imagePath = null;
        if($dto->image instanceof UploadedFile)
        {
            $imagePath = ($this->uploadImageAction)($dto->image);
        }

        return ($this->createProfileAction)($dto, $imagePath);
    }

    /**
     * @return LengthAwarePaginator<Profile>
     */
    public function listActiveProfiles(ListActiveProfilesDto $dto): LengthAwarePaginator
    {
        return ($this->listActiveProfilesAction)($dto);
    }

    public function update(Profile $profile, UpdateProfileDto $dto): Profile
    {
        $imagePath = null;
        if($dto->image instanceof UploadedFile) {
            $imagePath = ($this->uploadImageAction)($dto->image);
        }

        if($profile->image)
        {
            ($this->deleteImageAction)($profile->image);
        }
        return ($this->updateProfileAction)($profile, $dto, $imagePath);
    }

    public function delete(Profile $profile): Profile
    {
        ($this->deleteImageAction)($profile->image);
        ($this->deleteProfileAction)($profile);

        return $profile;
    }
}
