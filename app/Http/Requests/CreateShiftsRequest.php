<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class CreateShiftsRequest
 * @package App\Http\Requests
 */
class CreateShiftsRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'shifts.*.type' => 'required|string',
            'shifts.*.start' => 'required|date',
            'shifts.*.end' => 'required|date',
            'shifts.*.user_email' => 'required|email:rfc',
            'shifts.*.location' => 'required|string',
        ];
    }
}
