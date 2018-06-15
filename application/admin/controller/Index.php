<?php
namespace app\admin\controller;

use think\Cookie;
use think\Session;

class Index
{
    public function index()
    {

        return dump(session('')).dump(cookie('')).'admin/index/index';
    }
}
