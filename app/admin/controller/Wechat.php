<?php
namespace app\admin\controller;
use think\Controller;
use think\Db;
use think\Session;
use think\Cookie;
use think\Request;
use think\Config;

class Wechat extends Controller
{

    protected function _initialize()
    {
        //微信设置
        $wxconfig = DB::name('wxConfig')->where('id',1)->find();
        define('APPID', $wxconfig['AppID']);
        define('SECRET', $wxconfig['AppSecret']);
        define('TOKEN', $wxconfig['Token']);
        define('AESKEY', $wxconfig['EncodingAESKey']);

        $this->options = array(
            'appid'=>APPID,
            'appsecret'=>SECRET,
            'token'=>TOKEN,
            'encodingaeskey'=>AESKEY
        );

    }
    //公众号管理
    public function index(){
        if($_POST){
            $data = input('post.');
            //$arr = json_decode($data ,'true');
            $one = DB::name('wxConfig')->where('id',1)->find();
            if($one){
                $res = DB::name('wxConfig')->where('id',1)->update($data);
            }else{
                $res = DB::name('wxConfig')->insert($data);
            }
            if($res){
                $arr = array(
                    'status' =>200,
                    'msg' =>'微信公众号设置修改成功'
                );
                return $arr;
            }else{
                $arr = array(
                    'status' =>404,
                    'msg' =>'微信公众号设置修改失败'
                );
                return $arr;
            }
        }else{



            $row = DB::name('wxConfig')->where('id',1)->find();
            $this->assign('row',$row);
            return $this->fetch();
        }
    }
	
	//菜单管理
    public function menu(){

        $weObj = new \WechatSdk\wechat($this->options);
        //$menu = $weObj->getMenu();

        $this->assign('tablename','wxMenu');
        return $this->fetch();
    }
    //添加菜单
    public function menu_add(){
        if($_POST){
            $data = input('post.');
            $one_res = DB::name('wxMenu')->where('id',$data['pid'])->find();
            if($one_res['type'] == 'view'){
                $arr = array(
                    'status' =>404,
                    'msg' =>'view栏目没有子菜单'
                );
                return $arr;
                exit;
            }
            $one_num =Db::table('sh_wx_menu')->where('pid',$data['pid'])->count();
            if($data['pid'] != 0){
                if($data['type'] == 'click'){
                    $arr = array(
                        'status' =>404,
                        'msg' =>'二级栏目的类型必须为view'
                    );
                    return $arr;
                    exit;
                }
            }
            if($data['pid'] == 0){
                if($one_num >=3){
                    $arr = array(
                        'status' =>404,
                        'msg' =>'顶级栏目不可超过3个'
                    );
                    return $arr;
                    exit;
                }
            }else{
                if($one_num >=5){
                    $arr = array(
                        'status' =>404,
                        'msg' =>'二级栏目不可超过5个'
                    );
                    return $arr;
                    exit;
                }
            }
            $res = DB::name('wxMenu')->insert($data);
            if($res){
                $arr = array(
                    'status' =>200,
                    'msg' =>'添加菜单成功',
                    'url' =>url('wechat/menu')
                );
                return $arr;
            }
        }else{
            $menu = DB::name('wxMenu')->where('pid',0)->where('open',1)->select();
            $this->assign('menu',$menu);
            return $this->fetch();
        }
    }
    //修改菜单
    public function menu_edit(){
        if($_POST){
            $data = input('post.');
            $id = $data['id'];
            unset($data['id']);
            $one_res = DB::name('wxMenu')->where('id',$data['pid'])->find();
            if($one_res['type'] == 'view'){
                $arr = array(
                    'status' =>404,
                    'msg' =>'view栏目没有子菜单'
                );
                return $arr;
                exit;
            }
            $one_num =Db::table('sh_wx_menu')->where('pid',$data['pid'])->count();
            if($data['pid'] != 0){
                if($data['type'] == 'click'){
                    $arr = array(
                        'status' =>404,
                        'msg' =>'二级栏目的类型必须为view'
                    );
                    return $arr;
                    exit;
                }
            }
            if($data['pid'] == 0){
                if($one_num >=3){
                    $arr = array(
                        'status' =>404,
                        'msg' =>'顶级栏目不可超过3个'
                    );
                    return $arr;
                    exit;
                }
            }else{
                if($one_num >=5){
                    $arr = array(
                        'status' =>404,
                        'msg' =>'二级栏目不可超过5个'
                    );
                    return $arr;
                    exit;
                }
            }
            $res = DB::name('wxMenu')->where('id',$id)->update($data);
            if($res){
                $arr = array(
                    'status' =>200,
                    'msg' =>'修改菜单成功',
                    'url' =>url('wechat/menu')
                );
                return $arr;
            }else{
                $arr = array(
                    'status' =>404,
                    'msg' =>'修改失败，内容无改动'
                );
                return $arr;
                exit;

            }
        }else{
            $id = input('param.id');
            $row = DB::name('wxMenu')->where('id',$id)->find();
            $this->assign('row',$row);

            //一级栏目遍历
            $menu = DB::name('wxMenu')->where('pid',0)->where('open',1)->select();
            $this->assign('menu',$menu);
            return $this->fetch();
        }
    }

   //删除菜单
    public function menu_del(){

        $post = input('post.');

        $auth =  DB::name($post['tablename'])->where('pid',$post['id'])->select();
        if($auth){
            $return = array(
                'status' => 404,
                'msg' =>'请先删除子栏目'
            );
            echo json_encode($return);
            exit;
        }

        $res = Db::name($post['tablename'])->where($post['whereid'],$post['id'])->delete();

        if($res){
            $return = array(
                'status' => 200
            );
            echo json_encode($return);
        }

    }

    //生成菜单
    public function menu_create(){
        $one_menu = DB::name('wxMenu')->where('pid',0)->select();

        //组装成可以发送微信的数组
        $array = array();
        $arr1 = array();
        $arr2= array();
        foreach($one_menu as $v){
            if($v['type'] == 'view'  and $v['open'] == 1){
                $arr1 = array('type'=>'view','name'=>$v['name'],'url'=>$v['value']);
                array_push($array,$arr1);
            }
            if($v['type'] == 'click'  and $v['open'] == 1){
                $two_menu = DB::name('wxMenu')->where('pid',$v['id'])->select();
                $er_array = array();
                foreach($two_menu as $v2){
                    $arr2 = array('type'=> 'view','name'=>$v2['name'],'url'=>$v2['value']);
                    array_push($er_array,$arr2);
                    $arr2=array();
                }
                $arr1 = array('name'=>$v['name'],'sub_button'=>$er_array);
                array_push($array,$arr1);
            }
            $arr1=array();
        }
        $newmenu =  array(
            "button"=>$array
        );
        /*
         $newmenu1 =  array(
             "button"=>
                 array(
                     array('type'=>'view','name'=>'一级菜单4','url'=>'http://design.nabel.cc'),
                     array('name'=>'会员中心','sub_button'=>array(
                         array('type'=> 'view','name'=>'会员绑定1','url'=>'http://design.nabel.cc/budi.php'),
                         array('type'=> 'view','name'=> '我的会员1','url'=> 'http://design.nabel.cc/budi.php')
                     )
                     )
                 )
         );*/
        $weObj = new \WechatSdk\wechat($this->options);
        $result = $weObj->createMenu($newmenu);

        if($result){
            $this->success('生成菜单成功',url('wechat/menu'));
        }
    }



    //文本回复
    public function text(){
        $res = DB::name('wxReply')->where('msgType','text')->select();
        $this->assign('res',$res);

        $this->assign('tablename','wxReply');
        return $this->fetch();
    }

    //文本回复-添加
    public function text_add(){
        if($_POST){
            $data = input('post.');
            unset($data['file']);
            $data['msgType'] = 'text';
            $data['posttime'] = time();

            $have = DB::name('wxReply')->where('keyword',$data['keyword'])->select();
            if($have){
                $arr = array(
                    'status' =>404,
                    'msg' =>$data['keyword'].'关键字已存在'
                );
                return $arr;
                exit;
            }

            $res = DB::name('wxReply')->insert($data);
            if($res){
                $arr = array(
                    'status' =>200,
                    'msg' =>'添加文本成功',
                    'url' =>url('wechat/text')
                );
                return $arr;
            }else{
                $arr = array(
                    'status' =>404,
                    'msg' =>'添加文本失败'
                );
                return $arr;
            }
        }else{
            return $this->fetch();
        }
    }

    //文本回复-修改
    public function text_edit(){
        if($_POST){
            $data =input('post.');
            unset($data['file']);
            $id = $data['id'];
            unset($data['id']);

            $res = DB::name('wxReply')->where('id',$id)->update($data);
            if($res){
                $arr = array(
                    'status' =>200,
                    'msg' =>'修改文本成功',
                    'url' =>url('wechat/text')
                );
                return $arr;
            }else{
                $arr = array(
                    'status' =>404,
                    'msg' =>'修改文本失败'
                );
                return $arr;

            }
        }else{
            $id = input('param.id');
            $row = DB::name('wxReply')->where('id',$id)->find();
            $this->assign('row',$row);
            return $this->fetch();
        }
    }
    //文本回复 - 删除
    public function text_del(){
        $post = input('post.');

        $res = Db::name($post['tablename'])->where($post['whereid'],$post['id'])->delete();

        if($res){
            $return = array(
                'status' => 200
            );
            echo json_encode($return);
        }

    }

    //图文
    public function img(){
        $res = DB::name('wxReply')->where('msgType','image')->select();
        $this->assign('res',$res);

        $this->assign('tablename','wxReply');
        return $this->fetch();
    }

    //图文 - 添加
    public function img_add(){
        if($_POST){
            $data = input('post.');

            $have = DB::name('wxReply')->where('keyword',$data['keyword'])->select();
            if($have){
                $arr = array(
                    'status' =>404,
                    'msg' =>$data['keyword'].'关键字已存在'
                );
                return $arr;
                exit;
            }

            $vo['keyword'] = $data['keyword'];
            $vo['msgType'] = 'image';
            $vo['posttime'] = time();
            $res = DB::name('wxReply')->insert($vo);
            $wxId = Db::name('wxReply')->getLastInsID();
            if($res){
                $to['reply_id'] = $wxId;
                $to['title'] = $data['title'];
                $to['description'] = $data['description'];
                $to['picurl'] = $data['picurl'];
                $to['url'] = $data['url'];
                $result=DB::name('wxReplyContent')->insert($to);
                if($result){
                    $arr = array(
                        'status' =>200,
                        'msg' =>'添加图文成功',
                        'url'   =>url('wechat/img')
                    );
                    return $arr;
                }
            }

        }else{
            return $this->fetch();
        }
    }

    //图文 - 修改
    public function img_edit(){
        if($_POST){
            $data = input('post.');
            $id = $data['id'];
            $vo['keyword'] = $data['keyword'];
            $vo['msgType'] = 'image';
            $vo['posttime'] = time();

            DB::name('wxReply')->where('id',$id)->update($vo);

            $to['title'] = $data['title'];
            $to['description'] = $data['description'];
            $to['picurl'] = $data['picurl'];
            $to['url'] = $data['url'];
            DB::name('wxReplyContent')->where('reply_id',$id)->update($to);

            $arr = array(
                'status' =>200,
                'msg' =>'修改图文成功',
                'url'   =>url('wechat/img')
            );
            return $arr;

        }else{
            $id = input('param.id');
            $rep = DB::name('wxReply')->where('id',$id)->find();
            $this->assign('rep',$rep);
            $rep_con = DB::name('wxReplyContent')->where('reply_id',$id)->find();
            $this->assign('rep_con',$rep_con);
            return $this->fetch();
        }

    }

    //图文 - 删除
    public function img_del(){
        $post = input('post.');
        $res = Db::name($post['tablename'])->where($post['whereid'],$post['id'])->delete();
        if($res){
            $return = array(
                'status' => 200
            );
            echo json_encode($return);
        }
    }

    //多图文
    public function images(){
        $res = DB::name('wxReply')->where('msgType','images')->select();
        foreach($res as $k=>$v){
            $recon_num =Db::table('sh_wx_reply_content')->where('reply_id',$v['id'])->count();
            $res[$k]['recon_num'] = $recon_num;
        }
        $this->assign('res',$res);

        $this->assign('tablename','wxReply');
        return $this->fetch();
    }

    //多图片 - 添加关键字
    public function images_add(){
        if($_POST){
            $data = input('post.');

            $data['msgType'] = 'images';
            $data['posttime'] = time();

            $have = DB::name('wxReply')->where('keyword',$data['keyword'])->select();
            if($have){
                $arr = array(
                    'status' =>404,
                    'msg' =>$data['keyword'].'关键字已存在'
                );
                return $arr;
                exit;
            }

            $res = DB::name('wxReply')->insert($data);
            if($res){
                $arr = array(
                    'status' =>200,
                    'msg' =>'添加多图文成功',
                    'url'   =>url('wechat/images')
                );
                return $arr;
            }
        }else{

            return $this->fetch();
        }
    }

    //多图片 - 图文详情
    public function images_list(){

        $reply_id = input('param.id');

        $res = DB::name('wxReplyContent')->where('reply_id',$reply_id)->select();
        $this->assign('res',$res);

        $this->assign('tablename','wxReplyContent');

        return $this->fetch();
    }
    //多图片 - 图文详情添加
    public function images_list_add(){
        if($_POST){
            $data = input('post.');
            unset($data['file']);
            $data['posttime'] = time();

            $recon_num =Db::table('sh_wx_reply_content')->where('reply_id',$data['reply_id'])->count();
            if($recon_num >= 8){
                $arr = array(
                    'status' =>404,
                    'msg' =>'图文详情不可超过8篇'
                );
                return $arr;
                exit;
            }

            $res = DB::name('wxReplyContent')->insert($data);
            if($res){
                $arr = array(
                    'status' =>200,
                    'msg' =>'添加多图文详情成功',
                    'url'   =>url('wechat/images_list',array('id'=>$data['reply_id']))
                );
                return $arr;
            }
        }else{

            return $this->fetch();
        }
    }

    //多图片 - 图文详情修改
    public function images_list_edit(){
        if($_POST){
            $data= input('post.');
            unset($data['file']);
            $id = $data['id'];
            unset($data['id']);
            $res = DB::name('wxReplyContent')->where('id',$id)->update($data);
            if($res){
                $rep= DB::name('wxReplyContent')->where('id',$id)->field('reply_id')->find();
                $arr = array(
                    'status' =>200,
                    'msg' =>'修改多图文详情成功',
                    'url'   =>url('wechat/images_list',array('id'=>$rep['reply_id']))
                );
                return $arr;

            }else{
                $arr = array(
                    'status' =>404,
                    'msg' =>'修改多图文详情失败，无内容改变'
                );
                return $arr;

            }
        }else{
            $id = input('param.id');
            $row = DB::name('wxReplyContent')->where('id',$id)->find();
            $this->assign('row',$row);
            return $this->fetch();
        }
    }

    //多图片 - 图文详情删除
    public function images_list_del(){
        $post = input('post.');
        $res = Db::name($post['tablename'])->where($post['whereid'],$post['id'])->delete();
        if($res){
            $return = array(
                'status' => 200
            );
            echo json_encode($return);
        }
    }


    //验证用
    public function wx_sample(){
        /*
            用来配置微信 URL
            ob_clean();
            echo input('param.echostr');
        */
        $weObj = new \WechatSdk\wechat($this->options);
        $weObj->valid();
        $this->responseMsg();
    }

    public function responseMsg()
    {
        //get post data, May be due to the different environments
        $postStr = $GLOBALS["HTTP_RAW_POST_DATA"];
        //extract post data
        if (!empty($postStr)){
            $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
            $RX_TYPE = trim($postObj->MsgType);

            switch($RX_TYPE)
            {
                case "text":
                    $resultStr = $this->event_key_news($postObj);
                    break;
                case "event":
                    $resultStr = $this->MsgTypeEvent($postObj);
                    break;
                default:
                    $resultStr = "Unknow msg type: ".$RX_TYPE;
                    break;
            }
            echo $resultStr;
        }else {
            echo "";
            exit;
        }
    }
    /**
     * 事件
     *
     * @param unknown $postObj
     * @return Ambigous <void, string>
     */
    private function MsgTypeEvent($postObj)
    {

        $con = DB::name('wxConfig')->where('id',1)->find();
        $guanzhu = $con['guanzhu'];

        $fromUsername = $postObj->FromUserName;
        $toUsername = $postObj->ToUserName;
        $keyword = trim($postObj->Content);
        $time = time();
        $textTpl = "<xml>
							<ToUserName><![CDATA[%s]]></ToUserName>
							<FromUserName><![CDATA[%s]]></FromUserName>
							<CreateTime>%s</CreateTime>
							<MsgType><![CDATA[%s]]></MsgType>
							<Content><![CDATA[%s]]></Content>
							<FuncFlag>0</FuncFlag>
							</xml>";
        $msgType = "text";
        $contentStr = $guanzhu;
        $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
        echo $resultStr;
    }

    public function event_key_news($postObj)
    {
        //默认回复
        $con = DB::name('wxConfig')->where('id',1)->find();
        $moren = $con['moren'];

        //遍历reply
        $rep = DB::name('wxReply')->where('open',1)->select();

        $fromUsername = $postObj->FromUserName;
        $toUsername = $postObj->ToUserName;
        $keyword = trim($postObj->Content);
        $time = time();

        $keywords_arr = array();
        foreach($rep as $k=>$v){
            //文本回复
            if($v['msgType'] == 'text'){
                if($keyword == $v['keyword']){
                    $textTpl = "<xml>
					<ToUserName><![CDATA[%s]]></ToUserName>
					<FromUserName><![CDATA[%s]]></FromUserName>
					<CreateTime>%s</CreateTime>
					<MsgType><![CDATA[%s]]></MsgType>
					<Content><![CDATA[%s]]></Content>
					<FuncFlag>0</FuncFlag>
					</xml>";
                    $msgType = "text";
                    $contentStr = $v['content'];
                    $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                    echo $resultStr;
                }
            }

            if($v['msgType'] == 'image'){
                if($keyword == $v['keyword']){
                    $one_img = DB::name('wxReplyContent')->where('reply_id',$v['id'])->find();
                    $str = "";
                        $str.="<item>
						<Title><![CDATA[".$one_img['title']."]]></Title> 
						<Description><![CDATA[".$one_img['description']."]]></Description>
						<PicUrl><![CDATA[http://tangyan.hzwzjs.net/".$one_img['picurl']."]]></PicUrl>
						<Url><![CDATA[".$one_img['url']."]]></Url>
						</item>";

                    $textTpl = "<xml>
                    <ToUserName><![CDATA[%s]]></ToUserName>
                    <FromUserName><![CDATA[%s]]></FromUserName>
                    <CreateTime>%s</CreateTime>
                    <MsgType><![CDATA[news]]></MsgType>
                    <ArticleCount>%s</ArticleCount>
                    <Articles>".
                        $str
                    ."</Articles>
                    </xml>";

                    $resultStr2 = sprintf($textTpl, $fromUsername, $toUsername, $time,1);
                    echo $resultStr2;

                }
            }

            if($v['msgType'] == 'images'){
                if($keyword == $v['keyword']){
                    $str = "";
                    $num = 0;
                    $all_img = DB::name('wxReplyContent')->where('reply_id',$v['id'])->select();
                    foreach($all_img as $t){
                        $str.="<item>
						<Title><![CDATA[".$t['title']."]]></Title> 
						<Description><![CDATA[".$t['description']."]]></Description>
						<PicUrl><![CDATA[http://tangyan.hzwzjs.net/".$t['picurl']."]]></PicUrl>
						<Url><![CDATA[".$t['url']."]]></Url>
						</item>";
                        $num++;
                    }

                    $textTpl = "<xml>
			<ToUserName><![CDATA[%s]]></ToUserName>
			<FromUserName><![CDATA[%s]]></FromUserName>
			<CreateTime>%s</CreateTime>
			<MsgType><![CDATA[news]]></MsgType>
			<ArticleCount>%s</ArticleCount>
			<Articles>".
                        $str
                        ."</Articles>
			</xml>";

                    $resultStr2 = sprintf($textTpl, $fromUsername, $toUsername, $time,$num);
                    echo $resultStr2;
                }
            }
            $keywords_arr[$k] = $v['keyword'];
        }

        if(!in_array($keyword,$keywords_arr)) {
            $textTpl = "<xml>
				<ToUserName><![CDATA[%s]]></ToUserName>
				<FromUserName><![CDATA[%s]]></FromUserName>
				<CreateTime>%s</CreateTime>
				<MsgType><![CDATA[%s]]></MsgType>
				<Content><![CDATA[%s]]></Content>
				<FuncFlag>0</FuncFlag>
				</xml>";
            $msgType = "text";
            $contentStr = $moren;
            $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
            echo $resultStr;
        }
    }

}
