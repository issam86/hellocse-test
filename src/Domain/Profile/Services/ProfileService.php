<?php

namespace Domain\Profile\Services;

use Domain\Profile\Actions\CreateProfileAction;
use Domain\Profile\Actions\DeleteProfileAction;
use Domain\Profile\Actions\ListActiveProfilesAction;
use Domain\Profile\Actions\UpdateProfileAction;
use Domain\Profile\Dto\CreateProfileDto;
use Domain\Profile\Dto\ListActiveProfilesDto;
use Domain\Profile\Dto\UpdateProfileDto;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Infrastructure\Models\Profile;

class ProfileService
{
    public function __construct(

        private readonly CreateProfileAction $createProfileAction,
        private readonly UpdateProfileAction $updateProfileAction,
        private readonly DeleteProfileAction $deleteProfileAction,
        private readonly ListActiveProfilesAction $listActiveProfilesAction,

    ) {}

    public function create(CreateProfileDto $dto): Profile
    {
        return ($this->createProfileAction)($dto);
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
        return ($this->updateProfileAction)($profile, $dto);
    }

    public function delete(Profile $profile): Profile
    {
        ($this->deleteProfileAction)($profile);

        return $profile;
    }
}
