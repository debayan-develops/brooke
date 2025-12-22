<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreNovelRequest extends FormRequest
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
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'about_story' => 'nullable|string',
            'author' => 'nullable|string|max:255',
            'thumbnail' => 'nullable|image|max:2048', // max 2MB
            'banner_image' => 'nullable|image|max:4096', // max 4MB
            'status' => 'required|boolean',
            'permission' => 'required|integer|in:0,1,2',
            'tags' => 'nullable|array',
            'tags.*' => 'integer|exists:tags,id',
            'related_novels' => 'nullable|array',
            'related_novels.*' => 'integer|exists:novels,id',
        ];
    }
}
