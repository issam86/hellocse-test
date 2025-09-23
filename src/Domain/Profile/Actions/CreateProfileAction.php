<?php

namespace Domain\Profile\Actions;

use Domain\Profile\Dto\CreateProfileDto;
use Infrastructure\Models\Profile;

class CreateProfileAction
{
    public function __construct(private readonly UploadImageAction $uploadImageAction) {}

    public function __invoke(CreateProfileDto $dto): Profile
    {
        $imagePath = ($this->uploadImageAction)($dto->image);

        return Profile::create([
            'first_name' => $dto->first_name,
            'last_name' => $dto->last_name,
            'image' => $imagePath,
            'admin_id' => $dto->admin_id,
            'status' => $dto->status,
        ]);

    }
}
