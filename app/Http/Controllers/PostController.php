<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Post;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Mockery\Exception;
use App\Zan;

class PostController extends Controller
{
    /**
     * 列表
     */
    public function index()
    {
        $posts=Post::orderBy('created_at','desc')->withCount(['comments','zans'])->paginate(6);
        return view('post.index',compact('posts'));
    }

    /**
     * 详情页
     */
    public function show(Post $post)
    {
        //预加载模式
        $post->load('comments');
        return view('post.show',compact('post'));
    }

    /**
     * 创建文章
     */
    public function create()
    {
        return view("post.create");
    }

    /**
     * 创建逻辑
     */
    public function store()
    {

//        $post=new \App\Post();
//        $post->title=request('title');
//        $post->content=request('content');
//        $post->save();
//        $params=['title'=>request('title'), 'content'=>request('content'),];

        //验证
        $this->validate(request(),[
           'title'=>'required|string|max:100|min:5',
            'content'=>'required|string|min:10'
        ]);

        //逻辑
        $user_id=Auth::id();

        $params =array_merge(request(['title','content']),compact('user_id'));

        $post=Post::create($params);

        //渲染
        return redirect("/posts");


    }

    /**
     * 编辑页面
     */
    public function edit(Post $post)
    {
        return view('post.edit',compact('post'));
    }

    /**
     * 编辑逻辑
     */
    public function update(Post $post)
    {
        //验证
        $this->validate(\request(),[
           'title'=>'required|string|max:100|min:5',
           'content'=>'required|string|min:10',
        ]);


//            $this->authorize('update', $post);

        Gate::authorize('update',$post);
        $response =Gate::inspect('update',$post);
        if($response->allowed()){
            //逻辑
            $post->title=\request('title');
            $post->content=\request('content');
            $post->save();

            //渲染
            return redirect("/posts/show/{$post->id}");
        }

    }

    /**
     * 删除逻辑
     */
    public function delete()
    {
        return view('post.');

    }

    /**
     * 图片上传
     */
    public function imageupload(Request $request)
    {
        $path = $request->file('wangEditorH5File')->storePublicly(md5(time()));
        return asset('storage/app/public/'.$path);
//        dd(request()->all());
    }

    /**
     * 评论提交
     */
    public function comment(Post $post){
        //验证
        $this->validate(request(),[
            'content'=>'required|min:5',
        ]);

        //逻辑
        $comment = new Comment();
        $comment->user_id= Auth::id();
        $comment->content=\request('content');
        $post->comments()->save($comment);

        //渲染
        return back();
    }

    /**
     * 点赞
     */
    public function zan(Post $post){
        //逻辑
        $param=[
            'user_id'=>Auth::id(),
            'post_id'=>$post->id,
        ];
        //先查找是否含有param中的数据，有->查找，无->创建
        Zan::firstOrCreate($param);


        //渲染
        return back();
    }

    /**
     * 取消赞
     */
    public function unzan(Post $post){
        //逻辑
        $post->zan(Auth::id())->delete();

        //渲染
        return back();
    }
}
