<?php

namespace App\Http\Controllers;

use App\Topic;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TopicController extends Controller
{
    //
    public function show(Topic $topic){
        //文章数
        $topic=Topic::withCount('postTopic')->find($topic->id);

        //文章列表
        $posts=$topic->posts()->orderBy('created_at','desc')->take(10)->get();

        //属于自己发布的文章，但未投稿
        $myposts=\App\Post::authorBy(Auth::id())->topicNotBy($topic->id)->get();

        return view('topic.show',compact('topic','posts','myposts'));
    }

    public function submit(Topic $topic){
        //验证
        $this->validate(request(),[
            'post_ids'=>'required|array',
        ]);
        //逻辑
        $post_ids = request('post_ids');
        $topic_id=$topic->id;
        $name=$topic->name;
        foreach ($post_ids as $post_id){
            \App\PostTopic::firstOrCreate(compact('topic_id','post_id','name'));
        }
//        DB::table('posts')->where('id',$post_ids)->update(['topic_id'=>$topic_id]);

        return back();

    }
}
