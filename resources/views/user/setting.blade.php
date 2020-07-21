@extends('common.layout')
@section('content')
        <div class="col-sm-8 blog-main">
            <form class="form-horizontal" action="/laraveldemo/user/me/setting" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <div class="form-group">
                    <label class="col-sm-2 control-label">用户名</label>
                    <div class="col-sm-10">
                        <input class="form-control" name="name" type="text" value="{{\Illuminate\Support\Facades\Auth::user()->name}}">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">头像</label>
                    <div class="col-sm-2">
                        <input class="file-loading preview_input" type="file" value="头像" style="width:90px;margin-bottom: 10px" name="avatar">
                        <img  class="preview_img img-rounded"  alt=""  style="border-radius:500px;" width="150" height="150">
                    </div>
                </div>
                @include('common.error')
                <button type="submit" class="btn btn-default">修改</button>
            </form>
            <br>
        </div>

       @include('common.sidebar')

@endsection
