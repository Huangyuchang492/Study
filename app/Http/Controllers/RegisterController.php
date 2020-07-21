<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;

class RegisterController extends Controller
{
    //注册页面
    public function index()
    {
        return view('register.index');
    }

    /**
     * 注册行为
     */
    public function register()
    {
        //第一步验证数据
        $this->validate(request(),[
            'name'=>'required|min:3|unique:users,name',//字段唯一
            'email'=>'required|unique:users,email|email',
            'password'=>'required|min:5|max:10|confirmed',
            ]);

        //第二步数据入库逻辑
        $name=request('name');
        $email=request('email');
        $password=bcrypt(request('password'));

        User::create(compact('name','email','password'));

        //第三步视图渲染
        return redirect('/login');
    }
}
