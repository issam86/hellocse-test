<?php

namespace App\Http\Controllers\Api\Internal\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Internal\V1\Admin\LoginRequest;
use App\Http\Resources\Api\Internal\V1\Admin\AuthTokenResource;
use Domain\Admin\Dto\LoginDto;
use Domain\Admin\Services\AuthService;
use Illuminate\Http\JsonResponse;

class AuthController extends Controller
{
    public function __construct(private readonly AuthService $authService) {}

    public function login(LoginRequest $request): JsonResponse
    {

        $dto = LoginDto::fromArray($request->safe()->toArray());

        $result = $this->authService->login($dto);

        return AuthTokenResource::make($result)->response();

    }
}
