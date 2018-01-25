<?php
namespace app\index\controller;
use think\Db;
use think\Session;


class Index extends IndexController
{
    public function index()
    {   

        return $this->fetch();
	}

	public function lists(){

        $input = input('param.');

        $cate_res =DB::name('category')->where('id',$input['catid'])->find();

        //dump($input);


        return $this->fetch($cate_res['template_list']);
    }
}
