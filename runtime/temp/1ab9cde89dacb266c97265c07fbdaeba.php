<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:65:"E:\wampserver\wamp64\www\myadmin/app/admin\view\module\index.html";i:1515567379;}*/ ?>
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
                        <h5>模型列表</h5>
                        <div class="ibox-tools">
                            <a href="javascript:location=location;"> 刷新</a>
                        </div>
                    </div>
                    <div class="ibox-content">
						<div class="">
                            <a href="<?php echo url('add'); ?>"  class=" btn btn-primary ">添加模型</a>
                        </div>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>编号</th>
                                    <th>模型名称</th>
                                    <th>表名</th>
                                    <th>详述</th>
                                    <th>状态</th>
                                    <th>排序&nbsp;&nbsp;<a onclick="changeOrderid('module');">更改排序</a></th>
                                    <th>操作</th>
                                </tr>
                            </thead>
                            <tbody>
								<?php if(is_array($row) || $row instanceof \think\Collection || $row instanceof \think\Paginator): $i = 0; $__LIST__ = $row;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                                <tr  id="data<?php echo $vo['id']; ?>">
                                    <td><?php echo $vo['id']; ?></td>
                                    <td ><?php echo $vo['title']; ?></td>
                                    <td><?php echo $vo['name']; ?></td>
                                    <td><?php echo $vo['description']; ?></td>
                                   
									<td>
										
										<?php if($vo['status'] == 1): ?>
										<a id="sta<?php echo $vo['id']; ?>" href="javascript:;" onclick="stateyes('module',<?php echo $vo['id']; ?>,'status')" class="btn btn-primary btn-sm btn-warning">已开启</a>
										<?php else: ?>
										<a id="sta<?php echo $vo['id']; ?>" href="javascript:;" onclick="stateyes('module',<?php echo $vo['id']; ?>,'status')" class="btn btn-primary btn-sm btn-danger">已禁用</a>
										<?php endif; ?>
										
									</td>
									<td >
										<input id="ord<?php echo $vo['id']; ?>" name="orderid" authid="<?php echo $vo['id']; ?>"  type="text" value="<?php echo $vo['orderid']; ?>" style="width:40px;text-align:center;">
										<a onclick="ajaxSort('module',<?php echo $vo['id']; ?>);">更新</a>
                                    </td>
									<td>
										<a href="<?php echo url('field',array('id'=>$vo['id'])); ?>"  class=" btn btn-primary btn-sm btn-info">模型字段</a>
										<a href="<?php echo url('admin/module/edit',array('id'=>$vo['id'])); ?>"  class=" btn btn-primary btn-sm">修改</a>
										<a authid="<?php echo $vo['id']; ?>" class="demo3  btn btn-primary btn-sm btn-danger ">删除</a>
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
    <script>
		//改变状态
    	function stateyes(tablename,id,field){
			$.post("<?php echo url('ajaxdo/field_status'); ?>", { tablename:tablename,id:id,field:field}, function (data) {
				
				if(data.status == 'qi'){
					$("#sta"+id).html('已开启').removeClass('btn-danger').addClass('btn-warning');
				}
				if(data.status == 'jing'){
					$("#sta"+id).html('已禁用').removeClass('btn-warning').addClass('btn-danger');
				}
			},'json');
		}
	</script>
	<script>
    	//单个排序更改
		function ajaxSort(tablename,id){
			var tval = $("#ord"+id).val(); 
			$.post("<?php echo url('admin/Ajaxdo/ajaxSort');?>", {tablename:tablename,id:id,tval:tval}, function (data) {
				if(data.status == 200){
					//alert(data.msg);
					location=location;
				}	
			},'json');
			
		}
    
    	//所有值排序
    	function changeOrderid(tablename){
    		var orderids = '';
    		var ids = '';
    		$("input[name='orderid']").each(function() {
				orderids += $(this).val() + ",";
				ids += $(this).attr("authid")+',';
			});
			
			$.post("<?php echo url('admin/Ajaxdo/allAjaxSort');?>", {tablename:tablename,ids:ids,orderids:orderids}, function (data) {
				if(data.status == 200){
					location=location;
				}	
				
			},'json');
			
    	}
    	
    </script>
	<!-- 删除弹出框 -->
	<script>
		$('.demo3').click(function () {
			var authid = $(this).attr("authid");
			if(confirm("确定删除此栏目吗？"))
			{
				$.post("<?php echo url('admin/module/del');?>",{id:authid}, function (data) {
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