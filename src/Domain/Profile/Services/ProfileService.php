<?php

namespace Domain\Profile\Services;

use Domain\Profile\Actions\CreateProfileAction;
use Domain\Profile\Actions\ListActiveProfilesAction;
use Domain\Profile\Dto\CreateProfileDto;
use Illuminate\Database\Eloquent\Collection;
use Infrastructure\Models\Profile;

class ProfileService
{
    public function __construct(

        private readonly CreateProfileAction $createProfileAction,
        private readonly ListActiveProfilesAction $listActiveProfilesAction,
    ) {}

    public function create(CreateProfileDto $dto): Profile
    {
        return ($this->createProfileAction)($dto);
    }

    /**
     * @return Collection<Profile>
     */
    public function listActiveProfiles(): Collection
    {
        return ($this->listActiveProfilesAction)();
    }
}
