<?php

namespace app\index\model;


use think\Model;

class Article extends Model
{
    public function comments()
    {
        return $this->hasMany('Comment','art_id')->order('id ASC');
    }


    public function CommentsList($map)
    {
        $data = $this->relation('comments')->field(true)->where($map)->find();
        return $data;
    }

}