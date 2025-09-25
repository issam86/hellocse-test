<?php

namespace Domain\Profile\Dto;

class ListActiveProfilesDto
{
    public function __construct(
        public int $page = 1,
        public int $per_page = 10,
    )
    {}

    public static function fromArray(array|\ArrayAccess $data): self
    {
        return new self(
            page: $data['page'] ?? 1,
            per_page: $data['per_page'] ?? 10,
        );
    }
}
