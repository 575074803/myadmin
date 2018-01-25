<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:55:"F:\phpwww\myadmin/app/admin\view\category\cate_add.html";i:1516334385;}*/ ?>
<?php
use think\Db;
?>
<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    

    <title>H+ 后台主题UI框架 - 基本表单</title>
    <meta name="keywords" content="H+后台主题,后台bootstrap框架,会员中心主题,后台HTML,响应式后台">
    <meta name="description" content="H+是一个完全响应式，基于Bootstrap3最新版本开发的扁平化主题，她采用了主流的左右两栏式布局，使用了Html5+CSS3等现代技术">

    <link rel="shortcut icon" href="favicon.ico"> <link href="__ADMINCSS__/bootstrap.min.css?v=3.3.5" rel="stylesheet">
    <link href="__ADMINCSS__/font-awesome.min.css?v=4.4.0" rel="stylesheet">
    <link href="__ADMINCSS__/plugins/iCheck/custom.css" rel="stylesheet">
    <link href="__ADMINCSS__/animate.min.css" rel="stylesheet">
    <link href="__ADMINCSS__/style.min.css?v=4.0.0" rel="stylesheet">
	
	<script src="__ADMINJS__/jquery-2.1.1.js"></script>
	
	<!-- layui -->
	<link rel="stylesheet" href="__ADMINCSS__/style.css"  media="all">
	<link rel="stylesheet" href="__LAYUI__/css/layui.css"  media="all">
	<script src="__LAYUI__/layui.js" charset="utf-8"></script>
	<!-- layui下拉多选-->
	<script src="__LAYUI__/layui-mz-min.js" charset="utf-8"></script>
	
	
	<!-- ueditor编辑器 -->
	<script type="text/javascript" charset="utf-8" src="__ADMIN__/ueditor/ueditor.config.js"></script>
	<script type="text/javascript" charset="utf-8" src="__ADMIN__/ueditor/ueditor.all.min.js"> </script>
</head>

<body class="gray-bg">
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-sm-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>添加类别</h5>
                        <div class="ibox-tools">
                            <a href="javascript:location=location;">刷新</a>
                        </div>
                    </div>
					<form action="" method="post" class="layui-form layui-form-pane">
                    <div class="ibox-content">
                		
						  <!-- 多选下拉 -->
						<div class="layui-form-item">
						    <label class="layui-form-label">上级栏目</label>
						    <div class="layui-input-4">
						      <select name="pid" lay-filter="aihao" multiple="multiple">
						        <?php
										function Show($id=0, $i=0)
										{
											$res=Db::name('category')->where('parentid',$id)->order('orderid asc')->select();
											foreach($res as $vo){
										?>
											<option value="<?php echo $vo['id']; ?>" ><?php
												for($j=0;$j<$i;$j++){
													if($vo['parentid'] != 0){
															echo '|—';
														}
												}
											?><?php echo $vo['catname']; ?>
											</option>
										<?php
											Show($vo['id'],$i+1);
											}
										}
										
										Show(0,0);
										?>
						      </select>
						    </div>
						  </div>
						  
						  
						  
						  <div class="layui-form-item">
						    <label class="layui-form-label">类别名称</label>
						    <div class="layui-input-4">
						      <input type="text" name="name" lay-verify="title" autocomplete="off" placeholder="请输入菜单名称" class="layui-input">
						    </div>
						  </div>
						  
						  <div class="layui-form-item layui-form-text">
						    <label class="layui-form-label">描述</label>
						    <div class="layui-input-block">
						      <textarea name="" placeholder="请输入描述" class="layui-textarea"></textarea>
						    </div>
						  </div>
						  
						  <div class="layui-form-item">
						    <label class="layui-form-label">排序</label>
						    <div class="layui-input-4">
						      <input value="<?php echo GetOrderID('wxMenu'); ?>" type="text" name="orderid" autocomplete="off" placeholder="请输入排序" class="layui-input">
						    </div>
						  </div>
						  
						  <div class="layui-form-item">
						    <label class="layui-form-label">是否审核</label>
						    <div class="layui-input-block">
						      <input type="radio" name="open" value="1" title="显示" checked="">
						      <input type="radio" name="open" value="0" title="不显示">
						    </div>
						  </div>
						 
						  <div class="layui-form-item">
						    <div class="">
						      <button class="layui-btn" lay-submit="" lay-filter="demo1">立即提交</button>
						      <button onclick="javascript:history.back();" class="layui-btn layui-btn-primary">返回</button>
						    </div>
						  </div>
						  
					</div>	
					</form>
					
                </div>
            </div>
        </div>
    </div>

    <script>
		layui.use(['form', 'layedit', 'laydate'], function(){
		  var form = layui.form
		  ,layer = layui.layer
		  ,layedit = layui.layedit
		  ,laydate = layui.laydate
		   ,$ = layui.jquery;
		  
			layui.selMeltiple($); 
									
		  //日期
		  laydate.render({
		    elem: '#date'
		  });
		  laydate.render({
		    elem: '#date1'
		  });
		  
		  //创建一个编辑器
		  var editIndex = layedit.build('LAY_demo_editor');
		 
		  //自定义验证规则
		  form.verify({
		    title: function(value){
		      if(value == ''){
		        return '此提交框不能为空';
		      }
		    }
		    ,pass: [/(.+){6,12}$/, '密码必须6到12位']
		    ,content: function(value){
		      layedit.sync(editIndex);
		    }
		  });
		  
		  //监听指定开关
		  form.on('switch(switchTest)', function(data){
		    layer.msg('开关checked：'+ (this.checked ? 'true' : 'false'), {
		      offset: '6px'
		    });
		    layer.tips('温馨提示：请注意开关状态的文字可以随意定义，而不仅仅是ON|OFF', data.othis)
		  });
		  
		  //监听提交
		  form.on('submit(demo1)', function(data){
		    $.post("<?php echo url('wechat/menu_add'); ?>",data.field, function (res) {
				//alert(res);
				if(res.status == 200){
					layer.msg(res.msg, {icon: 1});
					window.location.href = res.url;
				}
				if(res.status == 404){
					layer.msg(res.msg, {icon: 5});
				}
			});
		    return false;
		  });	  
		});
		</script>
    
   
    <script src="__ADMINJS__/plugins/iCheck/icheck.min.js"></script>
    <script>
        $(document).ready(function(){$(".i-checks").iCheck({checkboxClass:"icheckbox_square-green",radioClass:"iradio_square-green",})});
    </script>
    
</body>

</html>