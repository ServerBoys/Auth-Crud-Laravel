@extends('layouts.app-master')

@section('title')
    Blogs
@endsection

@section('content')
    <a href="{{route('blog.create')}}" class="btn btn-outline-primary me-2">Create</a>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th class="col-md-1">Title</th>
            <th class="col-md-5">Description</th>
            <th class="col-md-1">Author</th>
            @if(auth()->user()->hasPermissionTo('create-blog-posts'))
            <th width="280px" class="col-md-2">Action</th>
            @endif
        </tr>
        </thead>
        <tbody>
        @foreach ($blogs as $blog)
            <tr>
                <td>{{ $blog->title }}</td>
                <td>{{ $blog->body }}</td>
                <td>{{ $blog->user->username }}</td>

                @if(auth()->user()->hasPermissionTo('create-blog-posts') && auth()->user()->id === $blog->user_id)
                <td>

                    <form action="{{ route('blog.destroy',$blog->id) }}" method="Post">
                        <a class="btn btn-primary" href="{{ route('blog.edit', ['blog'=>$blog])}}">Edit</a>
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>

                @endif
            </tr>
        @endforeach
        </tbody>
    </table>
    {!! $blogs->links() !!}
@endsection
