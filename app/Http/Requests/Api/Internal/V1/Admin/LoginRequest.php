<?php

namespace App\Http\Requests\Api\Internal\V1\Admin;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email' => 'required|email',
            'password' => 'required',
        ];
    }

    public function attributes(): array
    {
        return [
            'email' => 'E-mail',
            'password' => 'mot de passe',
        ];
    }
}
