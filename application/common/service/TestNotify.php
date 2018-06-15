<?php
namespace app\common\service;
use app\index\model\User;
use Payment\Notify\PayNotifyInterface;
use Payment\Config;


/**
 * 客户端需要继承该接口，并实现这个方法，在其中实现对应的业务逻辑
 * Class TestNotify
 * anthor helei
 */
class TestNotify implements PayNotifyInterface
{
    public function notifyProcess(array $data)
    {
        $channel = $data['channel'];
        if ($channel === Config::ALI_CHARGE) {// 支付宝支付
            User::get(function($query){
                $query->where('id','=',128)->setInc('score');//测试
            });
            //if (!is_dir('big/')) mkdir('big/', 0777);
        } elseif ($channel === Config::WX_CHARGE) {// 微信支付
        } elseif ($channel === Config::CMB_CHARGE) {// 招商支付
        } elseif ($channel === Config::CMB_BIND) {// 招商签约
        } else {
            // 其它类型的通知
        }



        // 执行业务逻辑，成功后返回true

        return true;
    }
}