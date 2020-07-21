@extends('admin.layout.main')
@section('content')
        <section class="content">
            <div class="row">
                <div class="col-lg-10 col-xs-6">
                    <div class="box">

                        <div class="box-header with-border">
                            <h3 class="box-title">通知列表</h3>
                        </div>
                        <a type="button" class="btn " href="/laraveldemo/admin/notices/create">增加通知</a>
                        <div class="box-body">
                            <table class="table table-bordered">
                                <tbody><tr>
                                    <th style="width: 10px">id</th>
                                    <th style="width: 100px;">通知名称</th>
                                    <th>内容</th>
                                    <th>操作</th>
                                </tr>
                                @foreach($notices as $notice)
                                <tr>
                                    <td>{{$notice->id}}</td>
                                    <td>{{$notice->title}}</td>
                                    <td>{{$notice->content}}</td>
                                    <td></td>
                                </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endsection
