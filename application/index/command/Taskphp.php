<?php
namespace app\index\command;

use think\console\Command;
use think\console\Input;
use think\console\Output;
use think\console\input\Argument;
use think\console\input\Option;

// 载入taskphp入口文件
//composer require taskphp/taskphp这个会影响队列监听php think queue:listen
//require_once dirname(APP_PATH).'/vendor/taskphp/taskphp/src/taskphp/base.php';

/*class Taskphp extends Command{

    protected function get_config(){
        return [
            //任务列表
            'task_list'=>[
                //key为任务名，多任务下名称必须唯一
                'demo'=>[
                    'callback'=>['app\\index\\command\\Demo','run'],//任务调用:类名和方法
                    //指定任务进程最大内存  系统默认为512M
                    'worker_memory'      =>'1024M',
                    //开启任务进程的多线程模式
                    'worker_pthreads'   =>false,
                    //任务的进程数 系统默认1
                    'worker_count'=>1,
                    //crontad格式 :秒 分 时 天 月 年 周
                    'crontab'     =>'/5 * * * * * *',
                ],
            ],
        ];
    }
    protected function configure(){
        $this->addArgument('param', Argument::OPTIONAL);
        // 设置命令名称
        $this->setName($_SERVER['argv'][1])->setDescription('this is a taskphp!');
    }

    protected function execute(Input $input, Output $output){
        //系统配置
        $config= $this->get_config();
        //加载配置信息
        \taskphp\Config::load($config);
        //定义启动文件入口标记
        define("START_PATH", dirname(APP_PATH));
        //运行框架
        \taskphp\App::run();
    }
}*/