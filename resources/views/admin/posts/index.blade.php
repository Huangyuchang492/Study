@extends('admin.layout.main')
@section('content')
        <section class="content">
            <div class="row">
                <div class="col-lg-10 col-xs-6">
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">文章列表</h3>
                        </div>
                        <div class="box-body">
                            <table class="table table-bordered">
                                <tbody>
                                <tr>
                                    <th style="width: 10px">id</th>
                                    <th style="width: 100px">文章标题</th>
                                    <th >内容摘要</th>
                                    <th style="width: 120px">操作</th>
                                </tr>
                                <tr>
                                    @foreach($posts as $post)
                                    <td>{{$post->id}}</td>
                                    <td>{{$post->title}}</td>
                                    <td ><div style="overflow: auto;max-height: 500px">{!!$post->content!!}</div></td>
                                    <td>
                                        <button type="button"  class="btn btn-block btn-default post-audit" post-id="{{$post->id}}" post-action-status="1" _token="{{csrf_token()}}" >通过</button>
                                        <button type="button"  class="btn btn-block btn-default post-audit" post-id="{{$post->id}}" post-action-status="-1" _token="{{csrf_token()}}" >拒绝</button>
                                    </td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                            {{$posts->links()}}
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endsection
