<?php

namespace App;

class AdminRole extends Model
{
    //
    protected  $table="admin_roles";

    //角色<->权限 多对多
    public function permission(){
        return $this->belongsToMany(\App\AdminPermission::class,'admin_permission_role','role_id','permission_id')->withPivot([
            'permission_id','role_id'
        ]);
    }

    /**
     * 给角色赋权限
     */
    public function grantPermission($permission){
        return $this->permission()->save($permission);
    }

    /**
     * 取消
     */
    public function deletePermission($permission){
        return $this->permission()->detach($permission);
    }

    /**
     * 判断角色是否有权限
     */
    public function hasPermission($permission){
        return $this->permission()->contains($permission);
    }
}
