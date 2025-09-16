<?php

namespace Domain\Comment\Services;

use Domain\Comment\Actions\CreateCommentAction;
use Domain\Comment\Dto\CreateCommentDto;
use Infrastructure\Models\Comment;

class CommentService
{
    public function __construct(private readonly CreateCommentAction $createCommentAction)
    {}

    public function create(CreateCommentDto $dto, int $admin_id):Comment
    {
        return ($this->createCommentAction)($dto, $admin_id);
    }
}
