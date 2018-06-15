<?php
namespace app\index\model;

use think\Model;


class User extends Model
{
    //定义主键(默认为id)
    protected $pk = 'id';
    // 设置当前模型对应的完整数据表名称(默认为当前类名,当类名和数据库表名不同时修改)
    protected $table = 'tp_user';
    //只读字段用来保护某些特殊的字段值不被更改，这个字段的值一旦写入，就无法更改
    protected $readonly = ['name','email'];
    //时间戳测试
    protected $autoWriteTimestamp = 'int';  //自动写入创建和更新的时间戳字段要用save方法才行
    // 时间字段取出后的默认时间格式
    protected $dateFormat;
    /**获取器测试    获取器的作用是在获取数据的字段值后自动进行处理
     * @param $value
     * @return mixed
     */
    public function getStatusAttr($value)
    {
        $status = [-1=>'删除',0=>'禁用',1=>'正常',2=>'待审核'];
        return $status[$value];
    }

    public function getTitleTextAttr($value,$data)
    {
        $title_text = [-1=>'删除',0=>'禁用',1=>'正常',2=>'待审核'];
        return $title_text[$data['title_text']];
    }

    //类型转换测试
    protected $type = [  //设置类型自动转换，会在写入和读取的时候自动进行类型转换处理
        'status'    =>  'integer',
        'score'     =>  'float',
        'create_time'  =>  'timestamp:Y/m/d H:i:s',  //添加这个读取的时候格式改变
        'update_time'  =>  'timestamp:Y/m/d H:i:s',
        'info'      =>  'array',
    ];
    //数据自动完成指在不需要手动赋值的情况下对字段的值进行处理后写入数据库。
    //系统支持auto、insert和update三个属性，可以分别在写入、新增和更新的时候进行字段的自动完成机制，auto属性自动完成包含新增和更新操作
    //数据完成测试(先改变数据，再把改变的数据保存到数据库)可以配合修改器使用
    //修改器的作用是可以在数据赋值的时候自动进行转换处理
    protected $auto = ['name', 'ip']; //$user->data($data,true);使用data()方法装载数据时,有true参数时不需要,表单不存在的字段可以在这里定义,这样可以直接添加到数据库
    protected $insert = ['score'=>50];//提供默认值(前台没有值的时候,有值会覆盖)
    protected $update = [];

    protected function setNameAttr($value)  //Name为字段的名(修改器)
    {
        return strtolower($value);
    }

    protected function setIpAttr()
    {
        return request()->ip();
    }

    protected static function init()
    {
        //注册模型事件
        User::event('before_insert', function ($user) {
            dump($user->status);
//            if ($user->status != 1) {
//                return false;
//            }
        });
    }
    //模型关联
    public function profiles()
    {
        //hasOne('关联模型名','外键名','主键名',['模型别名定义'],'join类型');bind()绑定属性到父模型
        //多层嵌套无法绑定别名
        return $this->hasOne('Profile','user_id','id');//->bind(['ccc'=>'nickname']);
    }


}