<?php
namespace app\admin\controller;
use think\Controller;
use think\Db;
use think\Session;


class Index extends AdminController
{
	//首页
    public function index()
    {
        //有的权限存入树结构
        $one_tree = DB::name("authRule")->where('menustatus',1)->where('pid',0)->order('orderid asc')->select();
        if(UID != 1){
            //不是超级管理员的权限树（函数）
            $tree = Auth_tree($one_tree);
        }else{
            $tree = Auth_admin($one_tree);
        }
        $this->assign('tree',$tree);

        //站点遍历
        $index_site = DB::name('site')->select();
        $this->assign('index_site',$index_site);

        //当前站点
        $this->assign('new_site',$this->admin_siteid);

        //title标题
        if($this->admin_siteid == 1 ) {
            $title = 'cfg_webname';
        }else{
            $title = 'cfg_webname_' . $this->admin_site_name;
        }
        $this->assign('title',config($title));

        //身份
        $auth_g = DB::name('authGroup')->field('title')->where('group_id',UID)->find();
        $this->assign('auth_group_title',$auth_g['title']);
		return $this->fetch();
	}


    public function index_v2()
    {

        $version = Db::query('SELECT VERSION() AS ver');
        $config  = [
            'url'             => $_SERVER['HTTP_HOST'],
            'document_root'   => $_SERVER['DOCUMENT_ROOT'],
            'server_os'       => PHP_OS,
            'server_port'     => $_SERVER['SERVER_PORT'],
            'server_ip'       => $_SERVER['SERVER_ADDR'],
            'server_soft'     => $_SERVER['SERVER_SOFTWARE'],
            'php_version'     => PHP_VERSION,
            'mysql_version'   => $version[0]['ver'],
            'max_upload_size' => ini_get('upload_max_filesize')
        ];
        $this->assign('config', $config);
		return $this->fetch();
	}
    
}
