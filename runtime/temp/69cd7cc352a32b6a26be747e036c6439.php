<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:54:"F:\phpwww\myadmin/app/admin\view\module\field_add.html";i:1515735130;}*/ ?>
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
                        <h5>添加字段</h5>
                        <div class="ibox-tools">
                            <a href="javascript:location=location;">
                                刷新
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <form action="<?php echo url('module/field_add'); ?>" method="post" class="form-horizontal">
							<input type="hidden" name="moduleid" value="<?php echo $moduleid; ?>">
							<div class="form-group">
                                <label class="col-sm-2 control-label">字段类型</label>
                                <div class="col-sm-5">
                                    <select id="type" name="type" class="form-control m-b" >
                                        <option value='' >请选择字段类型</option>
										<option value="catid">栏目</option>
										<option value="title" >单行文本</option>
										<option value="textarea" >多行文本</option>
										<option value="editor" >编辑器</option>
										<option value="select" >下拉列表</option>
										<option value="radio" >单选按钮</option>
										<option value="checkbox" >复选框</option>
										<option value="image" >单张图片</option>
										<option value="images" >多张图片</option>
										<option value="file" >文件上传</option>
										<option value="number" >数字</option>
										<option value="datetime" >日期和时间</option>
										<option value="posid" >推荐位</option>
										<option value="groupid" >会员组</option>
										<option value="linkage" >联动菜单</option>
										<option value="template">模板选择</option>
                                    </select>
                                </div>
                            </div>
							<script>
								$("#type").change(function(){
									var  type = $(this).val();
									
									$.post("<?php echo url('module/field_add'); ?>", { type:type}, function (data) {
										$("#field_setup").html(data);
										
									});
								});
							</script>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">字段名</label>

                                <div class="col-sm-5">
                                    <input name="field" type="text" class="form-control" placeholder="请输入字段名,例:title" required="" >
                                </div>
                            </div>
							<div class="form-group">
                                <label class="col-sm-2 control-label">别名</label>

                                <div class="col-sm-5">
                                    <input name="name" type="text" class="form-control" placeholder="请输入别名,例:标题" required="">
                                </div>
                            </div>
							
							<div class="form-group">
                                <label class="col-sm-2 control-label">字段设置</label>

                                <div id="field_setup" class="col-sm-5">
									
										
								</div>
                            </div>
							<script>
								$(function(){
									var  type = $("#type").val();
									
									$.post("<?php echo url('admin/module/fieldadd'); ?>", { type:type}, function (data) {
										$("#field_setup").html(data);
										
									});
								});
							</script>
							<div class="form-group">
                                <label class="col-sm-2 control-label">class名称</label>

                                <div class="col-sm-5">
                                    <input name="class" type="text" class="form-control" placeholder="请输入class名称" >
                                </div>
                            </div>
							
							<div class="form-group">
                                <label class="col-sm-2 control-label">
                                    	必填
                                </label>
								<div class="radio i-checks">
									<label>
										<input type="radio"  value="1" name="required"> <i></i> 是
										<input type="radio"   value="0" name="required" checked=""> <i></i> 否
										
									</label>
								</div>
                            </div>
							
							<div class="form-group">
                                <label class="col-sm-2 control-label">验证规则</label>

                                <div class="col-sm-5">
                                    <select name="pattern" class="form-control m-b" >
                                        <option value='' >请选择</option>
										<?php if(is_array($pattern) || $pattern instanceof \think\Collection || $pattern instanceof \think\Paginator): $i = 0; $__LIST__ = $pattern;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
											<option value='<?php echo $vo['name']; ?>' ><?php echo $vo['title']; ?></option>
										<?php endforeach; endif; else: echo "" ;endif; ?>
                                    </select>
                                </div>
                            </div>
							
							<div class="form-group">
                                <label class="col-sm-2 control-label">字符长度</label>

                                <div class="col-sm-3">
                                    <input name="maxlength" type="text" class="form-control" placeholder="请输入字符长度" >
                                </div>
								
                            </div>
							
							<div class="form-group">
                                <label class="col-sm-2 control-label">错误信息</label>

                                <div class="col-sm-5">
                                    <input name="errormsg" type="text" class="form-control" placeholder="验证失败错误信息" >
                                </div>
                            </div>
							
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <div class="col-sm-4 col-sm-offset-2">
                                    <button class="btn btn-primary" type="submit">保存内容</button>
                                    <button onclick="javascript:history.back();" class="btn btn-white" type="button">返回</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="__ADMINJS__/jquery.min.js?v=2.1.4"></script>
    <script src="__ADMINJS__/bootstrap.min.js?v=3.3.5"></script>
    <script src="__ADMINJS__/content.min.js?v=1.0.0"></script>
    <script src="__ADMINJS__/plugins/iCheck/icheck.min.js"></script>
    <script>
        $(document).ready(function(){$(".i-checks").iCheck({checkboxClass:"icheckbox_square-green",radioClass:"iradio_square-green",})});
    </script>
    
</body>

</html>