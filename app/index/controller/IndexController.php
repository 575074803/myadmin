<?php
namespace app\index\controller;
use think\Controller;
use think\Db;
use think\Session;


class IndexController extends Controller
{
    protected function _initialize() {

        $category = DB::name('category')->where('ismenu',1)->select();
        $this->assign('category',$category);
    }
}
