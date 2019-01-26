<?php

namespace app\admin\controller\auth;

use think\Config;
use think\Controller;
use think\Lang;

// 类似于多级控制器
//可以使用http://tp5.com/index.php/admin/auth/admin/edit访问
//需要修改配置 controller_auto_search
class Admin extends Controller
{
    public function index(){
        $controllername = strtolower($this->request->controller());
        // 切换多语言(可以写在行为扩展上)
        if (Config::get('lang_switch_on') && $this->request->get('lang'))
        {
            \think\Cookie::set('think_var', $this->request->get('lang'));
        }

        // 语言检测
        $lang = strip_tags($this->request->langset());
        //加载当前控制器语言包
        $this->loadlang($controllername);
        $config = ['language' => $lang];
        $this->assign('config',$config);
//        $this->redirect('index/index');
        return $this->fetch();
    }

    public function edit(){
        $controllername = strtolower($this->request->controller());
        //加载当前控制器语言包
        $this->loadlang($controllername);

        return $this->fetch();
    }

    //http://tp5.com/index.php/admin/auth/admin/index?lang=en  测试多语言
    //有cookie前缀对应不上Lang类的语言Cookie变量think_var，所以无法使用cookie设置多语言。
    /**
     * 加载语言文件
     * @param string $name
     */
    protected function loadlang($name)
    {
        Lang::load(APP_PATH . $this->request->module() . '/lang/' . $this->request->langset() . '/' . str_replace('.', '/', $name) . '.php');
    }
}