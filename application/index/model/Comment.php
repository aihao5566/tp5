<?php

namespace app\index\model;


use think\Model;

class Comment extends Model
{

    protected $insert = ['status'=>1];//提供默认值(前台没有值的时候,有值会覆盖)

    protected function setContentAttr($value)  //Name为字段的名(修改器)
    {
        return strtolower($value);
    }

    public function article()
    {
        return $this->belongsTo('article','art_id');
    }

}