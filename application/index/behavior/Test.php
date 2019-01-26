<?php

namespace app\index\behavior;


use think\Hook;

class Test {
    //只有run()方法的时候run会自动执行(存在对应的行为名时这里不执行,自定义的除外)
    //前提是定义过行为路径
    public function run(&$params){  //定义了行为类就执行(tags)
//        echo '<script>alert("我是run");</script>';
//        echo '钩子(行为)init'.'<br />';//因为系统本身定义了监听位，所以只要定义了这里就执行,控制器或前端在定义一次的话就输出两次
        //在behavior定义的类,直接运行run方法,在把这个test1加入,直到监听listen才运行
        Hook::add('test1','app\\demo\\behavior\\Demo');//添加行为
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