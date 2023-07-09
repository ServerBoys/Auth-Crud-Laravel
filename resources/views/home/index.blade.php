@extends('layouts.app-master')

@section('title')
    HomePage
@endsection

    @section('content')
    <div class="bg-light p-5 rounded">
        @auth
            <h1>Dashboard</h1>
            <a class="btn btn-primary" href="{{ route('blog.index') }}">Blogs</a>
        @endauth

        @guest
            <h1>Homepage</h1>
            <p class="lead">Your viewing the home page. Please log in to view the restricted data.</p>
        @endguest
    </div>
@endsection
