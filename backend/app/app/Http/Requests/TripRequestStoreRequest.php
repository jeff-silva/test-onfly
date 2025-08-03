<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TripRequestStoreRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'destination' => ['required', 'array'],
            'destination.lat' => ['required', 'numeric'],
            'destination.lng' => ['required', 'numeric'],
            'departure_date' => ['required', 'date'],
            'return_date' => ['required', 'date', 'after:departure_date'],
            'status' => ['string', 'in:pending,approved,rejected'],
            'user_id' => ['required', 'exists:app_user,id'],
        ];
    }
}
