<?php

namespace app\index\controller;


use think\Controller;
use think\Cookie;
use think\Request;
use think\Session;

class Base extends Controller
{
    public $allowAllAction = [
        'index/index/login',
        'index/index/logout',
        'index/index/notify',//回调通知必须要不必登录
        'notify/ali',//回调通知必须要不必登录(路由测试)
        'notify',
        'index/index/pay',
    ];

    public function _initialize()
    {
        $request = Request::instance();
        $module = $request->module();
        $controller = strtolower($request->controller());
        $action = $request->action();
        $url = $module . '/' . $controller . '/' . $action;
        if (in_array($url, $this->allowAllAction)) {
//            if ($url == $this->allowAllAction[0]) {
//                if ($this->isLogin($url)) {
//                    $this->redirect('index/index');
//                }
//            }
            return true;
        } else {
            return $this->isLogin();
        }

    }

    public function isLogin()
    {
        if (session('?userinfo') ? session('userinfo') : $this->getCookie()) {
            return true;
        } else {
            $this->redirect('index/login');
        }
    }


    //可以用来验证是否篡改(可以抛出一个异常)
    public function getCookie()
    {
        if(session('?userinfo')){
            return true;
        }
        if (!session('?userinfo') && cookie('remember_me')) {
            //验证cookie是否被篡改
            
            $data = cookie('userinfo');
            session('userinfo', $data);
            return true;
        }
        return false;

    }

    public function checkLogin($data)
    {
        //todo数据库比对错误返回false

        //$data = ['uid'=>'123','username'=>'呵呵'];
        if (true) { //记住我
            //Cookie::set('name',[1,2,3]);
            //Session::set('name.item','thinkphp');
            //$data = json_encode($data['user']);
            cookie('remember_me', $data['user'], 60 * 6000);
            //session('user',$user) ;
        }
//        dump(session_id());
        session('userinfo', $data['user']);
        return true;

    }

}