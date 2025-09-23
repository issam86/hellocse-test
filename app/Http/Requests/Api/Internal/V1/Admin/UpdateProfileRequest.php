<?php

namespace App\Http\Requests\Api\Internal\V1\Admin;

use Domain\Profile\Enums\ProfileStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProfileRequest extends FormRequest
{
    public function rules(): array
    {

        return [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => ['required', Rule::enum(ProfileStatus::class)],
        ];
    }

    public function attributes(): array
    {
        return [
            'first_name' => 'Prénom',
            'last_name' => 'Nom',
            'image' => 'Image',
            'status' => 'Statut'];

    }
}
