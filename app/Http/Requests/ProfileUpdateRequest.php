<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    protected function prepareForValidation()
    {
        $this->merge([
            'displayname' => $this->displayname !== null ? $this->displayname : $this->user()->username,
            'username' => $this->username !== null ? $this->username : $this->user()->username,
            'email' => $this->email !== null ? strtolower($this->email) : $this->user()->email,
        ]);
    }

    public function rules(): array
    {
        return [
            'displayname' => ['string', 'max:85', 'min:5'],
            'username' => ['required', 'string', 'regex:/^[A-Za-z0-9]+(?:[_-][A-Za-z0-9]+)*$/', 'max:15', 'min:5'],
            'bio' => ['nullable', 'string', 'min:1', 'max:250'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique(User::class)->ignore($this->user()->id)],
            'profile_image' => ['nullable', 'image', 'mimes:jpeg,jpg,png,gif', 'max:3072'],
            'profile_banner' => ['nullable', 'image', 'mimes:jpeg,jpg,png,gif', 'max:3072'],
        ];
    }

    public function messages()
    {
        return [
            'bio.max' => 'Bio must not be more than 250 characters.',
        ];
    }
}