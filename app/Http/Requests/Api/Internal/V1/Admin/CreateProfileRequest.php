<?php

namespace App\Http\Requests\Api\Internal\V1\Admin;

use Domain\Profile\Enums\ProfileStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateProfileRequest extends FormRequest
{
    public function rules(): array
    {

        return [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'status' => ['required', Rule::enum(ProfileStatus::class)],
        ];
    }
}
