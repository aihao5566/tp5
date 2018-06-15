<?php

namespace app\index\model;


use think\Model;
//多对多
class Student extends Model
{
    protected $hidden = ['pivot'];
    public  function course(){
        //cour_id是关联中间表的关联course表的外键id，而stu_id也是中间表关联学生表的外键id
        //两个id都是中间表关联其他表的外键id
        //belongsToMany('关联模型名','中间表名','外键名','当前模型关联键名',['模型别名定义']);
        return $this->belongsToMany('course','stu_cour','cour_id','stu_id');
    }

}