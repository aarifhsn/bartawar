<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UserRequest extends FormRequest
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
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|string|email|max:255|unique:users,email,'.Auth::id(), // Add the current user's ID to the unique rule
            'password' => 'nullable|string|min:6',
            'bio' => 'max:255',
            'avatar' => 'nullable|image|mimetypes:image/jpeg,image/png,image/jpg,image/gif|max:2048',
        ];
    }
}
