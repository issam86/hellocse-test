<?php

namespace Domain\Comment\Dto;

final readonly class CreateCommentDto
{
    public function __construct(
        public string $content,
        public int $profile_id,
    ) {}

    public static function fromArray(array|\ArrayAccess $data, int $profile_id): self
    {
        return new self(
            content: $data['content'],
            profile_id: $profile_id,
        );
    }
}
