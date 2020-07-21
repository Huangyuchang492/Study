<?php

namespace App;

use App\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
class AdminUser extends Authenticatable
{
    //
    protected $table='admin_users';
    protected $fillable=['name','password'];//可注入数据字段

    public function role(){
        //目标类 关系表 当前对象在关系表中的外键  对象表在关系表中的外键  withPiovt 获取关系表的字段
        return $this->belongsToMany(\App\AdminRole::class,'admin_role_user','user_id','role_id')->withPivot(['user_id','role_id']);
    }

    /**
     * 判断是否有某个用户是否拥有权限角色
     */
    public function isInRoles($roles){
        //count->0 !!返回一个布尔类型 false
        return !!$roles->intersect($this->role)->count();
    }

    /**
     * 给用户分配角色
     */
    public function assignRole($role){
        return $this->role()->save($role);

    }

    /**
     * 取消用户权限
     */
    public function deleteRole($role){
        return $this->role()->detach($role);
    }

    /**
     * 用户是否有权限
     */
    public function hasPermission($permission){
        return $this->isInRoles($permission->roles);
    }
}
