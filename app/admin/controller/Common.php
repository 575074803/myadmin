<?php
namespace app\admin\controller;
use think\Controller;
use think\Db;
use think\Session;
use \app\admin\model\Admin;

class Common extends controller
{
	
	//登录
	public function login(){
		
        if($_POST){
            
            $data = input('post.');
            
            $admin = new Admin();
            $UID = $admin->loginCheck($data['username'],$data['password']);
            
            if($UID > 0){
                
                $this->success('登录成功',url('admin/index/index'));
                
            }else{
                //登录失败提示信息
                $error =  $admin->showRegError($UID);
                $this->error($error);
                
            }
            
        }else{
            
            return $this->fetch();
        }
        
		
	}
    //退出
    public function loginout(){
        
        Session::clear();
        $this->redirect('admin/Common/login');
    }
    
    
}
