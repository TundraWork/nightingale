<?php

namespace App\Http\Requests\Judges;

use App\Http\Requests\BasicRequest;

class SubmitScore extends BasicRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'judge' => 'required|string',
            'singer_id' => 'required|string',
            'song_id' => 'required|string',
            // scores should be like {"A": 8.5, "B": 9.0, "C": 8.0, "D": 7.5, "E": 7.5}
            'scores' => 'required|array',
            'scores.*' => 'required|numeric',
        ];
    }
}
