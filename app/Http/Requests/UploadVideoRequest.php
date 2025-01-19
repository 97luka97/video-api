<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UploadVideoRequest extends FormRequest
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
            'description' => 'required|string|max:1000',
            'video' => 'required|mimes:mp4,mov,avi,wmv|max:204800',
            'thumbnail' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'The title is required.',
            'description.required' => 'The description is required.',
            'video.required' => 'A video file is required.',
            'thumbnail.required' => 'A thumbnail image is required.',
            'video.mimes' => 'The video must be a valid file type (mp4, mov, avi, wmv).',
            'thumbnail.mimes' => 'The thumbnail must be a valid image file (jpeg, png, jpg, gif).',
        ];
    }
}
