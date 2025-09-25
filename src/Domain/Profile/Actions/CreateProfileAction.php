<?php

namespace Domain\Profile\Actions;

use Domain\Profile\Dto\CreateProfileDto;
use Infrastructure\Models\Profile;

class CreateProfileAction
{
    public function __construct() {}

    public function __invoke(CreateProfileDto $dto, ?string $imagePath=null): Profile
    {

        return Profile::create([
            'first_name' => $dto->first_name,
            'last_name' => $dto->last_name,
            'image' => $imagePath ?? null,
            'admin_id' => $dto->admin_id,
            'status' => $dto->status,
        ]);

    }
}
