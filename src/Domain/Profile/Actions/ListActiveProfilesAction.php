<?php

namespace Domain\Profile\Actions;

use Domain\Profile\Dto\ListActiveProfilesDto;
use Domain\Profile\Enums\ProfileStatus;
use Illuminate\Pagination\LengthAwarePaginator;
use Infrastructure\Models\Profile;

class ListActiveProfilesAction
{
    /**
     * @return LengthAwarePaginator<Profile>
     */
    public function __invoke(ListActiveProfilesDto $dto): LengthAwarePaginator
    {
        return Profile::query()
            ->where('status', '=', ProfileStatus::Active)
            ->paginate(perPage: $dto->per_page, page: $dto->page);
    }
}
