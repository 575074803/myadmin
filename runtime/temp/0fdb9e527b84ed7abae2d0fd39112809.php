<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:64:"E:\wampserver\wamp64\www\myadmin/app/admin\view\wechat\text.html";i:1516070589;}*/ ?>
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
                        <h5>文本回复</h5>
                        <div class="ibox-tools">
                            <a href="javascript:location=location;">刷新</a>
                        </div>
                    </div>
                    <div class="ibox-content">
						<div class="">
                            <a href="<?php echo url('text_add'); ?>"  class="layui-btn layui-btn-sm">添加文本</a>
                        </div>
                        <table class="layui-table" lay-size="sm">
						  
						  <thead>
	                            <tr>
	                            	<th>编号</th>
	                                <th>关键字</th>
	                                <th>创建时间</th>
	                                <th>状态</th>
	                                <th>操作</th>
	                            </tr>
	                        </thead>
						  <tbody>
								<?php if(is_array($res) || $res instanceof \think\Collection || $res instanceof \think\Paginator): $i = 0; $__LIST__ = $res;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                                <tr  id="data<?php echo $vo['id'];?>">
                                    <td><?php echo $vo['id']; ?></td>
                                    <td><?php echo $vo['keyword']; ?></td>
                                    
									<td><?php echo date("Y-m-d H:i:s",$vo['posttime'] ); ?></td>
									<td>
										<?php if($vo['open'] == 1): ?>
										<a id="sta<?php echo $vo['id']; ?>" href="javascript:;" onclick="stateyes('<?php echo $tablename; ?>',<?php echo $vo['id']; ?>,'open')" class="layui-btn layui-btn-xs layui-btn-warm">显示</a>
										<?php else: ?>
										<a id="sta<?php echo $vo['id']; ?>" href="javascript:;" onclick="stateyes('<?php echo $tablename; ?>',<?php echo $vo['id']; ?>,'open')" class="layui-btn layui-btn-xs layui-btn-danger">不显示</a>
										<?php endif; ?>
									</td>
									<td>
										<a href="<?php echo url('text_edit',array('id'=>$vo['id'])); ?>"  class="layui-btn layui-btn-xs">修改</a>
										<a authid="<?php echo $vo['id']; ?>" class="demo3  layui-btn layui-btn-xs layui-btn-danger">删除</a>
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
				
				if(data.status == 'qi'){
					$("#sta"+id).html('显示').removeClass('layui-btn-danger').addClass('layui-btn-warm');
				}
				
				if(data.status == 'jing'){
					$("#sta"+id).html('不显示').removeClass('layui-btn-warm').addClass('layui-btn-danger');
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
	<script>
		$('.demo3').click(function () {
			var authid = $(this).attr("authid");
			
			if(confirm("确定删除此栏目吗？"))
			{
				$.post("<?php echo url('admin/wechat/text_del');?>",{tablename:"<?php echo $tablename; ?>",id:authid,whereid:'id'}, function (data) {
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