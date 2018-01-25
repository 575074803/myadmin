<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:52:"F:\phpwww\myadmin/app/admin\view\index\index_v2.html";i:1516259253;}*/ ?>
<!DOCTYPE html>
<html>
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    

    <title>H+ 11后台主题UI框架 - 数据表格</title>
    <meta name="keywords" content="H+后台主题,后台bootstrap框架,会员中心主题,后台HTML,响应式后台">
    <meta name="description" content="H+是一个完全响应式，基于Bootstrap3最新版本开发的扁平化主题，她采用了主流的左右两栏式布局，使用了Html5+CSS3等现代技术">

    <link rel="shortcut icon" href="favicon.ico"> 
    
    <!--<link href="__ADMINCSS__/bootstrap.min.css?v=3.3.5" rel="stylesheet">-->
    <link href="__ADMINCSS__/font-awesome.min.css?v=4.4.0" rel="stylesheet">
    
	<link href="__ADMINCSS__/animate.min.css" rel="stylesheet">
    <link href="__ADMINCSS__/style.min.css?v=4.0.0" rel="stylesheet">
   	
   	<!-- layui -->
	<link rel="stylesheet" href="__ADMINCSS__/style.css"  media="all">
	<link rel="stylesheet" href="__LAYUI__/css/layui.css"  media="all">
	<script src="__LAYUI__/layui.js" charset="utf-8"></script>
</head>

<body class="gray-bg">
    <div class="wrapper wrapper-content animated fadeInRight">
		<div class="row">
            <div class="col-sm-12">
                
				<table class="layui-table" lay-skin="line">
				  <colgroup>
				    <col width="50%">
				    <col width="50%">
				    <col>
				  </colgroup>
				  <thead>
				    <tr>
				      <th colspan="2">系统信息</th>
				    </tr> 
				  </thead>
				  <tbody>
				    <tr>
                <td>网站域名</td>
                <td><?php echo $config['url']; ?></td>
            </tr>
            <tr>
                <td>网站目录</td>
                <td><?php echo $config['document_root']; ?></td>
            </tr>
            <tr>
                <td>服务器操作系统</td>
                <td><?php echo $config['server_os']; ?></td>
            </tr>
            <tr>
                <td>服务器端口</td>
                <td><?php echo $config['server_port']; ?></td>
            </tr>
            <tr>
                <td>服务器IP</td>
                <td><?php echo $config['server_ip']; ?></td>
            </tr>
            <tr>
                <td>WEB运行环境</td>
                <td><?php echo $config['server_soft']; ?></td>
            </tr>
            <tr>
                <td>MySQL数据库版本</td>
                <td><?php echo $config['mysql_version']; ?></td>
            </tr>
            <tr>
                <td>运行PHP版本</td>
                <td><?php echo $config['php_version']; ?></td>
            </tr>

            <tr>
                <td>最大上传限制</td>
                <td><?php echo $config['max_upload_size']; ?></td>
            </tr>
				  </tbody>
				</table>

                   
                
            </div>
            
        </div>
    </div>
    <script src="__ADMINJS__/jquery-2.1.1.js"></script>
    
</body>

</html>