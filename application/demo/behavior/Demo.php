<?php

namespace app\demo\behavior;

use think\Hook;

class Demo {
    //只有run()方法的时候run会自动执行(存在对应的行为名是这里不执行,自定义的除外)
    //前提是定义过行为路径
    public function run(&$params){

        echo '钩子(行为)动作在init之后注册,也可以在前端监听';

    }

}