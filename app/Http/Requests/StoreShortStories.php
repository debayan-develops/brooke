<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreShortStories extends FormRequest
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
            'title' => 'required|string|max:255',
            'short_description' => 'required',
            'thumbnail_photo' => [
                'nullable',
                'image',
                'mimes:png,jpg',
                'max:2048'
            ], // max 2MB
            'short_story_details' => 'required',
            'status' => 'required|boolean',
            'characters' => 'array',
            'characters.*' => 'exists:characters,id',
            'tags' => 'array',
            'tags.*' => 'exists:tags,id',
            'categories' => 'array',
            'categories.*' => 'exists:content_categories,id',
        ];
    }
}
