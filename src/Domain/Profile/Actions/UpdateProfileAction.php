<?php

namespace Domain\Profile\Actions;

use Domain\Profile\Dto\UpdateProfileDto;
use Infrastructure\Models\Profile;

class UpdateProfileAction
{
    public function __invoke(Profile $profile, UpdateProfileDto $dto): Profile
    {
        $profile->update([
            'first_name' => $dto->first_name,
            'last_name' => $dto->last_name,
            'status' => $dto->status,
        ]);

        return $profile;

    }
}
