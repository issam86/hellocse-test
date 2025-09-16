<?php

namespace App\Http\Controllers\Api\Internal\V1\Public;

use App\Http\Resources\Api\Internal\V1\Public\ProfileResource;
use Domain\Profile\Services\ProfileService;
use Illuminate\Http\JsonResponse;

class ProfileController
{
    public function __construct(private readonly ProfileService $profileService) {}

    public function list(): JsonResponse
    {
        $profiles = $this->profileService->listActiveProfiles();

        return ProfileResource::collection($profiles)->response();
    }
}
