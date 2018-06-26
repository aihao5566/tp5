<?php
namespace app\index\command;

use taskphp\Utils;
/**
 * 测试任务
 */
class Demo{
    /**
     * demo任务入口
     */
    public static function run(){
        Utils::log('demo1任务运行成功');
        //可以调用thinkphp内的json函数
        //Utils::log(json(['message'=>'hello taskphp']));
    }
}