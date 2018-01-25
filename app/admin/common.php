<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: tangyin <cicicoco321@163.com>
// +----------------------------------------------------------------------

// 应用公共文件

use think\Db;

define('UC_AUTH_KEY', 'Z}RCnc,V20Qr#l(M@$8D/uXYxmwa%bhLT[>75pyf'); //加密KEY

/**
 * 系统非常规MD5加密方法
 * @param  string $str 要加密的字符串
 * @return string 
 */
function think_ucenter_md5($str, $key = 'ThinkUCenter'){
	return '' === $str ? '' : md5(md5($str) . $key);
}

/**
* 检测当前用户是否为管理员
* @return boolean true-管理员，false-非管理员
*/
function is_administrator($uid = null){
   $uid = is_null($uid) ? is_login() : $uid;
   return $uid && (intval($uid) === C('USER_ADMINISTRATOR'));
}
//不是超级管理员的 权限树
function Auth_tree($one_tree){
	$gid = DB::name('authGroup')->where('group_id',session('user_auth.group_id'))->where('status',1)->find();
    $own_rules = explode(',',$gid['rules']);
	$tree = array();
	foreach($one_tree as $k=>$v){
		if(in_array($v['id'],$own_rules)){
			$tree[$k] = $one_tree[$k];
		}
		$two_tree = DB::name("authRule")->where('pid',$v['id'])->order('orderid')->select();
		//第二级目录存入child
		foreach($two_tree as $k2=>$v2){
			if(in_array($v2['id'],$own_rules)){
				$tree[$k]['child'][$k2] = $two_tree[$k2];
			}
			$three_tree = DB::name("authRule")->where('pid',$v2['id'])->order('orderid')->select();
			//第三级目录存入operator
			foreach($three_tree as $k3=>$v3){
				if(in_array($v3['id'],$own_rules)){
					$tree[$k]['child'][$k2]['operator'][$k3] = $three_tree[$k3];
				}
			}
		}
			
	}
	return $tree;
}

//超级管理员权限树
function Auth_admin($one_tree){
	
	$gid = DB::name('authGroup')->where('group_id',session('user_auth.group_id'))->where('status',1)->find();
    $own_rules = explode(',',$gid['rules']);
	$tree = array();
	foreach($one_tree as $k=>$v){
		
			$tree[$k] = $one_tree[$k];
		
		$two_tree = DB::name("authRule")->where('pid',$v['id'])->order('orderid')->select();
		//第二级目录存入child
		foreach($two_tree as $k2=>$v2){
			
				$tree[$k]['child'][$k2] = $two_tree[$k2];
			
			$three_tree = DB::name("authRule")->where('pid',$v2['id'])->order('orderid')->select();
			//第三级目录存入operator
			foreach($three_tree as $k3=>$v3){
				
					$tree[$k]['child'][$k2]['operator'][$k3] = $three_tree[$k3];
				
			}
		}
			
	}
	return $tree;
}



//搜索一个文件夹  
//返回文件夹下的  文件 和文件夹
function GetFiles($dir){
	$files_res = array_map ( 'basename', glob ( $dir . '*') );
	if ($files_res === FALSE || ! file_exists ( $dir )) {
		$this->error('插件目录不可读或者不存在');
		return FALSE;
	}
	//dump($files_res);
	$arr = array();
	foreach($files_res as $k=>$v){
		$arr[$k]['name'] = $v;
		$filename = $dir.$v;
		//判断是文件夹 还是 文件
		if(is_dir($filename)){
			$arr[$k]['type'] = 'dir';
			$arr[$k]['filesize'] = '-';
		}
		if(is_file($filename)){
			$arr[$k]['type'] = 'file';
			
			$size = filesize($filename).'kb';
			
			$arr[$k]['filesize'] = $size;
		}
		//修改时间
		$updatetime = filemtime($filename);
		$arr[$k]['uptime'] = date('Y-m-d H:i:s',$updatetime);
	}
	
	return $arr;
}


/**
 * 删除目录及目录下所有文件或删除指定文件
 * @param str $path   待删除目录路径
 * @param int $delDir 是否删除目录，1或true删除目录，0或false则只删除文件保留目录（包含子目录）
 * @return bool 返回删除状态
 */
function delDirAndFile( $dirName )
{
    if ( $handle = opendir( "$dirName" ) ) {
        while ( false !== ( $item = readdir( $handle ) ) ) {
            if ( $item != "." && $item != ".." ) {
                if ( is_dir( "$dirName/$item" ) ) {
                    delDirAndFile( "$dirName/$item" );
                } else {
                    if( unlink( "$dirName/$item" ) )echo "成功删除文件： $dirName/$item\n";
                }
            }
        }
        closedir( $handle );
        if( rmdir( $dirName ) )echo "成功删除目录： $dirName\n";
    }
}

/**
 * 随机数
 *  @return num 数字
 */
function random(){
    return rand(100,300);
}


/*
 * 管理组修改页面选中项
 *
 * @access  public
 * @param   $id  分组的id
 * @param   $m  model 选中的类型
*/
function GetModelPriv($m='',$id)
{
    $r = Db::name('adminprivacy')->where('groupid',$id)->where('model',$m)->find();
    if($r && is_array($r))
    {
        return 'checked="checked"';
    }
}


/**
 *  获取类名称
 *  @return 名称
 */
function getClassName($tablename,$id,$filed){
    $web_name = DB::name($tablename)->where('id',$id)->find();
    return $web_name[$filed];

}
/**
 *  数组转换成 下标与值对应的字符串
 *  @return
 */
function ToUrlParams($urlObj)
{
    $buff = "";
    foreach ($urlObj as $k => $v)
    {
        if($k != "sign"){
            $buff .= $k . "=" . $v . "&";
        }
    }
    $buff = trim($buff, "&");
    return $buff;
}

/**
 * 格式化字节大小
 * @param  number $size      字节数
 * @param  string $delimiter 数字和单位分隔符
 * @return string            格式化后的带单位的大小
 */
function format_bytes($size, $delimiter = '') {
    $units = array('B', 'KB', 'MB', 'GB', 'TB', 'PB');
    for ($i = 0; $size >= 1024 && $i < 5; $i++) $size /= 1024;
    return round($size, 2) . $delimiter . $units[$i];
}





































