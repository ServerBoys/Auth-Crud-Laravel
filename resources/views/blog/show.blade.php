@extends('layouts.app-master')

@section('title')
    {{ $blog->title }}
@endsection

@section('content')
    <h1>{{$blog->title}}</h1>
    <p id="body">
        {!! str_replace("\n" , "<br/>", $blog->body) !!}

    </p>
    <script>
        let body = document.getElementById('body');
        {{--body.innerHTML = `{{nl2br(e($blog->body))}}`;--}}
    </script>
@endsection
