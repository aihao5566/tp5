<?php

namespace app\demo\behavior;


use think\Hook;

class Demo {
    //只有run()方法的时候run会自动执行(存在对应的行为名是这里不执行,自定义的除外)
    //前提是定义过行为路径
    public function run(&$params){
        echo '钩子(行为)动作在init之后注册,也可以在前端监听';

        //Hook::add('app_init','app\\demo\\behavior\\Test');
    }

    //模块行为(tags文件定义了类就会触发)
//    public function moduleInit(&$params)
//    {
//        echo '<script>alert("我是行为moduleInit");</script>';
//    }

    //应用开始
//    public function appInit(&$params)
//    {
//        echo '<script>alert("我是行为appInit");</script>';
//    }

//    public function appEnd(&$params)
//    {
//        echo '<script>alert("我是行为appEnd");</script>';
//    }
//
    //只执行自定义的行为run留空，不能没有run方法
//    public function test(&$params)
//    {
//        echo '<script>alert("'.$params['a'].'");</script>';
//    }
}