<?php

namespace App\Http\Controllers\Api;

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

    public function store(BlogPostRequest $request)
    {

        $blog = BlogPost::create($request->getBlogPostDetails());

        return redirect()->route('blog.edit', $blog->id)->with('success','Blog has been created');
    }

    public function update(BlogPostRequest $request, BlogPost $blog)
    {
        $blog->update($request->getBlogPostDetails());
        return redirect()->route('blog.edit',$blog->id)->with('success','Blog has been updated');
    }
    public function destroy(BlogPost $blog)
    {
        $blog->delete();
        return redirect()->route('blog.index')->with('success','Blog has been deleted successfully');
    }
}
