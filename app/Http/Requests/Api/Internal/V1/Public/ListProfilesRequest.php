<?php

namespace App\Http\Requests\Api\Internal\V1\Public;

use Illuminate\Foundation\Http\FormRequest;

class ListProfilesRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'page' => ['integer', 'min:1'],
            'per_page' => ['integer'],
        ];
    }

    public function attributes(): array
    {
        return [
            'page' => 'Page',
            'per_page' => 'Par page',
        ];
    }

}
