<?php
// 当前模块行为扩展定义文件
return [
    'module_init'=> [
//        'app\\index\\behavior\\Test', //如果定义了该类,没有实现该方法，会执行run()方法
    ],

    'test2'=> [//自定义标签位,如果该类没有这个方法写上run()方法,不会报错
        'app\\index\\behavior\\Test',
    ],

];