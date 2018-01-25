<?php

// +----------------------------------------------------------------------
// | liftforgames.com [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Author: tangyin <cicicoco321@163.com> QQ:545764358
// +----------------------------------------------------------------------


namespace app\admin\controller;
use think\Db;
use think\Request;
use think\Session;
use think\Controller;


class Module extends AdminController
{
    
    function _initialize()
    {
        
        parent::_initialize();
        //new model类
        $this->module = model('Module');
        
        $field_pattern = [
            ['name'=>'defaul','title'=>'默认'],
            ['name'=>'email','title'=>'电子邮件'],
            ['name'=>'url','title'=>'网址'],
            ['name'=>'date','title'=>'日期'],
            ['name'=>'number','title'=>'有效的数值'],
            ['name'=>'digits','title'=>'数字'],
            ['name'=>'creditcard','title'=>'信用卡号码'],
            ['name'=>'equalTo','title'=>'再次输入相同的值'],
            ['name'=>'ip4','title'=>'IP'],
            ['name'=>'mobile','title'=>'手机号码'],
            ['name'=>'zipcode','title'=>'邮编'],
            ['name'=>'qq','title'=>'QQ'],
            ['name'=>'idcard','title'=>'身份证号'],
            ['name'=>'chinese','title'=>'中文字符'],
            ['name'=>'cn_username','title'=>'中文英文数字和下划线'],
            ['name'=>'tel','title'=>'电话号码'],
            ['name'=>'english','title'=>'英文'],
            ['name'=>'en_num','title'=>'英文数字和下划线'],
        ];
        $this->assign('pattern', $field_pattern);
        
    }
    
    public function index()
    {
        $row=Db::table('sh_module')->order("orderid asc")->select();
        $this->assign('row',$row);
        return $this->fetch();

    }
    //模型添加
    public function add(){

        if($_POST){
            $post = input('post.');
            $data['title'] = $post['title'];
            $data['name'] = $post['name'];
            $data['description'] = $post['description'];
            $data['status'] = 1;
            
            //在module表中在模型是否存在
            $name_res = DB::name('module')->where('name',$post['name'])->find();
            if($name_res){
                $name = $post['name'].'表已存在';
                $this->error($name);
                exit;
            }
            //在数据库中查表是否存在
            $sql = "select table_name from information_schema.tables where table_schema='".config('database.database')."' and table_name='".config('database.prefix').$post['name']."'";
            $biao =  DB::query($sql);
            if($biao){
                $name = $post['name'].'表已存在于数据库中';
                $this->error($name);
                exit;
            }
            $data['orderid'] = GetOrderID('module');
            $res = DB::name('module')->insert($data);
            $moduleid = Db::name('module')->getLastInsID();
            
            $emptytable = $post['emptytable'];
            if($res){
                $prefix = config('database.prefix');
                $tablename = $prefix.$post['name'];
                //普通文字表
                if($emptytable=='0'){
                    Db::execute("CREATE TABLE `".$tablename."` (
        			  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
                      `siteid` int(11) unsigned NOT NULL,
        			  `catid` smallint(5) unsigned NOT NULL DEFAULT '0',
        			  `userid` int(8) unsigned NOT NULL DEFAULT '0',
        			  `username` varchar(40) NOT NULL DEFAULT '',
        			  `title` varchar(120) NOT NULL DEFAULT '',
        			  `title_style` varchar(225) NOT NULL DEFAULT '',
        			  `thumb` varchar(225) NOT NULL DEFAULT '',
        			  `keywords` varchar(120) NOT NULL DEFAULT '',
        			  `description` mediumtext NOT NULL,
        			  `content` mediumtext NOT NULL,
        			  `template` varchar(40) NOT NULL DEFAULT '', 
        			  `posid` tinyint(2) unsigned NOT NULL DEFAULT '0',
        			  `status` tinyint(1) unsigned NOT NULL DEFAULT '0',
        			  `recommend` tinyint(1) unsigned NOT NULL DEFAULT '0',
        			  `readgroup` varchar(100) NOT NULL DEFAULT '',
        			  `readpoint` smallint(5) NOT NULL DEFAULT '0',
        			  `orderid` int(10) unsigned NOT NULL DEFAULT '0',
        			  `hits` int(11) unsigned NOT NULL DEFAULT '0',
        			  `createtime` int(11) unsigned NOT NULL DEFAULT '0',
        			  `updatetime` int(11) unsigned NOT NULL DEFAULT '0',
        			  PRIMARY KEY (`id`),
        			  KEY `status` (`id`,`status`,`listorder`),
        			  KEY `catid` (`id`,`catid`,`status`),
        			  KEY `listorder` (`id`,`catid`,`status`,`listorder`)
        			) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8");
                    Db::execute("INSERT INTO `".$prefix."field` VALUES ('', '".$moduleid."', 'catid', '栏目', '', '1', '1', '6', '', '必须选择一个栏目', '', 'catid', '','1','', '1', '1', '1')");
                    Db::execute("INSERT INTO `".$prefix."field` VALUES ('', '".$moduleid."', 'title', '标题', '', '1', '1', '80', '', '标题必须为1-80个字符', '', 'title', 'array (\n  \'thumb\' => \'1\',\n  \'style\' => \'1\',\n  \'size\' => \'55\',\n)','1','',  '2', '1', '1')");
                    Db::execute("INSERT INTO `".$prefix."field` VALUES ('', '".$moduleid."', 'keywords', '关键词', '', '0', '0', '80', '', '', '', 'text', 'array (\n  \'size\' => \'55\',\n  \'default\' => \'\',\n  \'ispassword\' => \'0\',\n  \'fieldtype\' => \'varchar\',\n)','1','',  '3', '1', '1')");
                    Db::execute("INSERT INTO `".$prefix."field` VALUES ('', '".$moduleid."', 'description', 'SEO简介', '', '0', '0', '0', '', '', '', 'textarea', 'array (\n  \'fieldtype\' => \'mediumtext\',\n  \'rows\' => \'4\',\n  \'cols\' => \'55\',\n  \'default\' => \'\',\n)','1','',  '4', '1', '1')");
                    Db::execute("INSERT INTO `".$prefix."field` VALUES ('', '".$moduleid."', 'content', '内容', '', '0', '0', '0', '', '', '', 'editor', 'array (\n  \'toolbar\' => \'full\',\n  \'default\' => \'\',\n  \'height\' => \'\',\n  \'showpage\' => \'1\',\n  \'enablekeylink\' => \'0\',\n  \'replacenum\' => \'\',\n  \'enablesaveimage\' => \'0\',\n  \'flashupload\' => \'1\',\n  \'alowuploadexts\' => \'\',\n)','1','',  '5', '1', '1')");
                    Db::execute("INSERT INTO `".$prefix."field` VALUES ('', '".$moduleid."', 'createtime', '发布时间', '', '1', '0', '0', 'date', '', '', 'datetime', '','1','',  '6', '1', '1')");
                    Db::execute("INSERT INTO `".$prefix."field` VALUES ('', '".$moduleid."', 'status', '状态', '', '0', '0', '0', '', '', '', 'radio', 'array (\n  \'options\' => \'发布|1\r\n定时发布|0\',\n  \'fieldtype\' => \'tinyint\',\n  \'numbertype\' => \'1\',\n  \'labelwidth\' => \'75\',\n  \'default\' => \'1\',\n)','1','','7', '1', '1')");
                    Db::execute("INSERT INTO `".$prefix."field` VALUES ('', '".$moduleid."', 'recommend', '允许评论', '', '0', '0', '1', '', '', '', 'radio', 'array (\n  \'options\' => \'允许评论|1\r\n不允许评论|0\',\n  \'fieldtype\' => \'tinyint\',\n  \'numbertype\' => \'1\',\n  \'labelwidth\' => \'\',\n  \'default\' => \'\',\n)','1','', '8', '0', '0')");
                    Db::execute("INSERT INTO `".$prefix."field` VALUES ('', '".$moduleid."', 'readpoint', '阅读收费', '', '0', '0', '5', '', '', '', 'number', 'array (\n  \'size\' => \'5\',\n  \'numbertype\' => \'1\',\n  \'decimaldigits\' => \'0\',\n  \'default\' => \'0\',\n)','1','', '9', '0', '0')");
                    Db::execute("INSERT INTO `".$prefix."field` VALUES ('', '".$moduleid."', 'hits', '点击次数', '', '0', '0', '8', '', '', '', 'number', 'array (\n  \'size\' => \'10\',\n  \'numbertype\' => \'1\',\n  \'decimaldigits\' => \'0\',\n  \'default\' => \'0\',\n)','1','',  '10', '0', '0')");
                    Db::execute("INSERT INTO `".$prefix."field` VALUES ('', '".$moduleid."', 'readgroup', '访问权限', '', '0', '0', '0', '', '', '', 'groupid', 'array (\n  \'inputtype\' => \'checkbox\',\n  \'fieldtype\' => \'tinyint\',\n  \'labelwidth\' => \'85\',\n  \'default\' => \'\',\n)','1','', '11', '0', '1')");
                    Db::execute("INSERT INTO `".$prefix."field` VALUES ('', '".$moduleid."', 'posid', '推荐位', '', '0', '0', '0', '', '', '', 'posid', '','1','', '12', '1', '1')");
                    Db::execute("INSERT INTO `".$prefix."field` VALUES ('', '".$moduleid."', 'template', '模板', '', '0', '0', '0', '', '', '', 'template', '','1','', '13', '1', '1')");
                    //(文章图片表模型)
                }else if($emptytable=='1'){
                    Db::execute("CREATE TABLE `".$tablename."` (
                      `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
                      `siteid` smallint(5) unsigned NOT NULL DEFAULT '1' COMMENT '站点id',
                      `catid` smallint(5) unsigned NOT NULL COMMENT '所属栏目id',
                      `title` varchar(80) NOT NULL COMMENT '标题',
                      `flag` varchar(30) NOT NULL COMMENT '属性',
                      `source` varchar(50) NOT NULL COMMENT '文章来源',
                      `author` varchar(50) NOT NULL COMMENT '作者编辑',
                      `linkurl` varchar(255) NOT NULL COMMENT '跳转链接',
                      `keywords` varchar(50) NOT NULL COMMENT '关键词',
                      `description` mediumtext NOT NULL COMMENT '摘要',
                      `content` text NOT NULL COMMENT '详细内容',
                      `picurl` varchar(100) NOT NULL COMMENT '缩略图片',
                      `picarr` text NOT NULL COMMENT '组图',
                      `hits` mediumint(8) unsigned NOT NULL COMMENT '点击次数',
                      `orderid` int(10) unsigned NOT NULL COMMENT '排列排序',
                      `posttime` int(10) NOT NULL COMMENT '更新时间',
                      `checkinfo` tinyint(3) NOT NULL COMMENT '审核状态',
                      
                      PRIMARY KEY (`id`)
                    ) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;");
                    
                    //Db::execute("INSERT INTO `".$prefix."field` VALUES ('', '".$moduleid."', 'catid', '栏目', '', '1', '1', '6', '', '必须选择一个栏目', '', 'catid', '','1','', '1', '1', '1')");
                    Db::execute("INSERT INTO `".$prefix."field` VALUES ('', '".$moduleid."', 'title', '标题', '', '1', '1', '80', '', '', '', 'title', 'array (\n \'default\' => \'\',\'ispassword\' => \'0\',\'fieldtype\' => \'varchar\',\n)','1','',  '1', '1', '1')");
                    
                    Db::execute("INSERT INTO `".$prefix."field` VALUES ('', '".$moduleid."', 'source', '文章来源', '', '0', '1', '50', '', '', '', 'title', 'array (\n \'default\' => \'\',\'ispassword\' => \'0\',\'fieldtype\' => \'varchar\',\n)','1','',  '2', '1', '1')");
                    Db::execute("INSERT INTO `".$prefix."field` VALUES ('', '".$moduleid."', 'author', '作者编辑', '', '0', '1', '50', '', '', '', 'title', 'array (\n \'default\' => \'\',\'ispassword\' => \'0\',\'fieldtype\' => \'varchar\',\n)','1','',  '3', '1', '1')");
                    Db::execute("INSERT INTO `".$prefix."field` VALUES ('', '".$moduleid."', 'linkurl', '跳转链接', '', '0', '1', '255', '', '', '', 'title', 'array (\n \'default\' => \'\',\'ispassword\' => \'0\',\'fieldtype\' => \'varchar\',\n)','1','',  '4', '1', '1')");
                    Db::execute("INSERT INTO `".$prefix."field` VALUES ('', '".$moduleid."', 'keywords', '关键词', '', '0', '1', '50', '', '', '', 'title', 'array (\n \'default\' => \'\',\'ispassword\' => \'0\',\'fieldtype\' => \'varchar\',\n)','1','',  '5', '1', '1')");
                    
                    Db::execute("INSERT INTO `".$prefix."field` VALUES ('', '".$moduleid."', 'description', '摘要', '', '0', '0', '0', '', '', '', 'textarea', 'array (\n \'fieldtype\' => \'mediumtext\',\'default\' => \'\', \n )','1','',  '6', '1', '1')");
                    Db::execute("INSERT INTO `".$prefix."field` VALUES ('', '".$moduleid."', 'content', '详细内容', '', '0', '0', '0', '', '', '', 'editor', 'array (\n \'edittype\' => \'UEditor\',\n)','1','',  '7', '1', '1')");
                    
                    Db::execute("INSERT INTO `".$prefix."field` VALUES ('', '".$moduleid."', 'picurl', '缩略图', '', '0', '1', '100', '', '', '', 'image', 'array (\n \'upload_allowext\' => \'jpg|jpeg|gif|png\', \n)','1','',  '8', '1', '1')");
                    Db::execute("INSERT INTO `".$prefix."field` VALUES ('', '".$moduleid."', 'picarr', '组图', '', '0', '0', '0', '', '', '', 'images', 'array (\n \'upload_allowext\' => \'jpg|jpeg|gif|png\', \n)','1','',  '9', '1', '1')");
                    //数字
                    Db::execute("INSERT INTO `".$prefix."field` VALUES ('', '".$moduleid."', 'hits', '点击次数', '', '0', '1', '11', '', '', '', 'number', 'array (\n \'numbertype\' => \'1\',\'decimaldigits\' => \'0\',\'default\' => \'\', \n)','1','',  '10', '1', '1')");
                    Db::execute("INSERT INTO `".$prefix."field` VALUES ('', '".$moduleid."', 'orderid', '排列排序', '', '0', '1', '11', '', '', '', 'number', 'array (\n \'numbertype\' => \'1\',\'decimaldigits\' => \'0\',\'default\' => \'\', \n)','1','',  '11', '1', '1')");
                    Db::execute("INSERT INTO `".$prefix."field` VALUES ('', '".$moduleid."', 'posttime', '更新时间', '', '0', '1', '11', '', '', '', 'datetime', '','1','',  '12', '1', '1')");
                    Db::execute("INSERT INTO `".$prefix."field` VALUES ('', '".$moduleid."', 'checkinfo', '审核状态', '', '0', '1', '11', '', '', '', 'radio', 'array (\n \'options\' => \'审核|1,未审|0\',\'fieldtype\' => \'tinyint\',\'numbertype\' => \'1\',\'default\' => \'\',\n)','1','',  '13', '1', '1')");
                    //单页模型
                }else if($emptytable=='2'){
                    Db::execute("CREATE TABLE `".$tablename."` (
                      `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
                      `siteid` smallint(5) unsigned NOT NULL DEFAULT '1' COMMENT '站点id',
                      `catid` smallint(5) unsigned NOT NULL COMMENT '所属栏目id',
                      `title` varchar(80) NOT NULL COMMENT '标题',
                      `linkurl` varchar(255) NOT NULL COMMENT '跳转链接',
                      `content` text NOT NULL COMMENT '详细内容',
                      `hits` mediumint(8) unsigned NOT NULL COMMENT '点击次数',
                      `orderid` int(10) unsigned NOT NULL COMMENT '排列排序',
                      `posttime` int(10) NOT NULL COMMENT '更新时间',
                      `checkinfo` tinyint(3) NOT NULL COMMENT '审核状态',
                      PRIMARY KEY (`id`)
                    ) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;");

                    Db::execute("INSERT INTO `".$prefix."field` VALUES ('', '".$moduleid."', 'title', '标题', '', '1', '1', '80', '', '', '', 'title', 'array (\n \'default\' => \'\',\'ispassword\' => \'0\',\'fieldtype\' => \'varchar\',\n)','1','',  '1', '1', '1')");
                    Db::execute("INSERT INTO `".$prefix."field` VALUES ('', '".$moduleid."', 'linkurl', '跳转链接', '', '0', '1', '255', '', '', '', 'title', 'array (\n \'default\' => \'\',\'ispassword\' => \'0\',\'fieldtype\' => \'varchar\',\n)','1','',  '4', '1', '1')");
                    Db::execute("INSERT INTO `".$prefix."field` VALUES ('', '".$moduleid."', 'content', '详细内容', '', '0', '0', '0', '', '', '', 'editor', 'array (\n \'edittype\' => \'UEditor\',\n)','1','',  '7', '1', '1')");
                    Db::execute("INSERT INTO `".$prefix."field` VALUES ('', '".$moduleid."', 'hits', '点击次数', '', '0', '1', '11', '', '', '', 'number', 'array (\n \'numbertype\' => \'1\',\'decimaldigits\' => \'0\',\'default\' => \'\', \n)','1','',  '10', '1', '1')");
                    Db::execute("INSERT INTO `".$prefix."field` VALUES ('', '".$moduleid."', 'orderid', '排列排序', '', '0', '1', '11', '', '', '', 'number', 'array (\n \'numbertype\' => \'1\',\'decimaldigits\' => \'0\',\'default\' => \'\', \n)','1','',  '11', '1', '1')");
                    Db::execute("INSERT INTO `".$prefix."field` VALUES ('', '".$moduleid."', 'posttime', '更新时间', '', '0', '1', '11', '', '', '', 'datetime', '','1','',  '12', '1', '1')");
                    Db::execute("INSERT INTO `".$prefix."field` VALUES ('', '".$moduleid."', 'checkinfo', '审核状态', '', '0', '1', '11', '', '', '', 'radio', 'array (\n \'options\' => \'审核|1,未审|0\',\'fieldtype\' => \'tinyint\',\'numbertype\' => \'1\',\'default\' => \'\',\n)','1','',  '13', '1', '1')");

                }
                DB::query($sql);

                $this->success("添加模型成功",url('admin/module/index'));
                
            }
        }else{
            $res = DB::name('authGroup')->where('status',1)->select();
            $this->assign('res',$res);
            return $this->fetch();
        }
    }
    public function edit(){
        if($_POST){
            $post = input('post.');
            $id = $post['id'];
            unset($post['id']);
            
            $res = DB::name('module')->where('id',$id)->update($post);
            if($res){
                $this->success("修改模型成功",url('admin/module/index'));
            }
            
        }else{
            $id=input('id');
            $row = DB::name('module')->where('id',$id)->find();
            $this->assign('row',$row);
            return $this->fetch();
        }
    }


   /*
    public function moduleState(){
       $id=input('post.id');
       $status=Db::name('module')->where(array('id'=>$id))->value('status');//判断当前状态情况

       if($status==1){
           $data['status'] = 0;
           Db::name('module')->where(array('id'=>$id))->update($data);
           $result['info'] = '状态禁止';
           $result['status'] = 1;

       }else{
           $data['status'] = 1;
           Db::name('module')->where(array('id'=>$id))->update($data);
           $result['info'] = '状态开启';
           $result['status'] = 1;
       }
       return $result;
   }
*/
   //删除模型
    function del() {
        $id =input('param.id');
        $r = db('module')->find($id);
        if(!empty($r)){
            $tablename = config('database.prefix').$r['name'];

            $m = db('module')->delete($id);
            if($m){
                Db::execute("DROP TABLE IF EXISTS `".$tablename."`");
                db('Field')->where(array('moduleid'=>$id))->delete();

                $return = array(
                    'status' => 200,
                    'msg' => '删除成功！',
                );
                echo json_encode($return);
                exit();
            }
        }
    }
    /*
   //字段管理 -- 改变字段状态
	public function fieldStatus(){
		$id = input('post.id');
		$fie = DB::name('field')->where('id',$id)->find();
		
		if($fie['status'] == 1){ 
			//启用变禁用
			$data['status'] = 0;
			$status = 'jing';
		}else{
			//禁用变启用
			$data['status'] = 1;
			$status = 'qi';
		}
		
		$res = DB::name('field')->where('id',$id)->update($data);
		
		$return = array(
			'status' => $status
		);
		echo json_encode($return);
	}
    */
    
    //字段管理
    public function field(){
        //系统字段
        $this->assign('sysfield',array('catid','userid','username','title','thumb','keywords','description','posid','status','createtime','url','template'));
        $this->assign('nodostatus',array('catid','title','status','createtime'));
        $list = db('field')->where("moduleid=".input('param.id'))->order('orderid asc,id asc')->select();
        $this->assign('list', $list);
        $this->assign('moduleid',input('param.id'));
        
        return $this->fetch();
    }
    //字段添加
    public function field_add(){
        
        if(request()->isPost()){
            //ajax 提交获取 字段设置
            if(request()->isAjax()){
                $type = input('post.type');
                $this->assign('type',$type);
                return view('field_add_type');
            }
            
            $data = input('post.');

            if($data['field'] == 'file'){
                $this->error('file为系统保留字段，不可用');
                exit;
            }
            if($data['field'] == 'catid'){
                $this->error('catid为系统保留字段，不可用');
                exit;
            }
            //查找字段是否存在于数据表
            $ishave = $this->module->field_exist($data);
            if($ishave) { $this->error('字段名已经存在！');exit();}
            
            //在modle类中 处理表添加字段
            $this->module->get_tablesql($data,'add');
            
            if(empty($data['class'])){
                $data['class'] = $data['field'];
            }
            /*
            $field_str = 'varchar,textarea,select,editor,groupid,typeid,radio,checkbox,number,image,file';
            $field_arr = explode(',',$field_str);
            if(in_array($data['type'],$field_arr)){
                if(empty($data['setup'])){ $this->error('请填写字段设置！');exit;}
            }
            */
            
            if(!empty($data['setup'])) {
                $data['setup'] = array2string($data['setup']);
            }
            $data['orderid']  = GetOrderID('field');//排序
            $data['status'] = 1;
            $res = DB::name('field')->insert($data);
            if($res){
                $this->success('字段新增成功',url('admin/module/field',array('id'=>$data['moduleid'])));
            }
            
            //dump($Fields);
        }else{
            $this->assign('moduleid',input('param.moduleid'));
            return $this->fetch();
        }
    }
    
    
    //字段修改
    public function field_edit(){
        if(request()->isPost()){
            //ajax 提交获取 字段设置
            if(request()->isAjax()){
            
                $id = input('post.id');
                $type = input('post.type');
                
                $setup = DB::name('field')->where('id',$id)->find();
                eval("\$arr = ".$setup['setup'].'; ');
                if(!isset($arr['numbertype'])){$arr['numbertype'] = 0;}
                
                $this->assign('setup',$arr);
                $this->assign('type',$type);
                return view('field_edit_type');
            }
            
            $data = input('post.');
            $id = $data['id'];
            $moduleid = $data['moduleid'];
            
            $new_field = DB::name('field')->where('id',$id)->find();
            $data['oldfield'] = $new_field['field'];
            unset($data['id']);
            
            
            //查找字段是否存在于数据表
            if($new_field['field'] != $data['field']){
                $ishave = $this->module->field_exist($data);
                if($ishave) { $this->error('字段名已经存在！');exit();}
            }
            
            //在modle类中 处理表添加字段
            $this->module->get_tablesql($data,'edit');
            
            if(!empty($data['setup'])) {
                $data['setup'] = array2string($data['setup']);
            }
            unset($data['oldfield']);
            $res = DB::name('field')->where('id',$id)->update($data);
            
            if($res){
                $this->success('字段修改成功',url('admin/module/field',array('id'=>$data['moduleid'])));
            }
        
        }else{
            $id = input('param.id');
            $row = DB::name('field')->where('id',$id)->find();
            $this->assign('row',$row);
            
            $this->assign('moduleid',input('param.moduleid'));
            return $this->fetch();
        }
        
    }
    //字段删除
    function field_del() {
        $id=input('id');
        $prefix=config('database.prefix');
        
        $r=Db::name('field')->find($id);
        $moduleid = $r['moduleid'];
        $name = db('module')->where(array('id'=>$moduleid))->value('name');
        
        $field = $r['field'];//字段名
        $tablename=$prefix.$name;//表名
        
        db('field')->execute("ALTER TABLE `$tablename` DROP `$field`");
        
        $res = db('field')->delete($id);
        if($res){
            $return = array(
    			'status' => '200',
    		);
    		echo json_encode($return);
        }
    }
}
