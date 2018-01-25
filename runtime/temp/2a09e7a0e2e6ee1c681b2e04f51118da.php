<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:74:"E:\wampserver\wamp64\www\myadmin/app/admin\view\databackup\importlist.html";i:1516243043;}*/ ?>
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
						<div class="layui-form" style="margin:20px 0;">
    <table class="layui-table"  lay-even="" lay-skin="row" lay-size="sm">

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
       
          <th>备份名称</th>
          <th>卷数</th>
          <th>压缩</th>
          <th>数据大小</th>
          <th>备份时间</th>
          <th>状态</th>
          <th>操作</th>
        </tr> 
      </thead>
    


  <tbody>
    <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): if( count($list)==0 ) : echo "" ;else: foreach($list as $key=>$data): ?>   
       <tr>

          <td><?php echo date('Ymd-His',$data['time']); ?></td>
          <td><?php echo $data['part']; ?></td>
          <td><?php echo $data['compress']; ?></td>
          <td><?php echo format_bytes($data['size']); ?></td>
          <td><?php echo $key; ?></td>
          <td class="status">-</td>
          <td class="action">
              <a class="layui-btn layui-btn-xs db-import" href="<?php echo url('admin/databackup/import',['time'=>$data['time']]); ?>">还原</a>&nbsp;
              <a class="layui-btn layui-btn-xs ajax-get confirm delete" href="javascript:;" time="<?php echo $data['time']; ?>">删除</a>
          </td>
        </tr>
    <?php endforeach; endif; else: echo "" ;endif; ?>
      </tbody>
<script>
layui.use(['jquery','layer'],function(){
      window.$ = layui.$;
      var layer = layui.layer;


      $(".db-import").click(function(){
            var self = this, status = ".";

            $(this).parent().prevAll('.status').html("").html('等待还原');

            $.get(self.href, success, "json");
            window.onbeforeunload = function(){ return "正在还原数据库，请不要关闭！" }
            return false;
        
            function success(data){

                if(data.code==1){

                    $(self).parent().prev().text(data.msg);

                    if(data.data.part){
                        $.get(self.href, 
                            {"part" : data.data.part, "start" : data.data.start}, 
                            success, 
                            "json"
                        );
                        
                    }  else {
                        layer.alert(data.msg);
                        //window.onbeforeunload = function(){ return null; }
                    }
                } else {
                    layer.alert(data.msg);
                }
            }
        });


    //   $(".db-import").click(function(){
    //     // console.log($(this).parents().find(".status").html() );//正常
    //     // console.log($(this).parent().prevAll('.status').html() );
    //     var statusem=$(this).parent().prevAll('.status');
    //     $(this).parent().prevAll('.status').html("").html('等待还原');
    //     thisobj=this;
    //     $.post(this.href, function(data){
         
    //       if(data.code==1){
    //         // statusem.text(""); // 清空数据
    //         // statusem.append('data'); 
    //         // statusem.text("").append('132');
    //         // $(this).parent().prevAll('.status').html("").html(data.msg);//error ：异常原因无法获取当前节点
    //         statusem.html(data.msg);
    //         getdbimport(thisobj,data.data);
    //       }
    //     }, "json");
    //     return false;
    // });

 $('.delete').click(function(){
    var time = $(this).attr('time');
    $.ajax({
      url:"<?php echo url('admin/databackup/del'); ?>"
      ,data:{time:time}
      ,success:function(res){
        layer.msg(res.msg);
        if(res.code == 1) {
          setTimeout(function(){
            location.href = res.url;
          },1500)
        }
      }
    })
 })

});

</script>

    </table>

  </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
    
   
</body>

</html>