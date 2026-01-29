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
            // FIX: Allow 'characters' to be an array, but REMOVE any 'integer' or 'exists' check on the items
            'characters' => 'nullable|array', 
            'characters.*' => 'nullable', // Allow mixed types (String Names OR Integer IDs)
        
              // Do the same for suggested stories just in case
            'suggested_stories' => 'nullable|array',
            'tags' => 'array',
            'tags.*' => 'exists:tags,id',
            'categories' => 'array',
            'categories.*' => 'exists:content_categories,id',
        ];
    }
}
