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

/*
*获取用户ip
*/
function getIP()
{
	global $ip;

	if (getenv("HTTP_CLIENT_IP"))
		$ip = getenv("HTTP_CLIENT_IP");
	else if(getenv("HTTP_X_FORWARDED_FOR"))
		$ip = getenv("HTTP_X_FORWARDED_FOR");
	else if(getenv("REMOTE_ADDR"))
		$ip = getenv("REMOTE_ADDR");
	else
		$ip = "Unknow";

	return $ip;
}


/*
 * 获取排列序号
 *
 * @access  public
 * @param   $tbname   string  获取该表的最大ID
 * @return  $orderid  int     返回当前ID
*/
function GetOrderID($tbname)
{
	$max = Db::name($tbname)->max('orderid'); 
	$orderid = (empty($max ) ? 1 : ($max  + 1));
	return $orderid;
} 

/*
 * 把字符串转换成数组
 *
 * @access  public
 * @param   $str string  要切开的数组
 * @return  $orderid  int     返回当前ID
*/
function Explode_str($ex=',',$str,$field='id',$where="or")
{
	$where = ' '.$where.' ';
	$arr = explode($ex,$str);
	$s = '';
	foreach($arr as $v){
		$s .= $field.' = '.$v.$where;
	}
	
	return rtrim($s,$where);
}




//数组转字符串
function array2string($info) {
    if($info == '') return '';
    if(!is_array($info)){
        $string = stripslashes($info);
    }
    foreach($info as $key => $val){
        $string[$key] = stripslashes($val);
    }
    $setup = var_export($string, TRUE);
    return $setup;
}

/**
 * 求子集（栏目）
 */
function getChildId($id,$tablename='category',$field='parentid'){
    $res = getId($id,$str='',$tablename,$field);
    $arr = explode(',',rtrim($res,','));
    $arr = array_unique($arr);
    $str = implode(",", $arr);
    return $str;
}
function getId($id,$str = '',$tablename,$field){
    $res = DB::name($tablename)->field('id')->where($field,$id)->select();
    foreach($res as $v){
        $str .= $v['id'] .',';
        $jie = getId($v['id'],$str,$tablename,$field);
        $str.= $jie;
    }
    return $str;
}


/*
 * 获取当前日期
 * */
function getTimeDate(){
    return date('Y-d-m H:i:s',time());
}

/**
 * 时间戳转年月日时间
 */
function dateTime($time){

    return date('Y-m-d H:i:s',$time);
}
/**
 * 后台  会员组id 返回 会员组名称
 */
function getGroupName($groupid){
    $res = DB::name('member_level')->where('id',$groupid)->find();
    return $res['level_name'];
}

/**
 * 获取 栏目url
 */
function getUrl($id,$menu_name){

    //$g = DB::name('category')->where('id',$id)->find();

    return url('index/index/'.$menu_name,array('catid'=>$id,'page'=>1));
}



















































