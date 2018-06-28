<?php
namespace app\index\validate;


use think\Request;
use think\Validate;

class BaseValidate extends Validate
{
    public function goCheck(){
        $param = Request::instance()->param();
        $result = $this->check($param);
        if (!$result){
            return false;
        }else{
            return true;
        }
    }

}