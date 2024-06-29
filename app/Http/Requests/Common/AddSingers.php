<?php

namespace App\Http\Requests\Common;

use App\Http\Requests\BasicRequest;

class AddSingers extends BasicRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'names' => 'required|array',
            'names.*' => 'required|string',
        ];
    }
}
