<?php

namespace app\index\model;


use think\Model;
//多对多测试
class Course extends Model
{
    //protected $hidden = ['pivot'];
    public function student(){

        return $this->belongsToMany('student','stu_cour','cour_id','stu_id');

    }
}