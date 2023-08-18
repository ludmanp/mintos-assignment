<?php

namespace App\Http\Requests;

class LoginFormRequest extends \Illuminate\Foundation\Http\FormRequest
{
    public function rules()
    {
        return [
            'email' =>'required|string',
            'password' => 'required|string'
        ];
    }
}
