<?php
// 当前模块行为扩展定义文件
return [
    'module_init'=> [
        'app\\index\\behavior\\Test', //注意行为的命名空间(下同)
    ],
//    'test'=> [//自定义标签位
//        'app\\demo\\behavior\\Demo',
//    ],
    'module_end'=> [
        'app\\index\\behavior\\Test',
    ],
    //................
];