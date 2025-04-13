<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\MaxThreeComments;

class StorePostRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $post = $this->route('post') instanceof \App\Models\Post ? $this->route('post') : null;
    
        $rules = [
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'min:10'],
            'user_id' => [
                'required', 
                'exists:users,id',
                $post ? new MaxThreeComments($post) : ''
            ],
            'image' => ['nullable', 'image', 'mimes:jpg,png', 'max:2048'],
            'tags' => ['nullable', 'string', 'max:255'],
        ];
    
        $rules['title'][] = $post
            ? 'unique:posts,title,' . $post->id
            : 'unique:posts,title';
    
        return $rules;
    }

    public function messages(): array
    {   
        return [
            'title.required' => 'Title is required.',
            'title.string' => 'Title must be a text.',
            'title.max' => 'Title must not exceed 255 characters.',
            'title.unique' => 'This title already exists.',

            'description.required' => 'Description is required.',
            'description.string' => 'Description must be a text.',
            'description.min' => 'Description must be at least 10 characters.',

            'user_id.required' => 'Post creator is required.',
            'user_id.exists' => 'Selected creator is invalid.',

            'image.image' => 'The file must be an image.',
            'image.mimes' => 'Only JPG and PNG images are allowed.',
            'image.max' => 'The image must not be larger than 2MB.',

            'tags.max' => 'Tags must not exceed 255 characters.',
        ];
    }

   
    protected function prepareForValidation()
    {
        if ($this->tags) {
            // Remove excessive whitespace from tags
            $this->merge([
                'tags' => preg_replace('/\s*,\s*/', ',', $this->tags)
            ]);
        }
    }
}