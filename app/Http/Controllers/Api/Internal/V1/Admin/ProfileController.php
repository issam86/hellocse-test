<?php

namespace App\Http\Controllers\Api\Internal\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Internal\V1\Admin\CreateProfileRequest;
use App\Http\Requests\Api\Internal\V1\Admin\UpdateProfileRequest;
use App\Http\Resources\Api\Internal\V1\Admin\ProfileResource;
use Domain\Profile\Dto\CreateProfileDto;
use Domain\Profile\Dto\UpdateProfileDto;
use Domain\Profile\Services\ProfileService;
use Illuminate\Http\JsonResponse;
use Infrastructure\Models\Profile;

class ProfileController extends Controller
{
    public function __construct(private readonly ProfileService $profileService) {}

    public function create(CreateProfileRequest $request): JsonResponse
    {

        $dto = CreateProfileDto::fromArray(data: $request->safe()->toArray(), admin_id: auth()->id());
        $profile = $this->profileService->create($dto);

        return ProfileResource::make($profile)->response();

    }

    public function update(Profile $profile, UpdateProfileRequest $request): JsonResponse
    {
        $dto = UpdateProfileDto::fromArray(data: $request->safe()->toArray());
        $profile = $this->profileService->update($profile, $dto);

        return ProfileResource::make($profile)->response();
    }

    public function destroy(Profile $profile): JsonResponse
    {
        $deletedProfile = $this->profileService->delete($profile);

        return ProfileResource::make($deletedProfile)->response();
    }
}
