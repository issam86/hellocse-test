<?php

namespace Domain\Comment\Actions;

use Domain\Comment\Dto\CreateCommentDto;
use Domain\Comment\Exceptions\CommentAlreadyExistsException;
use Infrastructure\Models\Comment;

class CreateCommentAction
{
    public function __invoke(CreateCommentDto $commentDto, int $admin_id): Comment
    {
        $existingComment = Comment::query()
            ->where('admin_id', '=', $admin_id)
            ->where('profile_id', '=', $commentDto->profile_id)
            ->exists();

        if ($existingComment) {
            throw new CommentAlreadyExistsException;
        }

        return Comment::create([
            'content' => $commentDto->content,
            'profile_id' => $commentDto->profile_id,
            'admin_id' => $admin_id,
        ]);

    }
}
