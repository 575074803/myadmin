<?php
namespace app\admin\controller;
use think\Controller;
use think\Db;
use think\Session;
use think\Config;

class Auth extends AdminController
{
    //管理员列表
    public function admin_list(){

        $res = DB::name('admin')->select();
        
        foreach($res as $k=>$v){
            $group_id = $v['group_id'];
            $r = DB::name('authGroup')->where('group_id',$group_id)->find();
            $res[$k]['group_name'] = $r['title'];
        }
        
        $this->assign('res',$res);
        return $this->fetch();
    }
    
    //管理员添加
    public function admin_add(){
        
        if($_POST){
            $data = input('post.');
            $data['logintime'] = time();
            $data['loginip'] = getIP();
            //$data['password'] = md5(md5($data['password']));
            $data['password'] = think_ucenter_md5($data['password'],UC_AUTH_KEY);
            $res = DB::name('admin')->insert($data);
            if($res){
                $this->redirect('auth/admin_list');
            }
        }else{
            $res = DB::name('authGroup')->where('status',1)->select();
            $this->assign('res',$res);
            return $this->fetch();
        }
    }
    
    //管理员修改
    public function admin_edit(){
        if($_POST){
            $data = input('post.');
            $id = $data['id'];
            $data['password'] = md5(md5($data['password']));
            unset($data['id']);
            
            $res = DB::name('admin')->where('id',$id)->update($data);
            if($res){
                $this->redirect('auth/admin_list');
            }
        }
        $id = input('param.id');
        $row = DB::name('admin')->where('id',$id)->find();
        
        $res = DB::name('authGroup')->where('status',1)->select();
        
        $this->assign('id',$id);
        $this->assign('row',$row);
        $this->assign('res',$res);
        return $this->fetch();
    }
    
    ################################
    
    //用户组管理
    public function admin_group(){
        
        $res = DB::name('authGroup')->select();
        $this->assign('res',$res);
        return $this->fetch();
    }
    
    //用户组添加
    public function group_add(){
        if($_POST){
            $data = input('post.');
            $data['addtime'] = time();
            $data['status'] = 1;
            $res = DB::name('authGroup')->insert($data);
            if($res){
                //$this->success("用户组添加成功",url('admin/auth/adminGroup'));
                $this->redirect('auth/admin_group');
            }
        }
        
        return $this->fetch();
    }
    
    //用户组修改
    public function group_edit(){
        
        if($_POST){
            $data = input('post.');
            $group_id = $data['group_id'];
            unset($data['group_id']);
            
            $res = DB::name('authGroup')->where('group_id',$group_id)->update($data);
            if($res){
                //$this->success("用户组修改成功",url('admin/auth/adminGroup'));
                $this->redirect('auth/admin_group');
            }
            
        }
        
        $group_id = input('param.group_id');
        $row = DB::name('authGroup')->where('group_id',$group_id)->find();
        
        $this->assign('group_id',$group_id);
        $this->assign('row',$row);
        return $this->fetch();
    }

    //配置规则
    public function group_access(){
        
        if($_POST){
            
            $data = input('post.');
            $group_id = $data['group_id'];
            $rules = implode(",", $data['check_list']);
            
            $vovo['rules'] = $rules;
            
            $res = DB::name('authGroup')->where('group_id',$group_id)->update($vovo);
            
            if($res){
                //$this->success('配置权限成功',url('admin/auth/adminGroup'));
                $this->redirect('auth/admin_group');
            }
            
        }
        
        $group_id = input('param.group_id');
        $g = DB::name('authGroup')->where('group_id',$group_id)->find();
        
        $one_tree = DB::name("authRule")->where('pid',0)->order('orderid asc')->select();
        foreach($one_tree as $k=>$v){
            $two_tree = DB::name("authRule")->where('pid',$v['id'])->order('orderid asc')->select();
            //第二级目录存入child
                foreach($two_tree as $k2=>$v2){
                    $one_tree[$k]['child'][$k2] = $two_tree[$k2];
                    $three_tree = DB::name("authRule")->where('pid',$v2['id'])->order('orderid asc')->select();
                    //第三级目录存入operator
                    foreach($three_tree as $k3=>$v3){
                        $one_tree[$k]['child'][$k2]['operator'][$k3] = $three_tree[$k3];
                        $four_tree = DB::name("authRule")->where('pid',$v3['id'])->order('orderid asc')->select();
                        foreach($four_tree as $k4=>$v4){
                            $one_tree[$k]['child'][$k2]['operator'][$k3]['four'][$k4] = $four_tree[$k4];
                        }
                    }
                }
            
        }
        //选中并已保存的规则
        $this->assign('group_rules',$g['rules']);
        //所有的规则
        $this->assign('all_tree',$one_tree);
        //dump($one_tree);
        $this->assign('group_id',$group_id);
        return $this->fetch();
    }

    #############################
    
    
	//权限管理
    public function admin_rule()
    {
		return $this->fetch();
	}
	
    
    //权限添加
    public function rule_add(){
        
        if($_POST){
            $data = input('post.');
            $data['authopen'] = 1;//1 = 需要验证
             /*
            if(!preg_match("/^[A-Za-z0-9]+$/", $data['href'])){
                $this->error('控制器/方法 只能用数字和英文组成');
            } 
             */           
            if($data['pid'] == 0){
                $data['pidstr'] = 0;
                
            }else{
                $auth_one = DB::name('authRule')->where('id',$data['pid'])->find();
                $data['pidstr'] = $auth_one['pidstr'].','.$data['pid'];
            }

            $data['authopen'] = 0;
            
            $res = DB::name('authRule')->insert($data);
            
            if($res){
                //$this->success('权限添加成功',url('admin/auth/adminRule'));
                $this->redirect('auth/admin_rule');
            }
            
        }else{
            $pid = input('param.id');
            $this->assign('pid',$pid);
            return $this->fetch();
        }
    }
    
    
    //权限修改
    public function rule_edit(){
        
        if($_POST){
            $data = input('post.');
            $id = $data['id'];
            
            unset($data['id']);
            /*
            if(!preg_match("/^[A-Za-z0-9]+$/", $data['href'])){
                $this->error('控制器/方法 只能用数字和英文组成');
            } 
              */          
            if($data['pid'] == 0){
                $data['pidstr'] = 0;
                
            }else{
                $auth_one = DB::name('authRule')->where('id',$data['pid'])->find();
                $data['pidstr'] = $auth_one['pidstr'].','.$data['pid'];
            }
            
            $res = DB::name('authRule')->where('id',$id)->update($data);
            
            if($res){
                //$this->success('权限修改成功',url('admin/auth/adminRule'));
                $this->redirect('auth/admin_rule');
            }
            
        }
        
        $id = input('param.id');
        $row = DB::name('authRule')->where('id',$id)->find();
        $this->assign('row',$row);
        
        return $this->fetch();
    }

    //群体删除
    public function rule_all_del(){
        $post = input('post.');
        $ids = $post['ids'];
        //return $ids;
        $id_str = '';
        $ids_arr = explode(',',$ids);
        foreach($ids_arr as $v){
            $child_id = getChildId($v,'authRule','pid');
            $id_str .= $v.',';
            if($child_id){
                $id_str .= $child_id.',';
            }
        }
        $arr = explode(',',rtrim($id_str,','));
        $arr = array_unique($arr);
        $str = implode(",", $arr);

        $res = DB::name('authRule')->where("id in ($str)")->delete();

        if($res){
            $return = array(
                'status' => 200,
                'msg'   =>'信息已删除'
            );
            echo json_encode($return);
        }
    }
  
}
