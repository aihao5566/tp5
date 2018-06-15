<?php
namespace app\index\controller;
use think\Controller;

class Test extends Controller
{
	/**测试模板布局 需要配置config
	 * [idnex description]
	 * @return [type] [description]
	 */
	public function index()
	{
		$this->assign('title','index');
		return $this->fetch();
	}

	public function pageOne()
	{
		$this->assign('title','pageOne');
		return $this->fetch();
	}


	public function pageTwo()
	{
		$this->assign('title','pageTow');
		return $this->fetch();
	}
} 