<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBlogs extends FormRequest
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
            'article_type' => 'required|string|in:Blog,Journal',
            // 'short_description' => 'required',
            'thumbnail_photo' => [
                'nullable',
                'image',
                'mimes:png,jpg',
                'max:2048'
            ], // max 2MB
            'blog_details' => 'required',
            'status' => 'required|boolean',
            'blogTypes' => 'array',
            'blogTypes.*' => 'exists:blog_type,id',
            'tags' => 'array',
            'tags.*' => 'exists:tags,id',
            'categories' => 'array',
            'categories.*' => 'exists:content_categories,id',
            'suggestedArticles' => 'nullable|array', 
        ];
    }
}
