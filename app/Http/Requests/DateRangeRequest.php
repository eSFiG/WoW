<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DateRangeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'date_from' => 'required|date|max:255',
            'date_to' => 'required|date|max:255',
        ];
    }
}
