<?php
namespace app\admin\controller;
use think\Controller;
use think\Db;
use think\Session;


class Message extends AdminController
{
    //留言列表
    public function index(){
        //站点id
        $siteid = $this->admin_siteid;
        $res = DB::name('message')->where('siteid',$siteid)->order('orderid asc')->select();
        $this->assign('res',$res);
        $this->assign('tablename','message');
        return $this->fetch();
    }

    //留言 回复
    public function edit(){

        if($_POST){
            $data = input('post.');
            $id = $data['id'];
            unset($data['id']);
            $data['posttime'] = strtotime($data['posttime']);
            $res = DB::name('message')->where('id',$id)->update($data);
            if($res){
                $this->redirect('index');
            }
        }else{
            $id = input('param.id');
            $row = DB::name('message')->where('id',$id)->find();
            $this->assign('row',$row);
            return $this->fetch();
        }
    }

}
