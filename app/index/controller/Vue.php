<?php
namespace app\index\controller;
use think\Controller;
use think\Db;
use think\Session;


class Vue extends Controller
{
	//得到导航数据
    public function getNav()
    {   
        
        $res = DB::name('category')->where('parentid',0)->select();
        return $res;
        //return $this->fetch();
	}
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
}
