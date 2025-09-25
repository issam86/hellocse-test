<?php

namespace App\Http\Controllers\Api\Internal\V1\Public;

use App\Http\Requests\Api\Internal\V1\Public\ListProfilesRequest;
use App\Http\Resources\Api\Internal\V1\Public\ProfileResource;
use Domain\Profile\Dto\ListActiveProfilesDto;
use Domain\Profile\Services\ProfileService;
use Illuminate\Http\JsonResponse;

class ProfileController
{
    public function __construct(private readonly ProfileService $profileService) {}

    public function list(ListProfilesRequest $request): JsonResponse
    {
        $dto = ListActiveProfilesDto::fromArray($request->safe()->toArray());
        $profiles = $this->profileService->listActiveProfiles($dto);

        return ProfileResource::collection($profiles)->response();
    }
}
