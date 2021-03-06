<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:66:"E:\wampserver\wamp64\www\myadmin/app/admin\view\system\system.html";i:1516160184;}*/ ?>
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



    <link href="__ADMINCSS__/animate.min.css" rel="stylesheet">
    <link href="__ADMINCSS__/style.min.css?v=4.0.0" rel="stylesheet">
    <link href="__ADMINCSS__/layui/css/layui.css" rel="stylesheet">

	<!-- layui -->
	<link rel="stylesheet" href="__ADMINCSS__/style.css"  media="all">
	<link rel="stylesheet" href="__LAYUI__/css/layui.css"  media="all">
	<script src="__LAYUI__/layui.js" charset="utf-8"></script>
</head>
<body class="gray-bg">
	<div class="wrapper wrapper-content animated fadeInRight">
		
		<div class="col-sm-12">
			<div class="ibox-title">
				<h5>系统设置</h5>
				<div class="ibox-tools">
					<a href="javascript:location=location;">
						刷新
					</a>
				</div>
			</div>
			<div class="tabs-container">
				<ul class="nav nav-tabs">
					<li class="active"><a data-toggle="tab" href="#tab-1" aria-expanded="true"> 基本设置</a>
					</li>
					<li class=""><a data-toggle="tab" href="#tab-2" aria-expanded="false">附件设置</a>
					</li>
					<li class=""><a data-toggle="tab" href="#tab-3" aria-expanded="false">增加新变量</a>
					</li>
				</ul>
				<div class="tab-content">
					<div id="tab-1" class="tab-pane active">
						<div class="ibox-content">
							<form action="<?php echo url('admin/system/system'); ?>" method="post" class="form-horizontal layui-form">
								<?php if(is_array($res) || $res instanceof \think\Collection || $res instanceof \think\Paginator): $i = 0; $__LIST__ = $res;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;if($vo['vargroup'] == 0): if($vo['vartype'] == 'string'){?>
											<div class="form-group">
												<label class="col-sm-2 control-label"><?php echo $vo['varinfo']; ?></label>
												<div class="col-sm-5">
													<input name="<?php echo $vo['varname']; ?>" type="text" class="form-control" value="<?php echo $vo['varvalue']; ?>" >
													
												</div>
												<label class="col-sm-2 control-label">config('<?php echo $vo['varname']; ?>')</label>
											</div>
										<?php }else if($vo['vartype'] == 'bstring'){?>
											<div class="form-group">
												<label class="col-sm-2 control-label"><?php echo $vo['varinfo']; ?></label>
												<div class="col-sm-5">
													<textarea  name="<?php echo $vo['varname']; ?>" class="form-control" style="height:90px;" ><?php echo $vo['varvalue']; ?></textarea>
												</div>
												<label class="col-sm-2 control-label">config('<?php echo $vo['varname']; ?>')</label>
											</div>
										<?php }else if($vo['vartype'] == 'bool'){?>
											<div class="form-group">
												<label class="col-sm-2 control-label"><?php echo $vo['varinfo']; ?></label>
												<div class="col-sm-5">
												  <input type="radio" name="<?php echo $vo['varname']; ?>" <?php if($vo['varvalue'] == 'Y'): ?>checked<?php endif; ?> value="Y" title="开启"> 
												  <input type="radio" name="<?php echo $vo['varname']; ?>" <?php if($vo['varvalue'] == 'N'): ?>checked<?php endif; ?> value="N" title="关闭" >
												</div>
											</div>
										<?php }endif; endforeach; endif; else: echo "" ;endif; ?>
										
								<div class="form-group">
									<div class="col-sm-4 col-sm-offset-2">
										<button class="btn btn-primary" type="submit">保存内容</button>
										
									</div>
								</div>
							</form>
						</div>
					</div>
					<div id="tab-2" class="tab-pane">
						<div class="ibox-content">
							<form action="<?php echo url('admin/system/system'); ?>" method="post" class="form-horizontal layui-form">
								<?php if(is_array($fujian) || $fujian instanceof \think\Collection || $fujian instanceof \think\Paginator): $i = 0; $__LIST__ = $fujian;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;if($vo['vartype'] == 'string'){?>
											<div class="form-group">
												<label class="col-sm-2 control-label"><?php echo $vo['varinfo']; ?></label>
												<div class="col-sm-5">
													<input name="<?php echo $vo['varname']; ?>" type="text" class="form-control" value="<?php echo $vo['varvalue']; ?>" >
													
												</div>
												<label class="col-sm-2 control-label">config('<?php echo $vo['varname']; ?>')</label>
											</div>
										<?php }else if($vo['vartype'] == 'bstring'){?>
											<div class="form-group">
												<label class="col-sm-2 control-label"><?php echo $vo['varinfo']; ?></label>
												<div class="col-sm-5">
													<textarea  name="<?php echo $vo['varname']; ?>" class="form-control" style="height:90px;" ><?php echo $vo['varvalue']; ?></textarea>
												</div>
												<label class="col-sm-2 control-label">config('<?php echo $vo['varname']; ?>')</label>
											</div>
										<?php }else if($vo['vartype'] == 'bool'){?>
											<div class="form-group">
												<label class="col-sm-2 control-label"><?php echo $vo['varinfo']; ?></label>
												<div class="col-sm-5">
												  <input type="radio" name="<?php echo $vo['varname']; ?>" <?php if($vo['varvalue'] == 'Y'): ?>checked<?php endif; ?> value="Y" title="Y">
												  <input type="radio" name="<?php echo $vo['varname']; ?>" <?php if($vo['varvalue'] == 'N'): ?>checked<?php endif; ?> value="N" title="N" >
												</div>
											</div>
										<?php }endforeach; endif; else: echo "" ;endif; ?>
										
								<div class="form-group">
									<div class="col-sm-4 col-sm-offset-2">
										<button class="btn btn-primary" type="submit">保存内容</button>
										
									</div>
								</div>
							</form>
						</div>
					</div>
					<div id="tab-3" class="tab-pane ">
						<div class="ibox-content">
							<form action="<?php echo url('admin/system/add_system'); ?>" method="post" class="form-horizontal layui-form">
								
								<div class="form-group">
									<label class="col-sm-2 control-label">变量名称</label>
									<div class="col-sm-5">
										<input name="varname" type="text" class="form-control" value="" required >
										
									</div>
									<label class="col-sm-3 control-label">系统会自动为变量添加 'cfg_' 前缀</label>
								</div>
								
								<div class="form-group">
									<label class="col-sm-2 control-label">参数说明</label>
									<div class="col-sm-5">
										<input name="varinfo" type="text" class="form-control" value="" required >
										
									</div>
									
								</div>
								<div class="form-group">
									<label class="col-sm-2 control-label">变量值</label>
									<div class="col-sm-5">
										<input name="varvalue" type="text" class="form-control" value="" >
									</div>
								</div>
								
								<div class="form-group">
									<label class="col-sm-2 control-label">变量类型</label>
									<div class="col-sm-5">
									  <input type="radio" name="vartype"  value="string" title="文本" checked >
									  <input type="radio" name="vartype"  value="number" title="数字" >
									  <input type="radio" name="vartype"  value="bool" title=" 布尔(Y/N)" >
									  <input type="radio" name="vartype"  value="bstring" title="多行文本" >
									</div>
								</div>
								
								<div class="form-group">
									<label class="col-sm-2 control-label">Select</label>

									<div class="col-sm-10">
										<div class="col-sm-4 m-l-n">
											<select name="vargroup" class="form-control" >
												<option value="0" selected="selected">基本设置</option>
												<option value="1">附件设置</option>
											</select>
										</div>
									</div>
								</div>
								
								<div class="form-group">
									<div class="col-sm-4 col-sm-offset-2">
										<button class="btn btn-primary" type="submit">保存内容</button>
										
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>


			</div>
		</div>
		
    </div>
    <script src="__ADMINJS__/jquery.min.js?v=2.1.4"></script>
    <script src="__ADMINJS__/bootstrap.min.js?v=3.3.5"></script>
    <script src="__ADMINJS__/content.min.js?v=1.0.0"></script>
    <script src="__ADMINCSS__/layui/layui.js"></script>
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
    layer.alert(JSON.stringify(data.field), {
      title: '最终的提交信息'
    })
    return false;
  });
  
  
});
</script>
</body>

</html>