<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:68:"E:\wampserver\wamp64\www\myadmin/app/admin\view\auth\admin_list.html";i:1515567244;}*/ ?>
<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    

    <title>H+ 后台主题UI框架 - 数据表格</title>
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
		select.input-sm{     
			height: 35px;
			line-height: 35px;}
	</style>
</head>

<body class="gray-bg">
    <div class="wrapper wrapper-content animated fadeInRight">
	
        <div class="row">
            <div class="col-sm-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>管理员列表</h5>
                        <div class="ibox-tools">
                            <a href="javascript:location=location;">
                                刷新
                            </a>
                        </div>
                    </div>
					
                    <div class="ibox-content">
						<div class="">
                            <a href="<?php echo url('auth/admin_add'); ?>"  class=" btn btn-primary ">添加管理员</a>
                        </div>
                        <table class="table table-striped table-bordered table-hover dataTables-example">
                            <thead>
                                <tr>
                                    <th>编号</th>
                                    <th>用户名</th>
                                    <th>用户组</th>
                                    <th>IP地址</th>
                                    <th>登录时间</th>
                                    <th>状态</th>
                                    <th>操作</th>
                                </tr>
                            </thead>
                            <tbody>
								<?php if(is_array($res) || $res instanceof \think\Collection || $res instanceof \think\Paginator): $i = 0; $__LIST__ = $res;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                                <tr id="data<?php echo $vo['id']; ?>" class="gradeX">
                                    <td><?php echo $vo['id']; ?></td>
                                    <td><?php echo $vo['username']; ?></td>
                                    <td><?php echo $vo['group_name']; ?></td>
                                    <td><?php echo $vo['loginip']; ?></td>
                                    <td><?php echo date("Y-m-d H:i:s",$vo['logintime']);?></td>
                                    
                                    <td>
										
										<?php if($vo['id'] == 1){?>
											<a disabled="disabled" class=" btn btn-primary btn-sm" style="background-color:#FBFBFB;color:#CBCBCB;border:1px solid #E6E6E6;">已启用</a>
										<?php }else{ if($vo['is_open'] == 1): ?>
											<a id="sta<?php echo $vo['id']; ?>" href="javascript:;" onclick="stateyes('admin',<?php echo $vo['id']; ?>,'is_open')" class="btn btn-primary btn-sm btn-warning">已启用</a>
											<?php else: ?>
											<a id="sta<?php echo $vo['id']; ?>" href="javascript:;" onclick="stateyes('admin',<?php echo $vo['id']; ?>,'is_open')" class="btn btn-primary btn-sm btn-danger">已禁用</a>
											<?php endif; }?>
										
									</td>
                                    <td class="center">
										
										<?php if($vo['id'] == 1){?>
											<a disabled="disabled" class=" btn btn-primary btn-sm" style="background-color:#FBFBFB;color:#CBCBCB;border:1px solid #E6E6E6;">修改</a>
											<a disabled="disabled" class="btn btn-primary btn-sm btn-danger " style="background-color:#FBFBFB;color:#CBCBCB;border:1px solid #E6E6E6;">删除</a>
										<?php }else{ ?>
											<a href="<?php echo url('auth/admin_edit',array('id'=>$vo['id'])); ?>"  class=" btn btn-primary btn-sm">修改</a>
											<a authid="<?php echo $vo['id']; ?>" class="demo3  btn btn-primary btn-sm btn-danger ">删除</a>
										<?php }?>
									
									</td>
                                </tr>
								<?php endforeach; endif; else: echo "" ;endif; ?>
                               
                                
                            </tfoot>
                        </table>

                    </div>
                </div>
            </div>
        </div>
        
    </div>
    <script src="__ADMINJS__/jquery.min.js?v=2.1.4"></script>
    <script src="__ADMINJS__/bootstrap.min.js?v=3.3.5"></script>
    <script src="__ADMINJS__/plugins/jeditable/jquery.jeditable.js"></script>
    <script src="__ADMINJS__/plugins/dataTables/jquery.dataTables.js"></script>
    <script src="__ADMINJS__/plugins/dataTables/dataTables.bootstrap.js"></script>
    <script src="__ADMINJS__/content.min.js?v=1.0.0"></script>
    <script>
        $(document).ready(function(){$(".dataTables-example").dataTable();var oTable=$("#editable").dataTable();oTable.$("td").editable("../example_ajax.php",{"callback":function(sValue,y){var aPos=oTable.fnGetPosition(this);oTable.fnUpdate(sValue,aPos[0],aPos[1])},"submitdata":function(value,settings){return{"row_id":this.parentNode.getAttribute("id"),"column":oTable.fnGetPosition(this)[2]}},"width":"90%","height":"100%"})});function fnClickAddRow(){$("#editable").dataTable().fnAddData(["Custom row","New row","New row","New row","New row"])};
    </script>
    <script>
		//改变状态
    	function stateyes(tablename,id,field){
			$.post("<?php echo url('ajaxdo/field_status'); ?>", { tablename:tablename,id:id,field:field}, function (data) {
				
				if(data.status == 'qi'){
					$("#sta"+id).html('已启用').removeClass('btn-danger').addClass('btn-warning');
				}
				if(data.status == 'jing'){
					$("#sta"+id).html('已禁用').removeClass('btn-warning').addClass('btn-danger');
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
				$.post("<?php echo url('ajaxdo/ajax_one_del');?>",{tablename:"admin",id:authid,whereid:'id'}, function (data) {
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