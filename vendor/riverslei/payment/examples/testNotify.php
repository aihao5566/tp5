<?php

use Payment\Notify\PayNotifyInterface;
use Payment\Config;

/**
 * @author: helei
 * @createTime: 2016-07-20 18:31
 * @description:
 */

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
            if (!is_dir('big/')) mkdir('big/', 0777);
            //$myfile = fopen("big/log.txt", "w");
            //fwrite($myfile, $txt);
            $this->writeLog(var_export($_POST,true));
        } elseif ($channel === Config::WX_CHARGE) {// 微信支付
        } elseif ($channel === Config::CMB_CHARGE) {// 招商支付
        } elseif ($channel === Config::CMB_BIND) {// 招商签约
        } else {
            // 其它类型的通知
        }

        // 执行业务逻辑，成功后返回true
        return true;
    }

    //请确保项目文件有可写权限，不然打印不了日志。
    public function writeLog($text) {
        // $text=iconv("GBK", "UTF-8//IGNORE", $text);
        //$text = characet ( $text );
        file_put_contents ( dirname ( __FILE__ ).DIRECTORY_SEPARATOR."./big/log.txt", date ( "Y-m-d H:i:s" ) . "  " . $text . "\r\n", FILE_APPEND );
    }
}
