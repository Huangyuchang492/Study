<?php
namespace App\Admin\Controllers;

use App\AdminPermission;

class PermissionController extends Controller{
    /**
     * 权限列表页面
     */
    public function index(){

        $permissions = \App\AdminPermission::paginate(5);
        return view('admin.permission.index',compact('permissions'));
    }

    /**
     * 创建页面
     */
    public function create(){
        return view('admin.permission.create');
    }

    /**
     * 创建行为
     */
    public function store(){
        $this->validate(request(),[
            'name'=>'required|min:3',
            'description'=>'required'
        ]);

        AdminPermission::create(request(['name','description']));

        return redirect('/admin/permissions');
    }
}
