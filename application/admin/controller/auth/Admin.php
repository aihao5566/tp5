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
        $this->loadlang($controllername);
        // 切换多语言
        if (Config::get('lang_switch_on') && $this->request->get('lang'))
        {
            \think\Cookie::set('think_var', $this->request->get('lang'));
        }

        // 语言检测
        $lang = strip_tags($this->request->langset());
        $lang = $this->request->langset('en');
        halt($lang);
        $config = ['language' => $lang];
        $this->assign('config',$config);
        return $this->fetch();
    }

    public function edit(){
        return '222222';
    }

    //http://tp5.com/index.php/admin/auth/admin/index?lang=en  测试多语言
    /**
     * 加载语言文件
     * @param string $name
     */
    protected function loadlang($name)
    {
        Lang::load(APP_PATH . $this->request->module() . '/lang/' . $this->request->langset() . '/' . str_replace('.', '/', $name) . '.php');
    }
}