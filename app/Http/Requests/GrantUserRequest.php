<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GrantUserRequest extends FormRequest
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
            'uid' => 'required|integer|exists:users,id',
            'permissions_level' => 'required|integer|between:1,100',
        ];
    }
}
