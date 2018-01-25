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
    '__pattern__' => [
        'name' => '\w+',
    ],
	
	'lists/:catid/:page' => 'index/index/lists',
    'content/:catid/:id' => 'index/index/content',
    /*
	'/'              			=> 'index/index/index', // 首页访问路由
	'detail'	     		=> 'index/detail/detail',
	//'directories'	=>'index/directories/directories',
	//'activity' 		=> 'index/activity/activity',
	//'news/:content' 				=> 'index/news/news',
	'newsshow/:id/:cate_id' 			=> 'index/news/newsshow',
	//'video'				=> 'index/video/video',
	'videoshow/:id/:cate_id'			=> 'index/video/videoshow',
	//'pro'					=> 'index/pro/pro',
	'proshow/:id/:cate_id'				=> 'index/pro/proshow',
	'about'				=> 'index/about/about',
	
	//'detail'         => 'index/detail/detail',
	//'admin' =>'admin/index/index',
	//'addons/:mc/:ac' => 'index/addons/execute',
	*/
];
