<?php

namespace App\Http\Resources\Api\Internal\V1\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProfileResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->resource['id'],
            'first_name' => $this->resource['first_name'],
            'last_name' => $this->resource['last_name'],
            'status' => $this->resource['status'],
        ];
    }
}
