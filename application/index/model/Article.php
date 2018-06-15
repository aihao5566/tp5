<?php

namespace app\index\model;


use think\Model;

class Article extends Model
{
    public function comments()
    {
        return $this->hasMany('Comment','art_id');
    }

}