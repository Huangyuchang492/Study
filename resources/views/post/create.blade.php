@extends('common.layout')
@section('content')
<div class="col-sm-8 blog-main">
            <form action="/laraveldemo/posts" method="POST">
{{--                <input type="hidden" name="_token" value="{{csrf_token()}}">--}}
                {{csrf_field()}}
                <div class="form-group">
                    <label>标题</label>
                    <input name="title" type="text" class="form-control" placeholder="这里是标题">
                </div>
                <div class="form-group" style="width: 1085px">
                    <label>内容</label>
                    <textarea id="content"  style="height:400px;max-height: 700px; overflow:auto;" name="content" class="form-control" placeholder="这里是内容" autofocus=""></textarea>
                </div>
               @include('common.error')
                <button type="submit" class="btn btn-default">提交</button>
            </form>
            <br>
        </div><!-- /.blog-main -->
@endsection
