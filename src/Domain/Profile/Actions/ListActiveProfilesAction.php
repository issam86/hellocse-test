<?php

namespace Domain\Profile\Actions;

use Domain\Profile\Enums\ProfileStatus;
use Illuminate\Database\Eloquent\Collection;
use Infrastructure\Models\Profile;

class ListActiveProfilesAction
{
    /**
     * @return Collection<Profile>
     */
    public function __invoke(): Collection
    {
        return Profile::query()->where('status', '=', ProfileStatus::Active)->get();
    }
}
