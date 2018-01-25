<?php

// +----------------------------------------------------------------------
// | Atcfw.com [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Author: wanggenfu <583983303@qq.com>
// +----------------------------------------------------------------------

namespace app\admin\model;
use think\Controller;
use think\Db;
use Think\Model;

Class Admin extends Controller {
    
    //验证登录用户
	public function loginCheck($username,$password) {
        /* 获取用户数据 */
        $user = DB::name('admin')->where('username',$username)->find();
		if(is_array($user) && $user['is_open']){
			/* 验证用户密码 采用字符串加密*/ 
			if(think_ucenter_md5($password, UC_AUTH_KEY) === $user['password']){
					$this->updateLogin($user['id']); //更新用户登录信息
					$this->autoLogin($user); //更新session数据
					
					return $user['id']; //登录成功，返回用户ID
			} else {
					return -2; //密码错误
			}
		}else{
			return -1;//此用户不存在或被禁用
		}
		
		
    }
	/**
     * 更新用户登录信息
     * @param  integer $uid 用户ID
     */
    protected function updateLogin($uid){
		$data = array(
				'logintime' => time(),
				'loginip'   => getIP(),
		);
		DB::name('admin')->where('id',$uid)->update($data);
    }
	
	/**
	 * 更新session数据
	 * @param  integer $user 用户信息数组
	*/
    private function autoLogin($user){
        
        /* 记录登录SESSION和COOKIES */
        $auth = array(
            'uid'             => $user['id'],
            'username'        => $user['username'],
            'nickname'        => $user['nickname'],
            'group_id'        => $user['group_id'],
            'logintime' => $user['logintime'],
        );

        session('user_auth', $auth);
        //session('user_auth_sign', data_auth_sign($auth));

    }
	
	
	/**
     * 获取错误信息
     * @param  integer $code 错误编码
     * @return string        错误信息
     */
    public function showRegError($code = 0){
        switch ($code) {
            case -1:  $error = '此用户不存在或被禁用'; break;
            case -2:  $error = '密码错误'; break;
            
            default:  $error = '未知错误';
        }
        return $error;
    } 
	
}
