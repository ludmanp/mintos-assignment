<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegistrationFormRequest extends FormRequest
{
    use EmailNotExistsTrait;

    public function rules()
    {
        return [
            'email' => 'required|email:rfc,dns|max:255',
            'password' => 'required|min:6|max:255|confirmed',
        ];
    }
}
