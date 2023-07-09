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
        return view('blog.create');
    }

    public function show(BlogPost $blog) {
        return view('blog.show', compact('blog'));
    }

    public function store(BlogPostRequest $request)
    {

        $blog = BlogPost::create($request->getBlogPostDetails());

        return redirect()->route('blog.edit', $blog->id);
    }

    public function edit(BlogPost $blog): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('blog.edit',compact('blog'));
    }

    public function update(BlogPostRequest $request, BlogPost $blog)
    {
        $blog->update($request->getBlogPostDetails());
        return redirect()->route('blog.edit',$blog->id);
    }
    public function destroy(BlogPost $blog)
    {
        $blog->delete();
        return redirect()->route('blog.index')->with('success','Company has been deleted successfully');
    }
}
