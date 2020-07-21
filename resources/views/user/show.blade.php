@extends('common.layout')
@section('content')
<div class="container">
    <div class="blog-header"></div>
    <div class="row">
        <div class="col-sm-8">
            <blockquote>
                <p><img src="/laraveldemo/public/{{$user->avatar}}" alt="" class="img-rounded" style="border-radius:500px; height: 40px"> {{$user->name}}</p>
                <footer>关注：{{$user->stars_count}}｜粉丝：{{$user->fans_count}}｜文章：{{$user->posts_count}}</footer>
                @include('user.like.guanzhu',['target_user'=>$user])
            </blockquote>
        </div>
        <div class="col-sm-8 blog-main">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">文章</a></li>
                    <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false">关注</a></li>
                    <li class=""><a href="#tab_3" data-toggle="tab" aria-expanded="false">粉丝</a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="tab_1">
                        @foreach($posts as $post)
                        <div class="blog-post" style="margin-top: 30px">
                            <p class=""><a href="/laraveldemo/user/{{$post->user->id}}/show">{{$post->user->name}}&nbsp;&nbsp;&nbsp;&nbsp;</a>{{$post->created_at->diffForHumans()}}</p>
                            <p class=""><a href="/laraveldemo/posts/show/{{$post->id}}" >{{$post->title}}</a></p>
                            <p>{!! \Str::limit($post->content,70,'...') !!} <a href="/laraveldemo/posts/show/{{$post->id}}">查看详情</a></p>
                        </div>
                        @endforeach
                    </div>
                    <!-- /.tab-pane -->
                    <div class="tab-pane" id="tab_2">
                        @foreach($staruser as $user)
                        <div class="blog-post" style="margin-top: 30px">
                            <p class="">{{$user->name}}</p>
                            <p class="">关注：{{$user->stars_count}} | 粉丝：{{$user->fans_count}}｜ 文章：{{$user->posts_count}}</p>
                            @include('user.like.guanzhu',['target_user'=>$user])
                        </div>
                        @endforeach
                    </div>
                    <!-- /.tab-pane -->
                    <div class="tab-pane" id="tab_3">
                        @foreach($fanuser as $fan)
                            <div class="blog-post" style="margin-top: 30px">
                                <p class="">{{$fan->name}}</p>
                                <p class="">关注：{{$fan->stars_count}} | 粉丝：{{$fan->fans_count}}｜ 文章：{{$fan->posts_count}}</p>
                                @include('user.like.guanzhu',['target_user'=>$user])
                            </div>
                        @endforeach
                    </div>
                    <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
            </div>
        </div><!-- /.blog-main -->
        @include('common.sidebar')
</div>
@endsection
