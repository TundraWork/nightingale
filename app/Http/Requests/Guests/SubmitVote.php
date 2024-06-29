<?php

namespace App\Http\Requests\Guests;

use App\Http\Requests\BasicRequest;

class SubmitVote extends BasicRequest
{
    /**
     * Add guest_id from session to the request.
     *
     * @return void
     */
    public function prepareForValidation(): void
    {
        $this->merge([
            'guest_id' => session('guest_id'),
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'guest_id' => 'required|string', // from session, not user input
            'singer_id' => 'required|string',
            'team_id' => 'required|string',
        ];
    }
}
