<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize()
    {
        // return auth()->user()->id === $this->user_id;
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
{
    $userId = auth()->user()->id;

    return [
        'username' => 'required|string|max:255|unique:users,username,' . $userId,
        'email' => 'required|string|email|max:255|unique:users,email,' . $userId,
        'password' => 'nullable|string|min:6|confirmed',
        'phone_number' => [
            'nullable',
            'string',
            'min:8',
            function ($attribute, $value, $fail) use ($userId) {
                // Check uniqueness only if the value is provided
                if (!empty($value)) {
                    $exists = \DB::table('userdetails')
                        ->where('phone_number', $value)
                        ->where('user_id', '!=', $userId) // Exclude the current user
                        ->exists();

                    if ($exists) {
                        $fail('The ' . $attribute . ' has already been taken.');
                    }
                }
            },
        ],
        'ic' => [
            'nullable',
            'string',
            'min:12',
            'max:12',
            function ($attribute, $value, $fail) use ($userId) {
                // Check uniqueness only if the value is provided
                if (!empty($value)) {
                    $exists = \DB::table('userdetails')
                        ->where('ic', $value)
                        ->where('user_id', '!=', $userId) // Exclude the current user
                        ->exists();

                    if ($exists) {
                        $fail('The ' . $attribute . ' has already been taken.');
                    }
                }
            },
        ],
        // Add more fields and validation rules as needed
    ];
}
}
