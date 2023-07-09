@extends('layouts.app-master')
@section('title')
    Create new blog
@endsection
@section('content')
    <form action="{{ route('blog.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <label for="title"><strong>Title</strong></label>
                    <input id="title" type="text" name="title" class="form-control">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <label for="body"><strong>Body</strong></label>
                    <input type="hidden" id="body" name="body"></input>
                    <span class="d-block w-100 p-2 border border-dark" role="textbox" id="p-body" type="text" contenteditable></span>
                </div>
            </div>

            <button type="submit" class="btn btn-primary ml-3">Submit</button>
        </div>
    </form>

    <script src="{{asset('js/blog.js')}}"></script>
@endsection
