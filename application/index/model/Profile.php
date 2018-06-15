<?php

namespace app\index\model;


use think\Model;
//测试关联
class Profile extends Model
{
    public function phone(){
        return $this->hasOne('Phone','profile_id','id');
    }
}