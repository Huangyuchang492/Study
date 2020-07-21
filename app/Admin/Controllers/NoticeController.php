<?php
namespace App\Admin\Controllers;
use App\Jobs\SendMessage;
use App\Notice;

class NoticeController extends Controller{

    public function index(){
        //获取所有的通知
       $notices =  Notice::all();
        return view('admin.notice.index',compact('notices'));
    }

    public function create(){
        return view('admin.notice.add');
    }

    /**
     * 操作
     */
    public function store(){
        $this->validate(request(),[
           'title'=>'required|min:3',
           'content'=>'required'
        ]);
        $title = request('title');
        $content = request('content');

        $notice = Notice::create(['title'=>$title,'content'=>$content]);

//        create(request(['','']));
        $this->dispatch(new SendMessage($notice));

        return redirect('/admin/notices');
    }
}
