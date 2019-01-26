<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

// [ 应用入口文件 ]

// 定义应用目录
define('APP_PATH', __DIR__ . '/../application/');
// 定义配置文件目录和应用目录同级(覆盖前面的配置)
//define('CONF_PATH', __DIR__.'/../config/');
//定义行为开启(可以不需要)
//define('APP_HOOK',true);
session_cache_limiter('private_no_cache');
header('Cache-Control:private');
// 加载框架引导文件
require __DIR__ . '/../thinkphp/start.php';
 // 读取自动生成定义文件
//$build = include '../build.php';
 // 运行自动生成自动生成定义文件
// \think\Build::run($build);
//日志
//\think\Log::init([
//    'type'  =>  'File',
//    'path'  =>  APP_PATH.'logs/'
//]);
