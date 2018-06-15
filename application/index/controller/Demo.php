<?php
namespace app\index\controller;
use think\Controller;

class Demo extends Controller
{
	/**测试模板继承
	 * [idnex description]
	 * @return [type] [description]
	 */
	public function index()
	{
		return $this->fetch();
	}

	public function pageOne()
	{
		return $this->fetch();
	}


	public function idnexTow()
	{
		return $this->fetch();
	}
} 