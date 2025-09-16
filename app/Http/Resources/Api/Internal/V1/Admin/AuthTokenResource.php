<?php

namespace App\Http\Resources\Api\Internal\V1\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AuthTokenResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'token' => $this->resource['token'],
            'admin' => [
                'id' => $this->resource['admin']->id,
                'email' => $this->resource['admin']->email,
            ],
        ];
    }
}
