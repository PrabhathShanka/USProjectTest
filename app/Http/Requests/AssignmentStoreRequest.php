<?php

namespace App\Http\Requests;

use App\Models\PromotionCode;
use Illuminate\Foundation\Http\FormRequest;

class AssignmentStoreRequest extends FormRequest
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
            'title' => ['required', 'string', 'max:255'],
            'subject' => ['required', 'string'],
            'description' => ['nullable', 'string', 'max:1000'],
            'deadline' => ['required', 'date', 'after_or_equal:today'],
            'contact_type' => ['required', 'in:WhatsApp,Telegram,Email,Other'],
            'contact_info' => ['required', 'string', 'max:255'],

            'promo_code' => [
                'nullable',
                'string',
                'regex:/^USPC\d{5}$/',
                function ($attribute, $value, $fail) {
                    $promo = PromotionCode::where('promo_code', $value)
                        ->whereIn('status', [1, 2])
                        ->where(function ($q) {
                            $q->whereNull('expiry_date')
                                ->orWhere('expiry_date', '>=', now());
                        })
                        ->first();

                    if (!$promo) {
                        $fail('The promo code is invalid or expired.');
                    }
                }
            ],

            'attachments'   => ['nullable', 'array', 'max:5'],
            'attachments.*' => ['file', 'max:102400'],
        ];
    }

    // Custom messages (optional)
    // public function messages(): array
    // {
    //     return [
    //         'promo_code.regex' => 'Promo code format must be USPC12345.',
    //         'attachments.*.max' => 'Maximum file size is 100MB.',
    //     ];
    // }
}
