<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\BasicRequest;

class SetCurrentStatus extends BasicRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

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