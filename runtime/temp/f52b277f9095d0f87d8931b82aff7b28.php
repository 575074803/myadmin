<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:68:"E:\wampserver\wamp64\www\myadmin/app/admin\view\auth\admin_rule.html";i:1515565547;}*/ ?>
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
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>权限列表</h5>
                        <div class="ibox-tools">
                            <a href="javascript:location=location;">刷新</a>
                        </div>
                    </div>
                    <div class="ibox-content">
						<div class="">
                            <a href="<?php echo url('rule_add'); ?>"  class="layui-btn layui-btn-sm">添加权限</a>
                        </div>
                        <table class="layui-table" lay-size="sm">
						  
						  <thead>
	                            <tr>
	                            	<th><input type="checkbox" name="checkid" class="all">&nbsp;&nbsp;<a style="color:#337AB7;" onclick="AjaxClearAll();">删除</a></th>
                               
	                                <th>编号</th>
	                                <th>图标</th>
	                                <th>权限名称</th>
	                                <th>控制器/方法</th>
	                                <th>是否验证权限</th>
	                                <th>菜单状态</th>
	                                <th>排序&nbsp;&nbsp;<a onclick="changeOrderid('authRule');" style="color:#337AB7;">更改排序</a></th>
	                                <th>操作</th>
	                            </tr>
	                        </thead>
						  <tbody>
								<?php
			
								function Show($id=0, $i=0)
								{
									$row=Db::name('authRule')->where('pid',$id)->order('orderid asc')->select();
									foreach($row as $vo){
								?>
                                <tr  id="data<?php echo $vo['id'];?>">
                                    <td><input type="checkbox" name="checkid[]" id="checkid[]" value="<?php echo $vo['id']; ?>" /></td>
                                    
                                    <td><?php echo $vo['id']; ?></td>
                                    <td >
										<?php if($vo['icon']){?>
										<i class="fa fa-<?php echo $vo['icon'];?>"></i>
										<?php }?>
									</td>
                                    <td>
										<?php
											for($j=0;$j<$i;$j++){
												if($vo['pid'] != 0){
														echo '|—';
													}
											}
										?>
										<?php echo $vo['title']; ?>
									</td>
                                    <td><?php echo $vo['href']; ?></td>
                                    <td >
										
										<?php if($vo['authopen'] == 0): ?>
										<a id="sta<?php echo $vo['id']; ?>" href="javascript:;" onclick="stateyes('authRule',<?php echo $vo['id']; ?>,'authopen')" class="layui-btn layui-btn-xs layui-btn-warm">需要验证</a>
										<?php else: ?>
										<a id="sta<?php echo $vo['id']; ?>" href="javascript:;" onclick="stateyes('authRule',<?php echo $vo['id']; ?>,'authopen')" class="layui-btn layui-btn-xs layui-btn-danger">无需验证</a>
										<?php endif; ?>
										
										
									
									</td>
									<td>
										
										<?php if($vo['menustatus'] == 1): ?>
										<a id="menu<?php echo $vo['id']; ?>" href="javascript:;" onclick="stateyes2('authRule',<?php echo $vo['id']; ?>,'menustatus')" class="layui-btn layui-btn-xs layui-btn-warm">显示状态</a>
										<?php else: ?>
										<a id="menu<?php echo $vo['id']; ?>" href="javascript:;" onclick="stateyes2('authRule',<?php echo $vo['id']; ?>,'menustatus')" class="layui-btn layui-btn-xs layui-btn-danger">隐藏状态</a>
										<?php endif; ?>
										
										
									</td>
									<td >
										<input id="ord<?php echo $vo['id']; ?>" name="orderid" authid="<?php echo $vo['id']; ?>"  type="text" value="<?php echo $vo['orderid']; ?>" style="width:40px;text-align:center;">
										
										<a onclick="ajaxSort('authRule',<?php echo $vo['id']; ?>);" style="color:#337AB7;">更新</a>
									</td>
									<td>
									<a href="<?php echo url('rule_add',array('id'=>$vo['id'])); ?>"  class="layui-btn layui-btn-xs  layui-btn-normal">添加子权限</a>
									<a href="<?php echo url('rule_edit',array('id'=>$vo['id'])); ?>"  class="layui-btn layui-btn-xs">修改</a>
									<a authid="<?php echo $vo['id']; ?>" class="demo3  layui-btn layui-btn-xs layui-btn-danger">删除</a>
									
									</td>
                                </tr>
								<?php
									Show($vo['id'],$i+1);
									}
								}
								Show();
								?>
								<tr>
									<td colspan="7">
										<input type="checkbox" name="checkid" class="all">&nbsp;&nbsp;
										<a style="color:#337AB7;" onclick="AjaxClearAll();">删除</a>
									</td>
									<td>
										<a onclick="changeOrderid('authRule');" style="color:#337AB7;">更改排序</a>
									</td>
									<td>
										<a href="javascript:location=location;" style="color:#337AB7;">刷新</a>
									</td>
								</tr>
								
                            </tbody>
						</table>

                    </div>
                </div>
            </div>
            
        </div>
    </div>
    <script src="__ADMINJS__/jquery-2.1.1.js"></script>
    <script>
    	//全选
    	$(".all").click(function(){   
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
					$.post("<?php echo url('admin/auth/rule_all_del');?>", {tablename:"module",ids:ids}, function (data) {
						if(data.status == 200){
							alert(data.msg);
							location=location;
						}
						if(data.code == 0){
							alert(data.msg);
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
					$("#sta"+id).html('无需验证').removeClass('layui-btn-warm').addClass('layui-btn-danger');
					
				}
				
				if(data.status == 'jing'){
					$("#sta"+id).html('需要验证').removeClass('layui-btn-danger').addClass('layui-btn-warm');
					
				}
				
			},'json');
		}
    	
    	function stateyes2(tablename,id,field){
			$.post("<?php echo url('admin/ajaxdo/field_status'); ?>", { tablename:tablename,id:id,field:field}, function (data) {
				
				if(data.status == 'qi'){
					$("#menu"+id).html('显示状态').removeClass('layui-btn-danger').addClass('layui-btn-warm');
				}
				
				if(data.status == 'jing'){
					$("#menu"+id).html('隐藏状态').removeClass('layui-btn-warm').addClass('layui-btn-danger');
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
					alert(data.msg);
					//location=location;
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
	<script>
		$('.demo3').click(function () {
			var authid = $(this).attr("authid");
			if(confirm("确定删除此栏目吗？"))
			{
				$.post("<?php echo url('admin/Ajaxdo/ajax_alert');?>",{tablename:"authRule",id:authid,whereid:'id'}, function (data) {
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