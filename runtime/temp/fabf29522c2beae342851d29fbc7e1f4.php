<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:67:"E:\wampserver\wamp64\www\myadmin/app/admin\view\template\index.html";i:1515571738;}*/ ?>
<?php
use think\Db;
?>
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
                        <h5>模板管理</h5>
                        <div class="ibox-tools">
                            <a href="javascript:location=location;">刷新</a>
                        </div>
                    </div>
                    <div class="ibox-content">
						<div class="">
                            <a href="javascript:location=location;" class=" btn btn-primary ">更新</a>
							<?php if(input('param.fname')){?>
							<a href="javascript:history.go(-1);" class="btn btn-default">返回上一层</a>
							<?php }if(input('param.fname')){?>
							<a class=" btn btn-primary " href="<?php echo url('template/edit_all',array('fname'=>$fname)); ?>">替换所有模板</a>
							<?php }else{?>
							<a class=" btn btn-primary " href="<?php echo url('template/edit_all'); ?>">替换所有模板</a>
							<?php }?>
						</div>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>文件名称</th>
                                    <th>文件大小</th>
                                    <th>修改日期</th>
                                    <th>操作</th>
                                </tr>
                            </thead>
                            <tbody>
								<?php $i=1; if(is_array($files) || $files instanceof \think\Collection || $files instanceof \think\Paginator): $i = 0; $__LIST__ = $files;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                                <tr id="<?php echo $i; ?>">
                                    <td>
										<?php if($vo['type'] == 'dir'): ?>
											<a href="<?php echo url('admin/template/index',array('fname'=>$vo['name'])); ?>">
												<span class="glyphicon glyphicon-folder-open" ></span>
												<?php echo $vo['name']; ?>
											</a>
										<?php else: ?>
											<?php echo $vo['name']; endif; ?>
									</td>
                                    <td><?php echo $vo['filesize']; ?></td>
                                    <td><?php echo $vo['uptime']; ?></td>
                                   
									<td>
										<?php if($vo['type'] == 'file'): ?>
										<a href="<?php echo url('admin/template/edit',array('file'=>$vo['name'],'fname'=>input('param.fname'))); ?>"  class=" btn btn-primary btn-sm">修改</a>
										<?php endif; ?>
										
										<a fname="<?php echo $vo['name']; ?>" dtype="<?php echo $vo['type']; ?>" nid="<?php echo $i; ?>" class="demo3  btn btn-primary btn-sm btn-danger ">删除</a>
										
										
									
									</td>
                                </tr>
								<?php $i++; endforeach; endif; else: echo "" ;endif; ?>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
            
        </div>
    </div>
    <script src="__ADMINJS__/jquery-2.1.1.js"></script>
    
	<!-- 删除弹出框 -->
	<script src="__ADMINJS__/plugins/sweetalert/sweetalert.min.js"></script>
    <script>
        $('.demo3').click(function () {
			var fname = $(this).attr("fname");//文件名
			var nid = $(this).attr("nid");//用于删除的id号
			var dtype = $(this).attr("dtype");//是dir 还是 file
			swal({
				title: "您确定要删除这条信息吗",
				text: "删除后将无法恢复，请谨慎操作！",
				type: "warning",
				showCancelButton: true,
				confirmButtonColor: "#DD6B55",
				confirmButtonText: "删除",
				closeOnConfirm: false
			}, function () {
				$.post("<?php echo url('admin/Ajaxdo/temp_delete');?>", {fname:fname,dtype:dtype}, function (data) {
					if(data.status == 200){
						swal("删除成功！", "您已经永久删除了这条信息。", "success");
						$("#"+nid).css("display","none");
					}					
				},'json');
				
				
			});
		});
	</script>
</body>

</html>