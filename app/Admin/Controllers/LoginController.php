<?php
namespace  App\Admin\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class LoginController extends Controller{
    public function index(){
        if(Auth::check()) {
            return \redirect('/home');
        }
        return view('admin/login/index');
    }
    public function login(){
        //验证
        $this->validate(request(),[
           'name'=>'required|min:2',
           'password'=>'required|min:5|max:100',
        ]);

        //逻辑
        $user=request(['name','password']);

        if(Auth::guard('admin')->attempt($user)){
            return redirect('/admin/home');
        }

        //错误提示
        return Redirect::back()->withErrors('账号密码不匹配');
    }
    public function logout(){
        Auth::guard('admin')->logout();
        return \redirect('/admin/adminlogin');
    }
}
