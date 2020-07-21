<?php

namespace  App\Admin\Controllers;



use App\AdminUser;

class UserController extends Controller{
    /**
     * 管理员列表
     */
    public function index(){
        $users=AdminUser::paginate(5);
        return view('admin.user.index',compact('users'));
    }

    /**
     * 管理员注册
     */
    public function create(){

        return view('admin.user.add');
    }

    /**
     * 创建操作
     */
    public function store(){
        $this->validate(request(),[
            'name'=>'required|min:3',
            'password'=>'required',
        ]);

        $name=request('name');
        $password=bcrypt(request('password'));
        AdminUser::create(compact('name','password'));

        return redirect('/admin/users');
    }

    /**
     * 用户角色页面
     */
    public function role(AdminUser $user){
        $roles=\App\AdminRole::all( );
        $myRole=$user->role;
        return view('admin.user.role',compact('roles','myRole','user'));

    }

    /**
     * 存储用户角色
     */
    public function storeRole(\App\AdminUser $user){
        $this->validate(request(),[
            'roles'=>'required|array',
        ]);

        $roles=\App\AdminRole::findMany(request('roles'));
        $myRole = $user->role;

        $addRoles = $roles->diff($myRole);
        foreach($addRoles as $role){
            $user->assignRole($role);
        }

        $deleteRoles = $myRole->diff($roles);
        foreach($deleteRoles as $role){
            $user->deleteRole($role);
        }

        return back();
    }
}
