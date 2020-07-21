<?php

namespace App\Http\Controllers;

use App\Post;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    //个人设置页面
    public function setting(){

        $user=Auth::user();
        return view('user.setting',compact('user'));
    }

    /**
     * 个人设置逻辑
     */
    public function settingStore(Request $request)
    {
        //验证
        $this->validate(\request(),[
           'name'=>'required|min:3',
        ]);
        //逻辑
        $name=\request('name');
        $user = Auth::user();
        if($name != $user->name){
            if(User::where('name',$name)->count()>0){
                return back()->withErrors('用户名已被注册');
            }
            $user->name=$name;
        }

        if($request->file('avatar')){
            //user->id 作为上传的头像名
              $path = $request->file('avatar')->storePublicly($user->id);
              $user->avatar="/storage/".$path;
        }
        $user->save();
        //渲染
        return back();
    }

    /**
     * 个人中心页面
     */
    public function show(User $user){
        //信息 包含关注/粉丝/文章数
        $user=User::withCount(['stars','fans','posts'])->find($user->id);

        //文章列表 取前5条
        $posts=$user->posts()->orderBy('created_at','desc')->take(5)->get();

        //关注的用户 关注用户的关注/粉丝/文章数
        $stars=$user->stars;
        $staruser=User::whereIn('id',$stars->pluck('star_id'))->withCount(['stars','fans','posts'])->get();

        //粉丝用户  粉丝的关注/粉丝/文章
        $fans=$user->fans;
        $fanuser=User::whereIn('id',$fans->pluck('fan_id'))->withCount(['stars','fans','posts'])->get();

        return view('user.show',compact('user','posts','staruser','fanuser'));
    }

    /**
     * like
     */
    public function fan(User $user){
        $me = Auth::user();
        $me->doFan($user->id);
        return[
          'error'=>0,
          'msg'=>'',
        ];
    }
    /**
     * 取消关注
     */
    public function unfan(User $user){
        $me = Auth::user();
        $me->doUnFan($user->id);
        return[
            'error'=>0,
            'msg'=>'',
        ];
    }
}
