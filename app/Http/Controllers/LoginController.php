<?php

namespace App\Http\Controllers;


use App\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class LoginController extends Controller
{
    //登录页面
    public function index(){

        if(Auth::check()){
            return \redirect('posts');
        }

        return view('login/index');
    }

    /**
     * 登录行为
     */
    public function login()
    {
        $this->validate(request(),[
           'email'=>'required|email',
           'password'=>'required',
            'is_remember'=>'integer'
        ]);
        $user=request([
           'email',
            'password'
        ]);
        $remember=boolval(request('remember'));
        if(Auth::attempt($user,$remember)) return redirect('/posts');

        return Redirect::back()->withErrors('邮箱密码不匹配 ');
    }

    /**
     * 登出行为
     */
    public function loginout()
    {
        Auth::logout();
       return redirect('login');
    }
}
