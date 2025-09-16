<?php

namespace Domain\Admin\Services;

use Domain\Admin\Dto\LoginDto;
use Domain\Admin\Exceptions\InvalidCredentialsException;
use Illuminate\Support\Facades\Hash;
use Infrastructure\Models\Admin;

class AuthService
{
    public function login(LoginDto $dto): array
    {
        $admin = Admin::where('email', $dto->email)->first();

        if (! $admin instanceof Admin || ! Hash::check($dto->password, $admin->password)) {
            throw new InvalidCredentialsException;
        }

        $token = $admin->createToken('api-token')->plainTextToken;

        return [
            'token' => $token,
            'admin' => $admin,
        ];
    }
}
