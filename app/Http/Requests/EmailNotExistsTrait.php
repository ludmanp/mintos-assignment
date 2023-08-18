<?php

namespace App\Http\Requests;

use App\Models\User;

trait EmailNotExistsTrait
{
    /**
     * Configure the validator instance.
     *
     * @param  \Illuminate\Validation\Validator  $validator
     * @return void
     */
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if(User::query()->where('email', $this->get('email'))->count()) {
                $validator->errors()->add('email', 'This email has already been taken');
            }
        });
    }
}
