<?php

namespace app\index\model;


use think\Model;

class Blog extends Model
{

    //模型关联
    public function contents()
    {
        //hasOne('关联模型名','外键名','主键名',['模型别名定义'],'join类型');
        return $this->hasOne('Content','blog_id','id');
    }
}