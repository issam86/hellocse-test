<?php

namespace Domain\Profile\Actions;

use Domain\Profile\Dto\UpdateProfileDto;
use Infrastructure\Models\Profile;

class UpdateProfileAction
{
    public function __construct(private readonly UploadImageAction $uploadImageAction) {}

    public function __invoke(Profile $profile, UpdateProfileDto $dto): Profile
    {
        $imagePath = ($this->uploadImageAction)($dto->image);
        $profile->update([
            'first_name' => $dto->first_name,
            'last_name' => $dto->last_name,
            'image' => $imagePath,
            'status' => $dto->status,
        ]);

        return $profile;

    }
}
