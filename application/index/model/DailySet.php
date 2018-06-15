<?php
namespace app\index\model;

use think\Model;


class DailySet extends Model
{
    //定义主键(默认为id)
    protected $pk = 'id';
    // 设置当前模型对应的完整数据表名称(默认为当前类名,当类名和数据库表名不同时修改)
    protected $table = 'tp_daily_set';
    protected $autoWriteTimestamp = 'int';

    //类型转换测试
    protected $type = [  //设置类型自动转换，会在写入和读取的时候自动进行类型转换处理
        'create_time'  =>  'timestamp:Y/m/d',  //添加这个读取的时候格式改变
        'update_time'  =>  'timestamp:Y/m/d',
    ];

    public function getDateAttr($value)
    {
        return date('Y/m/d',$value);
    }

}