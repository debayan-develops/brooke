<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class shortStorySlider extends FormRequest
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
            // Define your validation rules here
            'slider_images' => 'required|array|max:6', // max 6 images
            'slider_images.*' => 'image|mimes:jpeg,png,webp|max:2048', // max 2MB per image
        ];
    }
}
