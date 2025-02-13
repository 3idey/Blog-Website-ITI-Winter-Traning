<?php

namespace App\Http\Requests;
use App\Models\User;

use Illuminate\Foundation\Http\FormRequest;

class StoreBlogRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return TRUE;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            'title' => 'required|string|max:255|min:3',
            'description' => 'required|string|min:10',
            'posted_by' => 'required|string|max:15',
            'image' => 'nullable|image|mimes:jpg,png|max:2048' // Add image validation
        ];

        if ($this->isMethod('post')) {
            $rules['title'] .= '|unique:posts';
        } elseif ($this->isMethod('put') || $this->isMethod('patch')) {
            $rules['title'] .= '|unique:posts,title,' . $this->route('id');
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'title.required' => 'The title field is required.',
            'title.unique' => 'The title has already been taken.',
            'description.required' => 'The description field is required.',
            'posted_by.required' => 'The name of the publisher field is required.',
            'image.image' => 'The file must be an image.',
            'image.mimes' => 'The image must be a file of type: jpg, png.',
            'image.max' => 'The image may not be greater than 2048 kilobytes.'
        ];
    } 
}
