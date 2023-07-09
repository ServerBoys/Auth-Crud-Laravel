<?php

namespace App\Http\Requests\Web;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class BlogPostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        if (!auth()->user()) return false;
        return auth()->user()->hasPermissionTo('edit-blog-posts');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'title'=>'required',
            'body'=>'required',
        ];
    }

    public function getBlogPostDetails() {
        $blogPost = $this->only('title', 'body');
        $blogPost['user_id'] = auth()->user()['id'];
        return $blogPost;
    }
}
