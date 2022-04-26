<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class SearchShiftsRequest
 * @package App\Http\Requests
 */
class SearchShiftsRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'location' => 'required|string|exists:shift,location',
            'start' => 'required|date',
            'end' => 'required|date',
        ];
    }
}
