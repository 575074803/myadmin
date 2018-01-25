<?php
namespace app\admin\controller;
use think\Controller;
use think\Db;
use think\Session;


class Link extends AdminController
{
    
    //友情链接类别
    public function type(){
        //站点id
        $this->assign('siteid',$this->admin_siteid);

        $this->assign('tablename','weblinktype');
        return $this->fetch();

    }
    //友情链接类别 添加
    public function type_add(){
        if($_POST){
            $data = input('post.');
            $data['orderid'] = GetOrderID('weblinktype');
            $m_catdir = DB::name('weblinktype')->where('id',$data['parentid'])->find();
            $data['parentstr'] = trim($m_catdir['parentstr'].','.$data['parentid'],',');
            $data['checkinfo'] = 1;
            //站点id
            $data['siteid'] = $this->admin_siteid;
            $res = DB::name('weblinktype')->insert($data);
            if($res){
                $this->redirect('link/type');
            }
        }else{
            $id = input('param.id');
            if($id){
                $this->assign('pid',$id);
            }else{
                $this->assign('pid','');
            }
            //站点id
            $this->assign('siteid',$this->admin_siteid);

            return $this->fetch();
        }
    }

    //友情链接类别 修改
    public function type_edit(){
        if($_POST){
            $data = input('post.');
            $id = $data['id'];
            unset($data['id']);

            $m_catdir = DB::name('weblinktype')->where('id',$data['parentid'])->find();
            $data['parentstr'] = trim($m_catdir['parentstr'].','.$data['parentid'],',');
            //站点id
            $data['siteid'] = $this->admin_siteid;

            $res = DB::name('weblinktype')->where('id',$id)->update($data);
            if($res){
                $this->redirect('link/type');
            }
        }else{
            $id = input('param.id');
            $row = DB::name('weblinktype')->where('id',$id)->find();
            $this->assign('row',$row);
            $parentid = $row['parentid'];
            $this->assign('parentid',$parentid);
            //站点id
            $this->assign('siteid',$this->admin_siteid);
            return $this->fetch();
        }
    }

    //友情链接类别 删除
    public function type_del(){
        $post = input('post.');

        $auth =  DB::name($post['tablename'])->where('parentid',$post['id'])->select();
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

    //友情链接类别 多选删除
    public function type_all_del(){

        $post = input('post.');
        $ids = $post['ids'];
        //return $ids;
        $id_str = '';
        $ids_arr = explode(',',$ids);
        foreach($ids_arr as $v){
            $child_id = getChildId($v,'weblinktype');
            $id_str .= $v.',';
            if($child_id){
                $id_str .= $child_id.',';
            }
        }
        $arr = explode(',',rtrim($id_str,','));
        $arr = array_unique($arr);
        $str = implode(",", $arr);

        $res = DB::name('weblinktype')->where("id in ($str)")->delete();

        if($res){
            $return = array(
                'status' => 200,
                'msg'   =>'信息已删除'
            );
            echo json_encode($return);
        }

    }


    #####################友情链接开始#############################################################

    public function index(){
        //站点id
        $siteid = $this->admin_siteid;
        $res = DB::name('weblink')->where('siteid',$siteid)->order('orderid desc')->select();
        $this->assign('res',$res);
        $this->assign('tablename','weblink');
        return $this->fetch();
    }
    //添加
    public function add(){
        if($_POST){
            $data = input('post.');
            unset($data['file']);
            $data['posttime'] = strtotime($data['posttime']);
            $data['orderid'] = GetOrderID('weblink');
            $data['checkinfo'] = 1;
            //站点id
            $data['siteid'] = $this->admin_siteid;
            $res = DB::name('weblink')->insert($data);
            if($res){
                $this->redirect('link/index');
            }
        }else{
            //站点id
            $this->assign('siteid',$this->admin_siteid);
            return $this->fetch();
        }
    }

    //修改
    public function edit(){
        if($_POST){
            $data = input('post.');
            unset($data['file']);
            $id = $data['id'];
            unset($data['id']);
            $data['posttime'] = strtotime($data['posttime']);
            //站点id
            $data['siteid'] = $this->admin_siteid;

            $res = DB::name('weblink')->where('id',$id)->update($data);
            if($res){
                $this->redirect('link/index');
            }
        }else{
            $id = input('param.id');
            $row = DB::name('weblink')->where('id',$id)->find();
            $this->assign('classid',$row['classid']);
            $this->assign('row',$row);
            //站点id
            $this->assign('siteid',$this->admin_siteid);
            return $this->fetch();
        }

    }

}
