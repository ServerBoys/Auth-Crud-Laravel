<?php

namespace App\Http\Requests\Api;

use Illuminate\Contracts\Validation\ValidationRule;


class BlogPostRequest extends ApiRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
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
            'title' => 'required',
            'body' => 'required',
        ];
    }

    public function getBlogPostDetails(): array
    {
        $blogPost = $this->only('title', 'body');
        $blogPost['user_id'] = auth()->user()['id'];
        return $blogPost;
    }

}
