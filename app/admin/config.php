<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

return [
    
	//'dispatch_success_tmpl'  => APP_PATH . 'admin/view/common/success.html',
    //'dispatch_error_tmpl'    => THINK_PATH . 'tpl' . DS . 'dispatch_jump.tpl',
    //'dispatch_error_tmpl'    => APP_PATH . 'admin/view/common/error.html',
	'view_replace_str'  => array(
		'__ADMIN__'  => BASE_PATH . '/static/admin',
		'__ADMINCSS__'  => BASE_PATH . '/static/admin/css',
		'__ADMINJS__'   => BASE_PATH . '/static/admin/js',
		'__ADMINIMG__'  => BASE_PATH . '/static/admin/img',
		'__ADMINKIN__'  =>BASE_PATH.'/static/admin/kindeditor',
		'__zyupload__'  =>BASE_PATH.'/static/admin/zyupload',
		'__TEMIMG__'	=>BASE_PATH.'/static/temimg',
		'__LAYUI__' 	=>BASE_PATH.'/static/admin/layui',
	),
	
	'captcha'  => [
		// 验证码字符集合
		'codeSet'  => '2345678abcdefhijkmnpqrstuvwxyzABCDEFGHJKLMNPQRTUVWXY', 
		// 验证码字体大小(px)
		'fontSize' => 25, 
		// 是否画混淆曲线
		'useCurve' => true, 
		 // 验证码图片高度
		'imageH'   => 10,
		// 验证码图片宽度
		'imageW'   => 100, 
		// 验证码位数
		'length'   => 5, 
		// 验证成功后是否重置        
		'reset'    => true
	],
	// 更改默认的空控制器名
	'empty_controller'      => 'EmptyController',
    //替换模板
    'template_css' =>'css/',
    'template_js' =>'js/',
    'template_image' =>'images/',

];
