<?php

namespace App\Http\Requests\Guests;

use App\Http\Requests\BasicRequest;

class SubmitVote extends BasicRequest
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
            'guest' => 'required|string',
            'team_id' => 'required|string',
        ];
    }
}