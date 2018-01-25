<?php
namespace app\admin\controller;
use think\Controller;
use think\Db;
use app\common\util\Pageclass;
use think\File;
use think\Session;

class Ajaxdo extends Controller
{
	//改变字段状态 （弃用）
    public function check(){
        $post = input('post.');
        $data[$post['field']] = $post['value'];
        $res = Db::name($post['tablename'])->where('id',$post['id'])->update($data);
        
        $post['value'] == 1 ? $post['value'] = 0 : $post['value'] = 1;
        if($res){
            $return = array(
				'status' => 200,
                'value' => $post['value'],
			);
            echo json_encode($return);
        }
    }
    //改变字段状态(弃用)
    public function groupIdStatus(){
        $post = input('post.');
        $data[$post['field']] = $post['value'];
        $res = Db::name($post['tablename'])->where('group_id',$post['id'])->update($data);
        
        $post['value'] == 1 ? $post['value'] = 0 : $post['value'] = 1;
        if($res){
            $return = array(
				'status' => 200,
                'value' => $post['value'],
			);
            echo json_encode($return);
        }
    }
    //排序
    public function ajax_sort(){
        $post = input('post.');
        
        $data['orderid'] = $post['tval'];
        $res = Db::name($post['tablename'])->where('id',$post['id'])->update($data);
        
        if($res){
            $return = array(
				'status' => 200,
                'msg' => '排序已更改',
			);
            echo json_encode($return);
        }
    }
    //所有排序
    public function ajax_all_sort(){
        $post = input('post.');

        $tablename = $post['tablename'];
        $ids = explode(',',rtrim($post['ids'],','));
        $orderids = explode(',',rtrim($post['orderids'],','));

        $arr = array_combine($ids,$orderids);

        foreach($arr as $k=>$v){
            DB::name($tablename)->where('id',$k)->update(['orderid'=>$v]);
        }
        $return = array(
            'status' => 200,
        );
        echo json_encode($return);
    }

    //删除 弹出框（有下级栏目的单删除）
    public function ajax_alert(){
        $post = input('post.');

        $auth =  DB::name($post['tablename'])->where('pid',$post['id'])->select();
        if($auth){
            $return = array(
                'status' => 404,
                'msg' =>'请先删除子栏目'
            );
            echo json_encode($return);
            exit;
        }

        $res = Db::name($post['tablename'])->where($post['whereid'],$post['id'])->delete();
        
        if($res){
            $return = array(
				'status' => 200
			);
            echo json_encode($return);
        }
        
    }

    //删除单个
    public function ajax_one_del(){
        $post = input('post.');
        $res = Db::name($post['tablename'])->where($post['whereid'],$post['id'])->delete();
        if($res){
            $return = array(
                'status' => 200
            );
            echo json_encode($return);
        }
    }

    //群删除
    public function ajax_all_del(){
        $post = input('post.');
        $ids = $post['ids'];
        $tablename = $post['tablename'];
        $arr = explode(',',$ids);

        foreach($arr as $v){
            DB::name($tablename)->where('id',$v)->delete();
        }

        $return = array(
            'status' => 200,
            'msg'   =>'信息已删除'
        );
        echo json_encode($return);

    }


    
    //删除  模板删除
    public function temp_delete(){
        
        $post = input('post.');
        $dir = ROOT_PATH .DS.'template/';
        
        if($post['dtype'] == 'file'){
            $file = $dir.$post['fname'];
            $res = unlink($file);
        }else{
            $file = $dir.$post['fname'];
            $res = delDirAndFile($file);
        }
        
        if ($res){
            $return = array(
				'status' => 200
			);
            echo json_encode($return);
            
        }else{
           $return = array(
				'status' => 404
			);
            echo json_encode($return);   
        }
        
    }

    //设置站点
    public function setSite(){
        $siteid = input('post.siteid');
        Session::set('admin_siteid',$siteid);
        if(Session::has('admin_siteid')){
            $return = array(
                'status' => 200,
                'msg' => '站点设置成功！',
            );
            echo json_encode($return);
        }
    }

    //字段管理 -- 改变字段状态(最新启用)
    public function field_status(){
        $post = input('post.');
        $id = $post['id'];
        $tablename = $post['tablename'];
        $field = $post['field'];
        if(isset($post['field_id'])){ $field_id = $post['field_id'];}else{ $field_id = 'id';}

        $fie = DB::name($tablename)->where($field_id,$id)->find();

        if($fie[$field] == 1){
            //启用变禁用
            $data[$field] = 0;
            $status = 'jing';
        }else{
            //禁用变启用
            $data[$field] = 1;
            $status = 'qi';
        }

        $res = DB::name($tablename)->where($field_id,$id)->update($data);
        if($res){
            $return = array(
                'status' => $status
            );
            echo json_encode($return);
        }

    }


    //群体删除（最新启用,子类也都删除）
    public function all_del(){
        $post = input('post.');
        $ids = $post['ids'];
        $tablename = $post['tablename'];
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

        $res = DB::name($tablename)->where("id in ($str)")->delete();
        if($res){
            $return = array(
                'status' => 200,
                'msg'   =>'信息已删除'
            );
            echo json_encode($return);
        }
    }

}
