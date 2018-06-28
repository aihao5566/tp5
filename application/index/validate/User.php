<?php
namespace app\index\validate;

use think\Validate;

class User extends BaseValidate
{
    protected $rule = [
        // 'name'  =>  'require|max:25|strlen:',
        'name|姓名'  =>  ['require','max'=>60,'strlen'=>'strlen'],//数组形式
        'age|年龄'   => 'require|number|between:1,120',//字符串形式
        'email|邮箱' =>  'require|email',
        'password|密码' =>  'require',
        'repassword|确认密码'=>'require|confirm:password',
        'address|地址' =>  'require',
    ];

    protected $message  =   [
        'name.require' => '名称不得为空',
        'name.max'     => '名称最多不能超过25个字符',
        'name.strlen'     => '名称最少不能小于5个字符最多不能超过25个字符',
        'age.number'   => '年龄必须是数字',
        'age.between'  => '年龄只能在1-120之间',
        'email'        => '邮箱格式错误',
        'repassword.confirm'        => '两次输入不一致',
        'password.confirm'        => '两次输入不一致',

    ];

    /**场景设置**/
    protected  $scene = [
        'add' => ['name', 'password','repassword'],// 添加
    ];

    protected function strlen($value,$rule,$data,$filed,$title){  //自定义验证规则要加 “ ：”
        // echo $filed,$title;die;
        return strlen($value)>5 && strlen($value)<60 ? true : false;//或者false改为错误信息
    }


}