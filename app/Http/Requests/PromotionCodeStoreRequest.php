<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PromotionCodeStoreRequest extends FormRequest
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
            'discount_percentage' => 'required|numeric|min:0|max:100',
            'expiry_date' => 'required|date|after:today',
        ];
    }

    public function messages(): array
    {
        return [
            'discount_percentage.required' => 'The discount percentage field is required.',
            'discount_percentage.numeric' => 'The discount percentage must be a number.',
            'discount_percentage.min' => 'The discount percentage must be at least 0.',
            'discount_percentage.max' => 'The discount percentage must be at most 100.',
            'expiry_date.required' => 'The expiry date field is required.',
            'expiry_date.date' => 'The expiry date must be a valid date.',
            'expiry_date.after' => 'The expiry date must be after today.',
        ];
    }
}
