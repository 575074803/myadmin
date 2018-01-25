<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:64:"E:\wampserver\wamp64\www\myadmin/app/admin\view\system\site.html";i:1515566371;}*/ ?>
<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>H+ 11后台主题UI框架 - 数据表格</title>
    <meta name="keywords" content="H+后台主题,后台bootstrap框架,会员中心主题,后台HTML,响应式后台">
    <meta name="description" content="H+是一个完全响应式，基于Bootstrap3最新版本开发的扁平化主题，她采用了主流的左右两栏式布局，使用了Html5+CSS3等现代技术">

    <link rel="shortcut icon" href="favicon.ico"> 
	<link href="__ADMINCSS__/bootstrap.min.css?v=3.3.5" rel="stylesheet">
    <link href="__ADMINCSS__/font-awesome.min.css?v=4.4.0" rel="stylesheet">

    <!-- Data Tables -->
    <link href="__ADMINCSS__/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet">

    <link href="__ADMINCSS__/animate.min.css" rel="stylesheet">
    <link href="__ADMINCSS__/style.min.css?v=4.0.0" rel="stylesheet">
    <!-- Sweet Alert -->
    <link href="__ADMINCSS__/plugins/sweetalert/sweetalert.css" rel="stylesheet">

	<style>
		.table {color:#000;}
	</style>
</head>

<body class="gray-bg">
    <div class="wrapper wrapper-content animated fadeInRight">
       
		
		<div class="row">
            <div class="col-sm-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>站点配置管理</h5>
                        <div class="ibox-tools">
                            <a href="javascript:location=location;"> 刷新</a>
                        </div>
                    </div>
                    <div class="ibox-content">
						<div class="">
                            <a href="<?php echo url('site_add'); ?>"  class=" btn btn-primary ">添加站点</a>
                        </div>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th >站点名称</th>
                                    <th>站点标识</th>
                                    <th>操作</th>
                                </tr>
                            </thead>
                            <tbody>
								<?php if(is_array($res) || $res instanceof \think\Collection || $res instanceof \think\Paginator): $i = 0; $__LIST__ = $res;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                                <tr  id="data<?php echo $vo['id'];?>">
                                    <td><?php echo $vo['id']; ?></td>
                                    <td ><?php echo $vo['sitename']; ?></td>
                                    <td><?php echo $vo['sitekey']; ?></td>
									<td>
										<a href="<?php echo url('admin/system/site_update',array('id'=>$vo['id'])); ?>"  class=" btn btn-primary btn-sm">修改</a>
										<?php if($i == 1): ?>
										<a class="btn btn-primary btn-sm btn-default">删除</a>
										<?php else: ?>
										<a authid="<?php echo $vo['id']; ?>" class="demo3  btn btn-primary btn-sm btn-danger ">删除</a>
										<?php endif; ?>
										
									</td>
                                </tr>
								<?php endforeach; endif; else: echo "" ;endif; ?>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
            
        </div>
    </div>
    <script src="__ADMINJS__/jquery-2.1.1.js"></script>
	<!-- 删除弹出框 -->
	<script>
		$('.demo3').click(function () {
			var authid = $(this).attr("authid");
			
			if(confirm("确定删除此栏目吗？"))
			{
				$.post("<?php echo url('admin/System/site_del');?>",{id:authid}, function (data) {
					if(data.status == 200){
						//alert(data.msg);
						$("#data"+authid).css("display","none");
					}
					if(data.status == 404){
						alert(data.msg);
						return false;
					}
				},'json');
			}
			else
			{
				return false;
			}
		});
	</script>
</body>

</html>