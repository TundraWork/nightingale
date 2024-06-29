<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\BasicRequest;

class CollectScore extends BasicRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'singer_id' => 'required|string',
            'song_id' => 'required|string',
        ];
    }
}
