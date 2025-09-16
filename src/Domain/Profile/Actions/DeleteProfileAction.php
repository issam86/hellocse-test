<?php

namespace Domain\Profile\Actions;

use Infrastructure\Models\Profile;

class DeleteProfileAction
{
    public function __invoke(Profile $profile): bool
    {
        return $profile->delete();
    }
}
