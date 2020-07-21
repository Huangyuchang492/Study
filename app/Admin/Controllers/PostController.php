<?php
namespace App\Admin\Controllers;

use App\Post;
use Illuminate\Support\Facades\DB;


class PostController extends Controller{
    public function index(){
        $posts=Post::withoutGlobalScope('avaiable')->where('status',0)->orderBy('created_at','desc')->paginate(5);
        return View('admin.posts.index',compact('posts'));
    }

    public function status(){
        $this->validate(request(),[
           'status'=>'required|in:-1,1',
        ]);

        $post=new \App\Post();
        $status= $post->status=request('status');
        $id=$post->id=request('id');
        DB::table('posts')->where('id',$id)->update(['status'=>$status]);

        return[
          'error'=>0,
          'msg'=>'',
        ];
    }
}
