<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:61:"E:\wampserver\wamp64\www\myadmin/app/admin\view\ad\index.html";i:1515571624;}*/ ?>
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
                        <h5>广告列表</h5>
                        <div class="ibox-tools">
                            <a href="javascript:location=location;">刷新</a>
                        </div>
                    </div>
                    <div class="ibox-content">
						<div class="">
                            <a href="<?php echo url('add'); ?>"  class=" btn btn-primary ">广告添加</a>
                        </div>
                        <table class="table table-striped table-bordered table-hover dataTables-example">
                            <thead>
                                <tr>
                                	<th><input type="checkbox" name="checkid" id="all">&nbsp;&nbsp;<a onclick="AjaxClearAll();">删除</a></th>
                                    <th>编号</th>
                                    <th>网站logo</th>
                                    <th>站点名称</th>
                                    <th>站点URL</th>
                                    <th>所属分类</th>
                                    <th>显示</th>
                                    <th>排序&nbsp;&nbsp;<a onclick="changeOrderid('<?php echo $tablename; ?>');">更改排序</a></th>
                                    <th>操作</th>
                                </tr>
                            </thead>
                            <tbody>
								<?php if(is_array($res) || $res instanceof \think\Collection || $res instanceof \think\Paginator): $i = 0; $__LIST__ = $res;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                                <tr id="data<?php echo $vo['id']; ?>" class="gradeX">
                                    <td><input type="checkbox" name="checkid[]" id="checkid[]" value="<?php echo $vo['id']; ?>" /></td>
                                    <td><?php echo $vo['id']; ?></td>
                                    <td>
                                    	<?php if($vo['picurl'] == ''): ?>
                                    	<img src="__ADMINIMG__/dfthumb.png">
                                    	<?php else: ?>
                                    	<img src="<?php echo $vo['picurl']; ?>" style="width:80px;">
                                    	<?php endif; ?>
                                    </td>
                                    <td><?php echo $vo['title']; ?></td>
                                    <td><?php echo $vo['linkurl']; ?></td>
                                    <td><?php echo getClassName("adtype",$vo['classid'] ,"classname"); ?></td>
                                    
                                    <td>
										<?php if($vo['checkinfo'] == 1): ?>
										<a id="sta<?php echo $vo['id']; ?>" href="javascript:;" onclick="stateyes('<?php echo $tablename; ?>',<?php echo $vo['id']; ?>,'checkinfo')" class="btn btn-primary btn-sm btn-warning">显示</a>
										<?php else: ?>
										<a id="sta<?php echo $vo['id']; ?>" href="javascript:;" onclick="stateyes('<?php echo $tablename; ?>',<?php echo $vo['id']; ?>,'checkinfo')" class="btn btn-primary btn-sm btn-danger">不显示</a>
										<?php endif; ?>
									</td>
                                    <td >
										<input id="ord<?php echo $vo['id']; ?>" name="orderid" authid="<?php echo $vo['id']; ?>"  type="text" value="<?php echo $vo['orderid']; ?>" style="width:40px;text-align:center;">
										<a onclick="ajaxSort('<?php echo $tablename; ?>',<?php echo $vo['id']; ?>);">更新</a>
                                    </td>
                                    <td class="center">
										<a href="<?php echo url('edit',array('id'=>$vo['id'])); ?>"  class=" btn btn-primary btn-sm">修改</a>
										<a authid="<?php echo $vo['id']; ?>" class="demo3  btn btn-primary btn-sm btn-danger ">删除</a>
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
				if(confirm("确定要删除选中的信息吗？"))
				{
					var ids = '';
			
					ckobj.each(function(){
						if($(this).val() != 'on'){
							ids += $(this).val() + ',';
						}
					});
				
					ids = ids.slice(0,-1);
					$.post("<?php echo url('admin/Ajaxdo/ajax_all_del');?>", {tablename:"<?php echo $tablename; ?>",ids:ids}, function (data) {
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
    <script>
    	//改变状态
    	function stateyes(tablename,id,field){
			$.post("<?php echo url('admin/ajaxdo/field_status'); ?>", { tablename:tablename,id:id,field:field}, function (data) {
				
				if(data.status == 'qi'){
					$("#sta"+id).html('显示').removeClass('btn-danger').addClass('layui-btn-danger');
				}
				
				if(data.status == 'jing'){
					$("#sta"+id).html('不显示').removeClass('layui-btn-danger').addClass('btn-danger');
				}
				
			},'json');
		}
    	
    </script>
    <script>
    	//单个排序更改
		function ajaxSort(tablename,id){
			var tval = $("#ord"+id).val(); 
			$.post("<?php echo url('admin/Ajaxdo/ajax_sort');?>", {tablename:tablename,id:id,tval:tval}, function (data) {
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
			
			$.post("<?php echo url('admin/Ajaxdo/ajax_all_sort');?>", {tablename:tablename,ids:ids,orderids:orderids}, function (data) {
				if(data.status == 200){
					location=location;
				}	
				
			},'json');
			
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
				$.post("<?php echo url('admin/Ajaxdo/ajax_one_del');?>", {tablename:"<?php echo $tablename; ?>",id:authid,whereid:'id'}, function (data) {
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