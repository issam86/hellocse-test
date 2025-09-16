<?php

namespace Domain\Admin\Dto;

final readonly class LoginDto
{
    public function __construct(public string $email, public string $password) {}

    public static function fromArray(array|\ArrayAccess $data): self
    {
        return new self(
            email: $data['email'],
            password: $data['password'],
        );
    }
}
