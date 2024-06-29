<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\BasicRequest;

class SetCurrentStatus extends BasicRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'singer_id' => 'nullable|string',
            'song_id' => 'nullable|string',
            'team_id' => 'nullable|string',
        ];
    }
}
