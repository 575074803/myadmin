<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:64:"E:\wampserver\wamp64\www\myadmin/app/admin\view\users\index.html";i:1516247814;}*/ ?>
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
                        <h5>栏目列表</h5>
                        <div class="ibox-tools">
                            <a href="javascript:location=location;">刷新</a>
                        </div>
                    </div>
                    <div class="ibox-content">
						<div class="">
                            <a href="<?php echo url('add'); ?>"  class=" btn btn-primary ">添加会员</a>
                        </div>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th><input type="checkbox" name="checkid" id="all">&nbsp;&nbsp;<a onclick="AjaxClearAll();">删除</a></th>
                                    <th>编号</th>
                                    <th>会员名</th>
                                    <th>会员等级</th>
                                    <th>邮箱账号</th>
                                    <th>联系电话</th>
                                    <th>状态</th>
                                    <th>注册时间</th>
                                    <th>操作</th>
                                </tr>
                            </thead>
                            <tbody>
								<?php if(is_array($row) || $row instanceof \think\Collection || $row instanceof \think\Paginator): $i = 0; $__LIST__ = $row;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                                <tr  id="data<?php echo $vo['id']; ?>">
                                    <td><input type="checkbox" name="checkid[]" id="checkid[]" value="<?php echo $vo['id']; ?>" /></td>
                                    <td><?php echo $vo['id']; ?></td>
                                    <td><?php echo $vo['username']; ?></td>
									<td><?php echo getGroupName($vo['level']); ?></td>
									<td><?php echo $vo['email']; ?></td>
									<td><?php echo $vo['mobile']; ?></td>
									<td>
										<?php if($vo['status'] == 0): ?>
										<a id="sta<?php echo $vo['id']; ?>" href="javascript:;" onclick="stateyes('member',<?php echo $vo['id']; ?>,'status')" class="btn btn-primary btn-sm btn-warning">开启</a>
										<?php else: ?>
										<a id="sta<?php echo $vo['id']; ?>" href="javascript:;" onclick="stateyes('member',<?php echo $vo['id']; ?>,'status')" class="btn btn-primary btn-sm btn-danger">关闭</a>
										<?php endif; ?>
									</td>
									<td><?php echo dateTime($vo['regtime']); ?></td>
									<td>
										<a href="<?php echo url('users/edit',array('id'=>$vo['id'])); ?>"  class=" btn btn-primary btn-sm">修改</a>
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
			$.post("<?php echo url('admin/ajaxdo/field_status'); ?>", { tablename:tablename,id:id,field:field}, function (data) {
				//启用
				if(data.status == 'qi'){
					$("#sta"+id).html('禁用').removeClass('btn-warning').addClass('btn-danger');
				}
				//禁用 
				if(data.status == 'jing'){
					$("#sta"+id).html('开启').removeClass('btn-danger').addClass('btn-warning');
				}
				
			},'json');
		}
    </script>
    <script>
    	//全选
    	$("#all").click(function(){   
		    if(this.checked){   
		        $("table :checkbox").prop("checked", true);  
		    }else{   
				$("table :checkbox").prop("checked", false);
		    }   
		});
		
		//删除信息
		function AjaxClearAll()
		{
			var ckobj = $("input[type='checkbox'][name!='checkid'][name^='checkid']:checked");
		
			if(ckobj.size() > 0)
			{
				if(confirm("系统会自动删除类别下所有子类别以及信息，确定删除吗？"))
				{
					var ids = '';
			
					ckobj.each(function(){
						if($(this).val() != 'on'){
							ids += $(this).val() + ',';
						}
					});
				
					ids = ids.slice(0,-1);
					$.post("<?php echo url('admin/ajaxdo/all_del');?>", {tablename:"member",ids:ids}, function (data) {
						if(data.status == 200){
							alert(data.msg);
							location=location;
						}
					},'json');
				}
				else
				{
					return false;
				}
			}
			else
			{
				alert('没有任何选中信息！');
				return false;
			}
		}
    </script>
    
	<!-- 删除弹出框 -->
	<script src="__ADMINJS__/plugins/sweetalert/sweetalert.min.js"></script>
    <script>
        $('.demo3').click(function () {
			var authid = $(this).attr("authid");
			swal({
				title: "您确定要删除这条信息吗",
				text: "删除后将无法恢复，请谨慎操作！",
				type: "warning",
				showCancelButton: true,
				confirmButtonColor: "#DD6B55",
				confirmButtonText: "删除",
				closeOnConfirm: false
			}, function () {
				$.post("<?php echo url('admin/Ajaxdo/ajax_one_del');?>", {tablename:'member',id:authid,whereid:'id'}, function (data) {
					if(data.status == 200){
						swal("删除成功！", "您已经永久删除了这条信息。", "success");
						$("#data"+authid).css("display","none");
					}	
				},'json');
				
				
			});
		});
	</script>
</body>

</html>