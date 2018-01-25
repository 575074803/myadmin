<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:65:"E:\wampserver\wamp64\www\myadmin/app/admin\view\wechat\index.html";i:1515741039;}*/ ?>
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
                        <h5>公众号管理</h5>
                        <div class="ibox-tools">
                            <a href="javascript:location=location;">刷新</a>
                        </div>
                    </div>
					<form action="<?php echo url('wechat/index'); ?>" method="post" class="layui-form layui-form-pane">
                    <div class="ibox-content">
						  <div class="layui-form-item">
						    <label class="layui-form-label">服务器地址</label>
						    <div class="layui-input-4">
						      <input value="<?php echo $row['server_address']; ?>" type="text" name="server_address" autocomplete="off" placeholder="请输入服务器地址" class="layui-input">
						    </div>
						  </div>
						  <div class="layui-form-item">
						    <label class="layui-form-label">AppID</label>
						    <div class="layui-input-4">
						      <input value="<?php echo $row['AppID']; ?>" type="text" name="AppID" autocomplete="off" placeholder="请输入AppID" class="layui-input">
						    </div>
						  </div>
						  
						  <div class="layui-form-item">
						    <label class="layui-form-label">AppSecret</label>
						    <div class="layui-input-4">
						      <input value="<?php echo $row['AppSecret']; ?>" type="text" name="AppSecret" autocomplete="off" placeholder="请输入AppSecret" class="layui-input">
						    </div>
						  </div>
						  
						  <div class="layui-form-item">
						    <label class="layui-form-label">Token</label>
						    <div class="layui-input-4">
						      <input value="<?php echo $row['Token']; ?>" type="text" name="Token" autocomplete="off" placeholder="请输入AppSecret" class="layui-input">
						    </div>
						  </div>
						  
						  <div class="layui-form-item">
						    <label class="layui-form-label">EncodingAESKey</label>
						    <div class="layui-input-4">
						      <input value="<?php echo $row['EncodingAESKey']; ?>" type="text" name="EncodingAESKey"  autocomplete="off" placeholder="请输入EncodingAESKey" class="layui-input">
						    </div>
						  </div>
						  
						  <div class="layui-form-item layui-form-text">
						    <label class="layui-form-label">关注回复</label>
						    <div class="layui-input-block">
						      <textarea name="guanzhu" placeholder="请输入关注回复" class="layui-textarea"><?php echo $row['guanzhu']; ?></textarea>
						    </div>
						  </div>
						  
						  <div class="layui-form-item layui-form-text">
						    <label class="layui-form-label">默认回复</label>
						    <div class="layui-input-block">
						      <textarea name="moren" placeholder="请输入默认回复" class="layui-textarea"><?php echo $row['moren']; ?></textarea>
						    </div>
						  </div>
						 
						  <div class="layui-form-item">
						    <div class="">
						      <button class="layui-btn" lay-submit="" lay-filter="demo1">立即提交</button>
						      
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
		  ,laydate = layui.laydate;
		  
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
		      if(value.length < 5){
		        return '标题至少得5个字符啊';
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
		    $.post("<?php echo url('wechat/index'); ?>",data.field, function (res) {
				//alert(res);
				if(res.status == 200){
					layer.msg(res.msg, {icon: 1});
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