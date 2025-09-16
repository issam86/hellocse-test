<?php

namespace Domain\Profile\Dto;

use Domain\Profile\Enums\ProfileStatus;

final readonly class UpdateProfileDto
{
    public function __construct(
        public string $first_name,
        public string $last_name,
        public ProfileStatus $status,

    ) {}

    public static function fromArray(array|\ArrayAccess $data): self
    {
        return new self(
            first_name: $data['first_name'],
            last_name: $data['last_name'],
            status: ProfileStatus::from($data['status'])
        );
    }
}
