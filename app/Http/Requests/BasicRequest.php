<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BasicRequest extends FormRequest
{
    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        $response = response()->json([
            'code' => 400,
            'message' => $validator->errors()->first(),
        ], 400);

        throw new \Illuminate\Validation\ValidationException($validator, $response);
    }
}
