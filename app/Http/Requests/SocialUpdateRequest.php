<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SocialUpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'social_email' => ['required', 'boolean'],
            'social_website' => ['nullable', 'url', 'max:255'],
            'social_x' => ['nullable', 'string', 'min:1', 'max:15'],
            'social_facebook' => ['nullable', 'string', 'min:1', 'max:50'],
            'social_instagram' => ['nullable', 'string', 'min:1', 'max:30'],
            'social_youtube' => ['nullable', 'string', 'min:1', 'max:30'],
        ];
    }
}