<?php
namespace app\admin\controller;
use think\Controller;
use think\Db;
use think\Session;


class EmptyController extends AdminController
{
    function _initialize()
    {
        parent::_initialize();
    }
    //栏目列表
	public function index(){
        $catid = input('param.catid');
        $cat_res = DB::name('category')->where('id',$catid)->find();
        $this->assign('catid',$catid);
        $this->assign('module',$cat_res['module']);

        //站点id
        $siteid = $this->admin_siteid;
        //详细内容
        $res = DB::name($cat_res['module'])->where('catid',$catid)->where('siteid',$siteid)->order('orderid desc')->select();
        $this->assign('res',$res);

        $this->assign('catname',$cat_res['catname']);

        //单章
        if($cat_res['module'] == 'page'){
            $moduleid = $cat_res['moduleid'];
            //所有字段
            $arr_field = DB::name('field')->where('moduleid',$moduleid)->where('status',1)->order('orderid asc')->select();
            //整理 setup 字段
            $arr_field =  model('EmptyController') ->arrange_fields($arr_field);
            $this->assign('arr_field',$arr_field);
            //数据遍历
            $table_res = DB::name($cat_res['module'])->where('catid',$catid)->find();
            //数据处理(表单字段的数据显示)
            if($table_res) {
                $table_res = model('EmptyController')->table_data($table_res, $cat_res['moduleid']);
            }
            $this->assign('table_res',$table_res);
            //dump($table_res);
            return $this->fetch('empty/page');
        }else{
            return $this->fetch('empty/index');
        }
	}
	//单页添加和修改
    public function page(){
        $data = input('post.');
        unset($data['file']);
        $catid = $data['catid'];
        $cat_res = DB::name('category')->where('id',$catid)->find();
        $moduleid = $cat_res['moduleid'];
        //所有字段
        $fields = DB::name('field')->field('field,type')->where('moduleid',$moduleid)->select();
        //字段处理(添加和修改时)
        $newDate = model('emptyController')->add_edit_arrange_fields($fields,$data);
        //用以判断是新增还是修改
        $res_one = DB::name($cat_res['module'])->where('catid',$catid)->find();
        if($res_one){
            $res = DB::name($cat_res['module'])->where('catid',$catid)->update($newDate);
        }else{
            $res = DB::name($cat_res['module'])->insert($newDate);
        }
        if($res){
            $this->redirect('category/index');
        }
    }

	//添加
	public function add(){
		if(request()->isPost()){
			$data = input('post.');
			//加入站点id
            $data['siteid'] = $this->admin_siteid;

            unset($data['file']);
            $catid = $data['catid'];

            $cat = DB::name('category')->where('id',$catid)->find();
            $moduleid = $cat['moduleid'];
            //所有字段
            $fields = DB::name('field')->field('field,type')->where('moduleid',$moduleid)->select();
            //字段处理(添加和修改时)
            $newDate = model('emptyController')->add_edit_arrange_fields($fields,$data);

            $res = DB::name($cat['module'])->insert($newDate);
            if($res){
                $this->redirect('test1/index',array('catid'=>$catid));
            }
		}else {

            $catid = input('param.catid');
            $this->assign('catid', $catid);

            $cat_res = DB::name('category')->where('id',$catid)->find();
            $this->assign('module',$cat_res['module']);
            //所有字段
            $moduleid = $cat_res['moduleid'];
            $arr_field = DB::name('field')->where('moduleid',$moduleid)->where('status',1)->order('orderid asc')->select();
            //整理 setup 字段
            $arr_field =  model('EmptyController') ->arrange_fields($arr_field);
            $this->assign('arr_field',$arr_field);

            return $this->fetch('empty/add');
        }
	}

	//修改
    public function edit(){
        if(request()->isPost()){
            $data = input('post.');
            $data['siteid'] = $this->admin_siteid;
            unset($data['file']);
            $catid = $data['catid'];
            unset($data['catid']);
            $id = $data['id'];
            unset($data['id']);
            $cat = DB::name('category')->where('id',$catid)->find();
            //所有字段
            $moduleid = $cat['moduleid'];
            $fields = DB::name('field')->field('field,type')->where('moduleid',$moduleid)->select();
            //字段处理(添加和修改时)
            $newDate = model('emptyController')->add_edit_arrange_fields($fields,$data);
            $res = DB::name($cat['module'])->where('id',$id)->update($newDate);
            //dump($data);
            if($res){
                $this->redirect('test1/index',array('catid'=>$catid));
            }
        }else {
            //分类表id
            $catid = input('param.catid');
            $this->assign('catid',$catid);

            $id = input('param.id');
            $this->assign('id',$id);

            $cat = DB::name('category')->where('id',$catid)->find();
            $table_res = DB::name($cat['module'])->where('id',$id)->find();
            //数据处理(表单字段的数据显示)
            $table_res = model('EmptyController')->table_data($table_res,$cat['moduleid']);
            $this->assign('table_res',$table_res);

            //所有字段
            $moduleid = $cat['moduleid'];
            $arr_field = DB::name('field')->where('moduleid',$moduleid)->where('status',1)->order('orderid asc')->select();
            //整理setup字段(用于字段的html显示)
            $arr_field =  model('EmptyController') ->arrange_fields($arr_field);

            $this->assign('arr_field',$arr_field);
            return $this->fetch('empty/edit');
        }
    }

}
