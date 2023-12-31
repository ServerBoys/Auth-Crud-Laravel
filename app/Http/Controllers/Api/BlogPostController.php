<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\BlogPostRequest;
use App\Models\BlogPost;

class BlogPostController extends Controller
{
    public function index()
    {
        if (auth()->user()) {
            $blogs = BlogPost::all();
            return response()->json($blogs);
        } else {
            return response()->json(['errors' => 'Unauthorized',
                'status' => true
            ], 401);
        }
    }

    public function store(BlogPostRequest $request)
    {

        $blog = BlogPost::create($request->getBlogPostDetails());
        return response()->json(['blog' => $blog]);
    }

    public function show(BlogPost $blog)
    {
        if (auth()->user()) {
            return response()->json(['blog' => $blog]);
        } else {
            return response()->json(['errors' => 'Unauthorized',
                'status' => true
            ], 401);
        }
    }

    public function update(BlogPostRequest $request, BlogPost $blog)
    {
        $blog->update($request->getBlogPostDetails());
        return response()->json(['blog' => $blog]);
    }

    public function destroy(BlogPost $blog)
    {

        $user = auth()->user();
        if ($user->hasPermissionTo('delete-blog-posts') && $user === $blog->user()) {
            $blog->delete();

            return response()->json(['blog' => $blog]);
        } else {
            return response()->json(['error' => "Unauthorized"], 401);
        }
    }
}
