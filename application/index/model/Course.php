<?php

namespace app\index\model;


use think\Model;
//多对多测试
class Course extends Model
{
    //protected $hidden = ['pivot'];
    public function student(){

        return $this->belongsToMany('student','stu_cour','stu_id','cour_id');

    }

    public function hasCourse($ids)
    {
        return $this->student()->where('cour_id',$ids)->count();
    }
}