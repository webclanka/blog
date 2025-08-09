<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Allow all users for now - in production you'd check authentication
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255|min:3',
            'slug' => 'nullable|string|max:255|unique:posts,slug',
            'content' => 'required|string|min:10',
            'excerpt' => 'nullable|string|max:500',
            'status' => 'required|in:draft,published',
            'published_at' => 'nullable|date|after_or_equal:today',
        ];
    }

    /**
     * Get custom validation messages.
     */
    public function messages(): array
    {
        return [
            'title.required' => 'The post title is required.',
            'title.min' => 'The post title must be at least 3 characters long.',
            'title.max' => 'The post title cannot exceed 255 characters.',
            'content.required' => 'The post content is required.',
            'content.min' => 'The post content must be at least 10 characters long.',
            'slug.unique' => 'This slug is already taken. Please choose a different one.',
            'status.in' => 'Status must be either draft or published.',
            'published_at.after_or_equal' => 'Published date cannot be in the past.',
            'excerpt.max' => 'The excerpt cannot exceed 500 characters.',
        ];
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation()
    {
        // If no slug provided, we'll let the model handle it
        if (empty($this->slug) && !empty($this->title)) {
            $this->merge([
                'slug' => null
            ]);
        }

        // If publishing but no published_at date, set it to now
        if ($this->status === 'published' && empty($this->published_at)) {
            $this->merge([
                'published_at' => now()
            ]);
        }
    }
}
