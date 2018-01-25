<?php
namespace app\admin\controller;
use think\Controller;
use think\Db;
use think\Session;

class System extends AdminController
{
	//基本设置
    public function system()
    {
		if($_POST){
			$data = input('post.');
			//dump($data);
			foreach($data as $k=>$v){
				$sql = "UPDATE `sh_webconfig` SET `varvalue`='".$v."' WHERE (`varname`='".$k."')";
				Db::execute($sql);
			}
			
			$this->success("设置成功！",url('admin/system/system'));
		}else{
			$res = DB::name('webconfig')->where('siteid',$this->admin_siteid)->order('orderid ')->select();
			$this->assign('res',$res);

			//附件设置遍历
            $fujian = DB::name('webconfig')->where('vargroup',1)->order('orderid ')->select();
            $this->assign('fujian',$fujian);

			return $this->fetch();
		}
	}
	
    //增加新变量
	public function addSystem(){
		$data = input('post.');
		$data['varname'] = 'cfg_'.$data['varname'];
		$data['orderid'] = GetOrderID('webconfig');
		$res = DB::name('webconfig')->insert($data);
		if($data){
			$this->success("增加变量成功！",url('admin/system/system'));
		}
	}
    
	
	//站点配置
	public function site(){
		
		$res = DB::name('site')->select();
		$this->assign('res',$res);
		return $this->fetch();
	}
	
	//新增站点
	public function site_add(){
		
		if($_POST){
			$data = input('post.');
            $sitekey = $data['sitekey'];
            
            $si = DB::name('site')->where('sitekey',$sitekey)->find();
            if($si){
                $this->error('该站点标识已存在！');
                exit;
            }
            
            $vovo['sitename'] = $data['sitename'];
            $vovo['sitekey'] = $data['sitekey'];
            $res = DB::name('site')->insert($vovo);
            
            if($res){
                $newsiteid = Db::name('site')->getLastInsID();
                $prefix = config('database.prefix');
                $site_key = $data['sitekey'];
                $webname = $data['webname'];
                $weburl = $data['weburl'];
                $webpath = $data['webpath'];
                $webswitch = $data['webswitch'];
                
                $data_str = "INSERT INTO `".$prefix."webconfig` VALUES('$newsiteid','cfg_webname_$site_key','网站名称','0','string','$webname','1');
        		INSERT INTO `".$prefix."webconfig` VALUES('$newsiteid','cfg_weburl_$site_key','网站地址','0','string','$weburl','2');
        		INSERT INTO `".$prefix."webconfig` VALUES('$newsiteid','cfg_webpath_$site_key','网站目录','0','string','$webpath','3');
        		INSERT INTO `".$prefix."webconfig` VALUES('$newsiteid','cfg_author_$site_key','网站作者','0','string','saihuCMS Team','4');
        		INSERT INTO `".$prefix."webconfig` VALUES('$newsiteid','cfg_generator_$site_key','程序引擎','0','string','saihuCMS','5');
        		INSERT INTO `".$prefix."webconfig` VALUES('$newsiteid','cfg_keyword_$site_key','关键字设置','0','string','','6');
        		INSERT INTO `".$prefix."webconfig` VALUES('$newsiteid','cfg_description_$site_key','网站描述','0','bstring','','7');
        		INSERT INTO `".$prefix."webconfig` VALUES('$newsiteid','cfg_copyright_$site_key','版权信息','0','bstring','Copyright © 2010 - 2013 shkj.net All Rights Reserved','8');
        		INSERT INTO `".$prefix."webconfig` VALUES('$newsiteid','cfg_icp_$site_key','备案编号','0','string','','9');
        		INSERT INTO `".$prefix."webconfig` VALUES('$newsiteid','cfg_webswitch_$site_key','启用站点','0','bool','$webswitch','10');
        		INSERT INTO `".$prefix."webconfig` VALUES('$newsiteid','cfg_switchshow_$site_key','关闭说明','0','bstring','对不起，网站维护，请稍后登陆。<br />网站维护期间对您造成的不便，请谅解！','11');";
        
        		$querys = explode(';', $data_str);
        		foreach($querys as $sql)
        		{
        			if(trim($sql) == '') continue;
        			Db::execute($sql);
        		}
                
                $this->success("站点新增成功！",url('admin/system/site'));
                
            }
            
			
			
		}else{
			return $this->fetch();
		}
		
	}
	
	//修改站点
	public function site_update(){
		
        if($_POST){
            
            $post = input('post.');
            $data['sitename'] = $post['sitename'];
            $res = DB::name('site')->where('id',$post['id'])->update($data);
            
            if($res){
                $this->success("站点修改成功！",url('admin/system/site'));
            }
            
        }else{
            $id = input('param.id');
            $row = DB::name('site')->where('id',$id)->find();
            
            $this->assign('id',$id);
            $this->assign('row',$row);
    		return $this->fetch();   
            
        }
	}
	
	//删除站点
	public function site_del(){
		
		$post = input('post.');
        $id = $post['id'];
        
        if($id == 1){
            $return = array(
				'status' => 404,
                'msg' => '抱歉，不能删除默认站点！'
			);
            echo json_encode($return);
            exit();
        }
        
        $res = DB::name('site')->where('id',$id)->delete();
        if($res){

            //设置区分站点的表名
    		$tbnames = array('webconfig');
            
            $prefix = config('database.prefix');
    		//删除所有该站点信息
    		foreach($tbnames as $tbn)
    		{
    			Db::execute("DELETE FROM `".$prefix."$tbn` WHERE `siteid`=$id");
    		}

    		//设置登录站点
    		//$r = $dosql->GetOne("SELECT `id`,`sitekey` FROM `#@__site` ORDER BY `id` ASC");
            $r = DB::name('site')->order("id asc")->find();
    		if(isset($r['id']))
    		{
    			$_SESSION['siteid']  = $r['id'];
    			$_SESSION['sitekey'] = $r['sitekey'];
    		}
    		else
    		{
    			$_SESSION['siteid']  = '';
    			$_SESSION['sitekey'] = '';
    		}
            
            $return = array(
				'status' => 200,
                'msg' => '您已经永久删除了此站点！'
			);
            echo json_encode($return);
            exit();
            
        }
	}
}
