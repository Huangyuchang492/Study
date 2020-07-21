<?php
namespace App\Admin\Controllers;

use App\AdminPermission;
use App\AdminRole;

class RoleController extends Controller{
    /**
     * 角色列表
     */
    public function index(){
        $roles=\App\AdminRole::paginate(5);

        return view('admin.role.index',compact('roles'));
    }

    /**
     * 角色创建
     */
    public function create(){

        return view('admin.role.create');
    }

    /**
     * 创建逻辑
     */
    public function store(){

        $this->validate(request(),[
            'name'=>'required|min:3',
            'description'=>'required',
        ]);

        AdminRole::create(request(['name','description']));
        return redirect('/admin/roles');
    }

    /**
     * 角色权限关系页面
     */
    public function permission(AdminRole $role){
        //获取所有权限

        $permissions =AdminPermission::all();

        //获取当前角色权限
        $myPermission = $role->permission;


        return view('admin.role.permission',compact('permissions','myPermission','role'));
    }

    /**
     * @param AdminRole $role
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\think\response\Redirect
     * @throws \Illuminate\Validation\ValidationException
     * 角色赋权限
     */
    public function storePermission(AdminRole $role){
        $this->validate(request(),[
           'permissions' =>'required|array'
        ]);

        $permissions =AdminPermission::findMany(request('permissions'));
        $myPermissions =$role->permission;

        //对已有的权限进行添加
        $addPermission=$permissions->diff($myPermissions);
        foreach($addPermission as $permission){
            $role->grantPermission($permission);
        }

        //
        $deletePermission = $myPermissions->diff($permissions);
        foreach($deletePermission as $permission){
            $role->deletePermission($permission);
        }

        return redirect('/admin/roles');

    }
}
