<?php
namespace app\admin\Controller;
use think\Controller;
use think\Db;
use think\Session;
use \app\admin\model\Admin;
use think\Jump;
use think\Config;

class AdminController extends Controller
{

    protected function _initialize() {
        // 检查用户是否登录
        if(!session('user_auth')){
            $this->redirect('admin/common/login');
            exit();
        }else{
            define('UID',session('user_auth.uid') );
        }
        //站点
        if(Session::has('admin_siteid')){
            $this->admin_siteid = Session::get('admin_siteid');
            //站点标识
            $ty_site_name = DB::name('site')->where('id',$this->admin_siteid)->find();
            $this->admin_site_name = $ty_site_name['sitekey'];
        }else{
            $this->admin_siteid = 1;
            $this->admin_site_name = '';
        }

        //站点1的配置
        $all_site_config = DB::name('webconfig')->where('siteid',$this->admin_siteid )->select();
        foreach($all_site_config as $v){
            Config::set($v['varname'],$v['varvalue']);
        }
        $all_site_config = DB::name('webconfig')->where('vargroup',1 )->select();
        foreach($all_site_config as $v){
            Config::set($v['varname'],$v['varvalue']);
        }

        //检查权限
        if(session('user_auth.group_id')){

			if(session('user_auth.group_id') != 1){

				//当前用户组
				$gid = DB::name('authGroup')->where('group_id',session('user_auth.group_id'))->where('status',1)->find();

				if(!$gid){
					$this->error('用户组不存在或已被禁用');
				}

				//dump($gid['rules']);
				$admin_rules = rtrim($gid['rules'],',');
				$admin_rules_where = Explode_str(',',$admin_rules,'id','or');
				$admin_rules_res = DB::name('authRule')->where($admin_rules_where)->order('orderid asc')->select();

				$admin_all_rules = array();//所拥有的权限
				foreach($admin_rules_res as $v){
					array_push($admin_all_rules,strtolower($v['href']));
				}
                //加入模型的权限
				$admin_cate = DB::name('category')->select();
				foreach($admin_cate as $v){
				    $cate_index = $v['module'].'/index';
				    array_push($admin_all_rules,strtolower($cate_index));
                    array_push($admin_all_rules,strtolower('empty/add'));
                    array_push($admin_all_rules,strtolower('empty/edit'));
                    array_push($admin_all_rules,strtolower('empty/page'));
                }

                //加入无需验证的权限
                $authopen = DB::name('authRule')->where('authopen',1)->select();
                foreach($authopen as $v){
                    array_push($admin_all_rules,strtolower($v['href']));
                }

                //array_unique($admin_all_rules);

				$admin_con = request()->controller();
				$admin_act = request()->action();
				$admin_con_act = strtolower($admin_con.'/'.$admin_act);

				$user_log['uid']=session('user_auth.uid');
				$user_log['action']=$admin_con_act;
				$user_log['posttime']=time();
				$user_log_ju=Db::name('user_log')->where('action',$admin_con_act)->where('uid',$user_log['uid'])->find();
				if($user_log_ju){
					Db::name('user_log')->->where('uid',$user_log['uid'])->update($user_log);
				}else{
					Db::name('user_log')->insert($user_log);
				}


				if(!($admin_con_act == 'index/index' or  $admin_con_act == 'index/index_v2') ){

					if(!in_array($admin_con_act,$admin_all_rules)){
						$this->error('您没有权限',url('admin/index/index_v2'));
					}
				}
            }
        }else{
            $this->error('此用户没有权限');
        }

        //echo request()->controller();

	}


}
