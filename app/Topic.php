<?php

namespace App;

use App\Model;
class Topic extends Model
{
    //属于这个专题的文章
    public function posts(){
      return  $this->belongsToMany(\App\Post::class,'post_topics','topic_id','post_id');
    }

    //专题文章的数量
    public function postTopic(){
       return $this->hasMany(\App\PostTopic::class,'topic_id','id');
    }
}

