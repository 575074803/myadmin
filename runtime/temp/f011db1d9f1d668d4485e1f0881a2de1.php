<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:69:"E:\wampserver\wamp64\www\myadmin/app/admin\view\databackup\index.html";i:1516242817;}*/ ?>
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
                        <h5>数据库备份</h5>
                        <div class="ibox-tools">
                            <a href="javascript:location=location;">刷新</a>
                        </div>
                    </div>
                    <div class="ibox-content">
						<script>
						    layui.use(['jquery','layer'],function(){
						      window.$ = layui.$;
						      var layer = layui.layer;
						      //备份表方法
						      $("#export").click(function(){
						          $(this).html("正在发送备份请求...");
						          $.post(
						            $("#export-form").attr("action"),
						            $("#export-form").serialize(), 
						            function(data){
						            	//console.log(data);
						            	
						              if(data.code==1){
						                $("#export").html( "开始备份，请不要关闭本页面！");
						                backup(data.data.tab);
						                window.onbeforeunload = function(){ return "正在备份数据库，请不要关闭！" }
						              }else{
						                 layer.tips(data.msg, "#export", {
						                  tips: [1, '#3595CC'],
						                  time: 4000
						                });
						                $("#export").html("立即备份");
						              }
						              
						            }, "json");
						            return false;  
						      }); 
						      //递归备份表
						      function backup(tab,status){
						        status && showmsg(tab.id, "开始备份...(0%)");
						        $.get( $("#export-form").attr("action"), tab, function(data){
						           //console.log(data);
						           
						                if(data.code==1){
						                  showmsg(tab, data.msg);
						
						                  if(!$.isPlainObject(data.data.tab)){
						                    $("#export").html("备份完成");
						                    window.onbeforeunload = function(){ return null }
						                    return;
						                  } 
						
						                  //backup(data.data.tab, tab.id != data.data.tab.id);
						                } else {
						                  $("#export").html("立即备份");
						                }
						            }, "json");
						
						      }
						    //修改备份状态
						    function showmsg(tab, msg){
						       $("table tbody tr").eq(tab.id).find(".info").html(msg)
						    }
						   
						     //优化表
						      $("#optimize").click(function(){
						           $.post(this.href, $("#export-form").serialize(), function(data){
						           
						            layer.tips(data.msg, "#optimize", {
						              tips: [1, '#3595CC'],
						              time: 4000
						            });
						    
						            }, "json");
						            return false;    
						      });
						
						      //修复表
						      $("#repair").on("click",function(e){
						         
						          $.post(this.href, $("#export-form").serialize(), function(data){
						            layer.tips(data.msg, "#repair", {
						              tips: [1, '#3595CC'],
						              time: 4000
						            });
						            }, "json");
						            return false; 
						      });
						    });
						
						  </script>
						  
						 
						<div style="margin:20px 0px;">
						    <a id="export" class="layui-btn layui-btn-sm" href="javascript:;" autocomplete="off">立即备份</a>
						
						    <a id="optimize" href="<?php echo url('admin/databackup/optimize'); ?>" class="layui-btn layui-btn-sm ">优化数据表</a>
						    <a id="repair" href="<?php echo url('admin/databackup/repair'); ?>" class="layui-btn layui-btn-sm">修复数据表</a>
						   
						    <form id="export-form" method="post" action="<?php echo url('admin/databackup/export'); ?>">
						    <table class="layui-table" lay-even="" lay-skin="row" lay-size="sm">
						
						      <colgroup>
						        <col width="50">
						        <col width="150">
						        <col width="150">
						        <col width="150">
						        <col width="200">
						        <col width="200">
						        <col width="100">
						      </colgroup>
						      <thead>
						        <tr>
						          <th width="48"><input class="all" lay-skin="primary" checked="chedked" type="checkbox" value=""></th>
						          <th>表名</th>
						          <th>数据量</th>
						          <th>数据大小</th>
						          <th>创建时间</th>
						          <th>备份状态</th>
						          <th>操作</th>
						        </tr> 
						      </thead>
						    
						  <tbody>
						    <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$table): $mod = ($i % 2 );++$i;?>   
						       <tr>
						          <td>
						              <input class="ids" checked="chedked" type="checkbox" name="tables[]" value="<?php echo $table['name']; ?>">
						          </td>
						          <td><?php echo $table['name']; ?></td>
						          <td><?php echo $table['rows']; ?></td>
						          <td><?php echo format_bytes($table['data_length']); ?></td>
						          <td><?php echo $table['create_time']; ?></td>
						          <td class="info">备份未开始</td>
						          <td>
						              <a  href="javascript:;" class="layui-btn layui-btn-xs optimiz" tables="<?php echo $table['name']; ?>">优化表</a>&nbsp;
						              <a  href="javascript:;" class="layui-btn layui-btn-xs repair" tables="<?php echo $table['name']; ?>">修复表</a>
						          </td>
						        </tr>
						    <?php endforeach; endif; else: echo "" ;endif; ?>
						      </tbody>
						
						
						    </table>
						  </form>
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
								
							
						</script>
						
						<script type="text/javascript">
						  $('.optimiz').click(function(){
						      var tables = $(this).attr('tables');
						      $.ajax({
						        url:"<?php echo url('admin/databackup/optimize'); ?>"
						        ,data:{tables:tables}
						        ,success:function(res){
						          layer.msg(res.msg);
						        }
						      })
						  })
						
						  $('.repair').on('click',function(){
						    var tables = $(this).attr('tables');
						    $.ajax({
						      url:"<?php echo url('admin/databackup/repair'); ?>"
						      ,data:{tables:tables}
						      ,success:function(res){
						        layer.msg(res.msg);
						      }
						    })
						  })
						</script>
						
						
						
						
                    </div>
                </div>
            </div>
            
        </div>
    </div>
    
   
</body>

</html>