<?php

namespace App;

use App\Model;

use Illuminate\Foundation\Auth\User as Authenticatable;
class User extends Authenticatable
{
    //
    protected  $table='users';
    protected $fillable=[
      'name','email','password'
    ];

    //用户文章列表
    public function posts(){
        return $this->hasMany(\App\Post::class,'user_id','id');
    }

    //关注的fan用户
    public function fans(){
        return $this->hasMany(\App\Fan::class,'star_id','id');
    }

    //我关注的fan
    public function stars(){
        return $this->hasMany(\App\Fan::class,'fan_id','id');
    }

    //like
    public function doFan($uid){
        $fan=new \App\Fan();
        $fan->star_id=$uid;
        $this->stars()->save($fan);
    }

    //取消关注
    public function doUnFan($uid){
        $fan=new \App\Fan();
        $fan->star_id=$uid;
        $this->stars()->delete();
    }

    //当前用户是否被关注
    public function hasFan($uid){
       return $this->fans()->where('fan_id',$uid)->count();
    }

    //当前用户是否关注了uid
    public function hasStar($uid)
    {
        return $this->stars()->where('star_id',$uid)->count();
    }

    /**
     * 用户收到的通知
     * 多对多
     */
    public function notices(){
        return $this->belongsToMany(\App\Notice::class,'user_notice','user_id','notice_id')->withPivot(['user_id','notice_id']);
    }

    /**
     * 发送通知
     */
    public function addNotice($notice){
        return $this->notices()->save($notice);
    }
}
