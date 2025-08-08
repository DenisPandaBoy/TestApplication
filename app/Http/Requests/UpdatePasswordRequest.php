<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class UpdatePasswordRequest extends FormRequest
{
    public function authorize():bool
    {
        return true;
    }

    public function rules():array{
        return [
            'old_password' => ['required', 'current_password'],
            'new_password' => ['required','confirmed', Password::min(8)],
            'new_password_confirmation' => ['required', Password::min(8)],
        ];
    }
}
