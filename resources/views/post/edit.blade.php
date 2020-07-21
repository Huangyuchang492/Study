@extends('common.layout')
@section('content')
<div class="col-sm-8 blog-main">
            <form action="/laraveldemo/posts/update/{{$post->id}}" method="POST">
                {{method_field("PUT")}}
                <input type="hidden" name="_token" value=" {{csrf_token()}}">
                <div class="form-group">
                    <label>标题</label>
                    <input name="title" type="text" class="form-control" placeholder="这里是标题" value="{{$post->title}}">
                </div>
                <div class="form-group" style="width: 1085px">
                    <label>内容</label>
                    <textarea id="content" name="content" class="form-control" style="height:400px;max-height:500px;"  placeholder="这里是内容">&lt;p&gt;{{$post->content}}</textarea>
                </div>
                <button type="submit" class="btn btn-default">提交</button>
            </form>
            <br>
        </div><!-- /.blog-main -->
    @endsection
