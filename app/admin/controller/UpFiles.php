<?php
namespace app\admin\controller;
use think\Controller;
use think\Db;
use app\common\util\Pageclass;
use think\File;
use think\Session;

class UpFiles extends Controller
{
	
	//单图片上传
	public function upload(){
		
		$fileKey = array_keys(request()->file());
		// 获取表单上传文件
        $file = request()->file($fileKey['0']);
		//上传到根目录下的uploads文件夹
		$info = $file->move(ROOT_PATH  . 'uploads');
		
		if($info){
			$result['code'] = 1;
			$result['info'] = '图片上传成功!';
			$path = str_replace('\\', '/', $info->getSaveName());
            $result['url'] = '/uploads/' . $path;
			return $result;
		}else {
            $result['code'] = 0;
            $result['info'] = '图片上传失败!';
            $result['url'] = '';
            return $result;
        }
		
		
	}


	//编辑器图片上传
	public function layedit_upload(){
		// 获取表单上传文件 例如上传了001.jpg
        $file = request()->file('file');
        // 移动到框架应用根目录/uploads/ 目录下
        $info = $file->move(ROOT_PATH  . 'uploads');
        if ($info) {
        	$mu = ROOT_PATH;
            $result['code'] = 0;
            $result['msg'] = '图片上传成功!';
            $path = str_replace('\\', '/', $info->getSaveName());
            $result['data']['src'] =  'http://sh.com/myadmin/uploads/' . $path;
            $result['data']['title'] = $path;
            return $result;
        } else {
            // 上传失败获取错误信息
            $result['code'] = 1;
            $result['msg'] = '图片上传失败!';
            $result['data'] = '';
            return $result;
        }
	}

	//多图上传
    public function uploads() {
        // 获取表单上传文件 例如上传了001.jpg
        $file = request()->file('file');
        // 移动到框架应用根目录/uploads/ 目录下
        $info = $file->move(ROOT_PATH  . 'uploads');
        if ($info) {
            $result['status'] = 200;
            $result['msg'] = '图片上传成功!';
            $path = str_replace('\\', '/', $info->getSaveName());
            $result['url'] = '/uploads/' . $path;
            $result['file_name'] = $_FILES["file"]["name"]; 
            return $result;
        } else {
            // 上传失败获取错误信息
            $result['status'] = 0;
            $result['msg'] = '图片上传失败!';
            $result['dir'] = '';
            return $result;
        }
    }
}
