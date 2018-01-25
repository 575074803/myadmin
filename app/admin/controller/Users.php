<?php
namespace app\admin\controller;
use think\Controller;
use think\Db;
use think\Session;


class Users extends AdminController
{

    //会员列表
    public function index(){

        $row =  DB::name('member')->order('id desc')->select();
        $this->assign('row',$row);
        return $this->fetch();
    }

    //会员添加
    public function add(){
        if($_POST){
            $data = input('post.');
            $data['regtime'] = time();
            if($data['password']){
                $data['password'] = md5(md5(trim($data['password'])));
            }else{
                $data['password'] = md5(md5('123456'));
            }
            $res = DB::name('member')->insert($data);
            if($res){
                $this->success('添加会员成功',url('users/index'));
            }
        }else{
            $member_level = DB::name('member_level')->order('orderid asc')->select();
            $this->assign('memeber_level',$member_level);
            return $this->fetch();
        }

    }

    //会员修改
    public function edit(){
        if($_POST){
            $data = input('post.');
            $id = $data['id'];
            unset($data['id']);

            if($data['password']){
                $data['password'] = md5(md5(trim($data['password'])));
            }
            $res = DB::name('member')->where('id',$id)->update($data);
            if($res){
                $this->success('修改会员成功',url('users/index'));
            }
        }else{
            $id = input('param.id');
            $row = DB::name('member')->where('id',$id)->find();
            $this->assign('row',$row);

            $member_level = DB::name('member_level')->order('orderid asc')->select();
            $this->assign('memeber_level',$member_level);

            return $this->fetch();
        }

    }


    //会员组
    public function user_group(){
        $row = DB::name('member_level')->order('orderid asc')->select();
        $this->assign('row',$row);
        return $this->fetch();
    }

    //添加会员组
    public function group_add(){
        if($_POST){
            $data=input('post.');

            $res =DB::name('member_level')->insert($data);
            if($res){
                $this->success('会员组添加成功',url('users/user_group'));
            }
        }else{
            return $this->fetch();
        }
    }
    //修改会员组
    public function group_edit(){
        if($_POST){
            $data = input('post.');
            $id = $data['id'];
            unset($data['id']);

            $res =    DB::name('member_level')->where('id',$id)->update($data);
            if($res){
                $this->success('修改会员组成功',url('users/user_group'));
            }
        }else{
            $id = input('param.id');
            $row = DB::name('member_level')->where('id',$id)->find();
            $this->assign('row',$row);
            return $this->fetch();
        }

    }

    //会员组单个删除
    public function group_del(){
        $id = input('post.id');
        $res = DB::name('member_level')->where('id',$id)->delete();

        if($res){
            $return = array(
                'status' => 200,
                'msg' => '删除成功！',
            );
            echo json_encode($return);
        }
    }

}
