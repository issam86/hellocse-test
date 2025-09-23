<?php

namespace App\Http\Controllers\Api\Internal\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Internal\V1\Admin\CreateCommentRequest;
use App\Http\Resources\Api\Internal\V1\Admin\CommentRessource;
use Domain\Comment\Dto\CreateCommentDto;
use Domain\Comment\Services\CommentService;
use Infrastructure\Models\Profile;

class CommentController extends Controller
{
    public function __construct(private readonly CommentService $commentService) {}

    public function create(Profile $profile, CreateCommentRequest $request)
    {

        $dto = CreateCommentDto::fromArray(data: $request->safe()->toArray(), profile_id: $profile->id);
        $comment = $this->commentService->create($dto, auth()->id());

        return CommentRessource::make($comment)->response();
    }
}
