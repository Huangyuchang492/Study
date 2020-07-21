@extends('common.layout')
@section('content')
    @foreach($notices as $notice)
            <div class="blog-post">
                <p class="blog-post-meta">{{$notice->title}}</p>
                <p>{{$notice->content}}</p>
            </div>
    @endforeach
@endsection
