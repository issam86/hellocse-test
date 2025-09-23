<?php

namespace App\Http\Resources\Api\Internal\V1\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Infrastructure\Models\Comment;

/**
 * @property Comment $resource
 */
class CommentRessource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'content' => $this->resource->value,
        ];
    }
}
