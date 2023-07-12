<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\BlogPostRequest;
use App\Models\BlogPost;

class BlogPostController extends Controller
{
    public function index()
    {

        $blogs = BlogPost::orderBy('id','desc')->paginate(5);
        return view('blog.index', compact('blogs'));
    }
    public function create()
    {
        if (auth()->user()->hasPermissionTo('create-blog-posts')) {


            return view('blog.create');
        } else {
            return redirect()->route('blog.index')->withErrors(['You do not have permission to create a blog']);
        }
    }

    public function show(BlogPost $blog) {
        return view('blog.show', compact('blog'));
    }

    public function store(BlogPostRequest $request)
    {

        $blog = BlogPost::create($request->getBlogPostDetails());

        return redirect()->route('blog.edit', $blog->id);
    }

    public function edit(BlogPost $blog)
    {

        $user = auth()->user();
        if ($user->hasPermissionTo('edit-blog-posts') && $user === $blog->user()) {
            return view('blog.edit', compact('blog'));
        }
        else {
            return redirect()->route('blog.index')->withErrors(['You do not have access to edit the blog']);
        }
    }

    public function update(BlogPostRequest $request, BlogPost $blog)
    {
        $blog->update($request->getBlogPostDetails());
        return redirect()->route('blog.edit',$blog->id);
    }
    public function destroy(BlogPost $blog)
    {
        $user = auth()->user();
        if ($user->hasPermissionTo('delete-blog-posts') && $user === $blog->user()) {

            $blog->delete();
            return redirect()->route('blog.index')->with('success','Company has been deleted successfully');

        }
        else {
            return redirect()->route('blog.index')->withErrors(['You cannot delete the file']);
        }
    }
}
