<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidateEmailFromRequest extends FormRequest
{
    use EmailNotExistsTrait;

    public function rules()
    {
        return [
            'email' => 'required',
        ];
    }
}
