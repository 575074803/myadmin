<?php
namespace app\admin\controller;
use think\Controller;
use think\Db;
use think\Session;


class Category extends AdminController
{



    //栏目列表
	public function index(){
        /*
        $tang = getChildId(34);
        dump($tang);*/

		return $this->fetch();
	}
	
	//栏目添加
    public function add(){
        if($_POST){
            $data = input('post.');
            unset($data['file']);
            if(!empty($data['readgroup'])){
                $data['readgroup'] = implode(',',$data['readgroup']);
            }
            $mname = DB::name('module')->where('id',$data['moduleid'])->find();
            $data['module'] = $mname['name'];
            
            $m_catdir = DB::name('category')->where('id',$data['parentid'])->find();
            $data['parentdir'] = $m_catdir['catdir'].'/';
            
            $data['arrparentid'] = trim($m_catdir['arrparentid'].','.$data['parentid'],',');
            
            $res = DB::name('category')->insert($data);
            if($res){
                //$this->success("栏目添加成功",url('admin/category/index'));
                $this->redirect(url('category/index'));
            }
            
        }else{
            $id = input('param.id');
            if(!isset($id)){ $id = '';}
            $this->assign('pid',$id);
            if($id){
                $cate = DB::name('category')->where('id',$id)->find();
                $this->assign('moduleid',$cate['moduleid']);
            }else{
                $cate = DB::name('category')->order('orderid')->find();
                $this->assign('moduleid',$cate['moduleid']);
            }

            //模型目录
            $module = DB::name('module')->where('status',1)->order('orderid')->select();
            $this->assign('module',$module);
            //权限
            $quanx = DB::name('auth_group')->select();
            $this->assign('quanx',$quanx);
            
            $dir = ROOT_PATH .DS.'template/';
            //搜索一个文件夹，返回这个文件夹下的所有文件
            $res = GetFiles($dir);
            $files = array();
            //取出所有文件
            foreach($res as $k=>$v){
                if($v['type'] == 'dir'){
                    $dir2 = $dir.$v['name'].DS;
                    $res2 = GetFiles($dir2);
                    foreach($res2 as $k2=>$v2){
                        if($v2['type'] == 'file'){
                            $arr1=explode('.',$v2['name']);
                            array_push($files,$arr1[0]);
                        }
                    }
                }
                if($v['type'] == 'file'){
                    $arr2=explode('.',$v['name']);
                    array_push($files,$arr2[0]);
                }
                
            }
            $this->assign('files',$files);

            return $this->fetch();
        }
    }
    
    //修改栏目
    public function edit(){
        
        if($_POST){
            $data = input('post.');
            $id = $data['id'];
            unset($data['id']);
            unset($data['file']);
            if(!empty($data['readgroup'])){
                $data['readgroup'] = implode(',',$data['readgroup']);
            }
            $mname = DB::name('module')->where('id',$data['moduleid'])->find();
            $data['module'] = $mname['name'];
            
            $m_catdir = DB::name('category')->where('id',$data['parentid'])->find();
            $data['parentdir'] = $m_catdir['catdir'].'/';
            
            $data['arrparentid'] = trim($m_catdir['arrparentid'].','.$data['parentid'],',');
            
            $res = DB::name('category')->where('id',$id)->update($data);
            if($res){
                //$this->success("栏目修改成功",url('admin/category/index'));
                $this->redirect(url('category/index'));
            }
            
        }else{
            $id = input('param.id');
            $row = DB::name('category')->where('id',$id)->find();
            $this->assign('row',$row);
            
            //模型目录
            $module = DB::name('module')->where('status',1)->order('orderid')->select();
            $this->assign('module',$module);
            //权限
            $quanx = DB::name('auth_group')->select();
            $this->assign('quanx',$quanx);
            
            $dir = ROOT_PATH .DS.'template/';
            //搜索一个文件夹，返回这个文件夹下的所有文件
            $res = GetFiles($dir);
            $files = array();
            //取出所有文件
            foreach($res as $k=>$v){
                if($v['type'] == 'dir'){
                    $dir2 = $dir.$v['name'].DS;
                    $res2 = GetFiles($dir2);
                    foreach($res2 as $k2=>$v2){
                        if($v2['type'] == 'file'){
                            $arr1=explode('.',$v2['name']);
                            array_push($files,$arr1[0]);
                        }
                    }
                }
                if($v['type'] == 'file'){
                    $arr2=explode('.',$v['name']);
                    array_push($files,$arr2[0]);
                }
            }
            $this->assign('files',$files);
            return $this->fetch();
            
        }
        
        
    }
    
    
    //删除栏目
    public function del(){
        $id = input('post.id');
        //return $id;
        $ch_res = DB::name('category')->where('parentid',$id)->select();
        
        if($ch_res){
            $return = array(
				'status' => 404,
				'msg' => '请先删除其子栏目！',
			);
			echo json_encode($return);
			exit();
        }
        
        $res = DB::name('category')->where('id',$id)->delete();
        if($res){
            $return = array(
				'status' => 200,
				'msg' => '成功删除此栏目！',
			);
			echo json_encode($return);
			exit();
        }
        
    }

    //群体删除
    public function all_del(){
        $post = input('post.');
        $ids = $post['ids'];
        //return $ids;
        $id_str = '';
        $ids_arr = explode(',',$ids);
        foreach($ids_arr as $v){
            $child_id = getChildId($v);
            $id_str .= $v.',';
            if($child_id){
                $id_str .= $child_id.',';
            }
        }
        $arr = explode(',',rtrim($id_str,','));
        $arr = array_unique($arr);
        $str = implode(",", $arr);

        $res = DB::name('category')->where("id in ($str)")->delete();

        if($res){
            $return = array(
                'status' => 200,
                'msg'   =>'信息已删除'
            );
            echo json_encode($return);
        }
    }



    ##################类别管理###############################

    //类别列表
    public function cate(){

	    $this->assign('tablename','category');
	    return $this->fetch();
    }


    //类别添加
    public function cate_add(){
	    if($_POST){
	        $data = input('post.');
	        $data['pid'] = 0;
	        $data['posttime'] = time();

	        $res = DB::name('category_cate')->insert();
            if($res){
                $arr = array(
                    'status' =>200,
                    'msg' =>'添加成功',
                    'url'   =>url('category/cate')
                );
                return $arr;
            }

        }else{

	        $category = DB::name('category')->where('ismenu',1)->select();
	        $this->assign('category',$category);
	        return $this->fetch();
        }
    }

}
