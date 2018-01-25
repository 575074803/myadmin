<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:27:"./template/index\index.html";i:1516267276;s:28:"./template/index\header.html";i:1516268257;s:28:"./template/index\footer.html";i:1516262626;}*/ ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>顶致首页</title>
        <link rel="stylesheet" href="__INDEXCSS__/public.css">
        <link rel="stylesheet" href="__INDEXCSS__/main.css">
    </head>
    <body>
    	
		<div id="leftmenu">
    <a href="<?php echo url('index/index'); ?>" class="leftlogo"><img src="__INDEXIMG__/logo.png" alt=""></a>
    <ul class="txtnavs">
        <li><a href="<?php echo url('index/index'); ?>"><span>首&nbsp;页</span><b>HOME</b></a></li>
        <?php if(is_array($category) || $category instanceof \think\Collection || $category instanceof \think\Paginator): $i = 0; $__LIST__ = $category;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
        <li <?php if($vo['id'] == input('param.catid')): ?>class="select"<?php endif; ?> ><a href="<?php echo getUrl($vo['id'],'lists'); ?>"><span><?php echo $vo['catname']; ?></span><b><?php echo $vo['catname1']; ?></b></a></li>
        <?php endforeach; endif; else: echo "" ;endif; ?>
    </ul>
    <ul class="clf iconsnav">
        <li>
            <a href="#javascript:;">
                <div class="ibox ibox"><i class="i1"></i></div>
                <p>咨询热线</p>
            </a>
        </li>
        <li>
            <a href="#javascript:;">
                <div class="ibox ibox"><i class="i2"></i></div>
                <p>微信</p>
            </a>
        </li>
        <li>
            <a href="#javascript:;">
                <div class="ibox ibox"><i class="i3"></i></div>
                <p>网上商城</p>
            </a>
        </li>
    </ul>

</div>

		
        <div id="rightcontent">
            <video src="__INDEXIMG__/home.mp4" width="100%" height="100%" autoplay loop muted >
                您的浏览器不支持html5 video标签，请选择版本更高的浏览器，以达到最佳观看效果！
            </video>
            <div id="maincontent">
                <div class="publicdiv">
                    <div class="pw-title">
                        <i class="i1"></i>
                        <a href="#javascript:;">More&nbsp;&nbsp;&gt;</a>
                    </div>
                    <ul class="clf">
                        <li>
                            <a href="#javascript:;">
                                <img src="__INDEXIMG__/img.jpg" alt="">
                                <div class="mask">
                                    <p class="title">宣传片</p>
                                    <p class="content">2017表腾品牌发布会</p>
                                    <img src="__INDEXIMG__/video.png" alt="">
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="#javascript:;">
                                <img src="__INDEXIMG__/img.jpg" alt="">
                                <div class="mask">
                                    <p class="title">宣传片</p>
                                    <p class="content">2017表腾品牌发布会</p>
                                    <img src="__INDEXIMG__/video.png" alt="">
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="#javascript:;">
                                <img src="__INDEXIMG__/img.jpg" alt="">
                                <div class="mask">
                                    <p class="title">宣传片</p>
                                    <p class="content">2017表腾品牌发布会</p>
                                    <img src="__INDEXIMG__/video.png" alt="">
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="#javascript:;">
                                <img src="__INDEXIMG__/img.jpg" alt="">
                                <div class="mask">
                                    <p class="title">宣传片</p>
                                    <p class="content">2017表腾品牌发布会</p>
                                    <img src="__INDEXIMG__/video.png" alt="">
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="#javascript:;">
                                <img src="__INDEXIMG__/img.jpg" alt="">
                                <div class="mask">
                                    <p class="title">宣传片</p>
                                    <p class="content">2017表腾品牌发布会</p>
                                    <img src="__INDEXIMG__/video.png" alt="">
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="#javascript:;">
                                <img src="__INDEXIMG__/img.jpg" alt="">
                                <div class="mask">
                                    <p class="title">宣传片</p>
                                    <p class="content">2017表腾品牌发布会</p>
                                    <img src="__INDEXIMG__/video.png" alt="">
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="publicdiv">
                    <div class="pw-title">
                        <i class="i2"></i>
                        <a href="#javascript:;">More&nbsp;&nbsp;&gt;</a>
                    </div>
                    <ul class="clf">
                        <li>
                            <a href="#javascript:;">
                                <img src="__INDEXIMG__/img.jpg" alt="">
                                <div class="mask">
                                    <p class="title">宣传片</p>
                                    <p class="content">2017表腾品牌发布会</p>
                                    <img src="__INDEXIMG__/video.png" alt="">
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="#javascript:;">
                                <img src="__INDEXIMG__/img.jpg" alt="">
                                <div class="mask">
                                    <p class="title">宣传片</p>
                                    <p class="content">2017表腾品牌发布会</p>
                                    <img src="__INDEXIMG__/video.png" alt="">
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="#javascript:;">
                                <img src="__INDEXIMG__/img.jpg" alt="">
                                <div class="mask">
                                    <p class="title">宣传片</p>
                                    <p class="content">2017表腾品牌发布会</p>
                                    <img src="__INDEXIMG__/video.png" alt="">
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="#javascript:;">
                                <img src="__INDEXIMG__/img.jpg" alt="">
                                <div class="mask">
                                    <p class="title">宣传片</p>
                                    <p class="content">2017表腾品牌发布会</p>
                                    <img src="__INDEXIMG__/video.png" alt="">
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="#javascript:;">
                                <img src="__INDEXIMG__/img.jpg" alt="">
                                <div class="mask">
                                    <p class="title">宣传片</p>
                                    <p class="content">2017表腾品牌发布会</p>
                                    <img src="__INDEXIMG__/video.png" alt="">
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="#javascript:;">
                                <img src="__INDEXIMG__/img.jpg" alt="">
                                <div class="mask">
                                    <p class="title">宣传片</p>
                                    <p class="content">2017表腾品牌发布会</p>
                                    <img src="__INDEXIMG__/video.png" alt="">
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="activity">
                    <div class="top clf">
                        <div class="pw-title">
                            <i class="i3"></i>
                        </div>
                        <a href="#javascript:;" class="btn">
                            <img src="__INDEXIMG__/bluevideo.png" alt="">
                        </a>
                        <img src="__INDEXIMG__/img2.jpg" alt="">
                    </div>
                    <ul class="clf">
                        <li>
                            <img src="__INDEXIMG__/img3.jpg" alt="">
                            <div class="mask">
                                <p class="title">荣获2017中国内容营销金瞳奖</p>
                                <p class="content">5月8日，Hand in Hand（合力映像）凭借“金辉煌《匠心比心》”摘得金瞳奖－原创内容单元（微电影组）最佳传播效果铜奖。</p>
                                <a href="#javascript:;" class="btn">了解详情</a>
                            </div>
                        </li>
                        <li>
                            <img src="__INDEXIMG__/img3.jpg" alt="">
                            <div class="mask">
                                <p class="title">荣获2017中国内容营销金瞳奖</p>
                                <p class="content">5月8日，Hand in Hand（合力映像）凭借“金辉煌《匠心比心》”摘得金瞳奖－原创内容单元（微电影组）最佳传播效果铜奖。</p>
                                <a href="#javascript:;" class="btn">了解详情</a>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="news">
                    <div class="title clf">
                        <i></i>
                        <div class="lefttxt">
                            <span>NEWS</span>
                            <p>新闻动态</p>
                        </div>
                        <a href="#javascript:;">More&nbsp;&nbsp;&gt;</a>
                    </div>
                    <div class="picScroll-left">
                        <div class="bd">
                            <ul class="picList">
                                <li>
                                    <a href="#javascript:;">
                                        <div class="time">
                                            <p>25</p>
                                            <span>09</span>
                                        </div>
                                        <div class="box">
                                            <p class="title">让爱回归-方太柏橱微电影小记</p>
                                            <p class="content">BORCCI柏厨，是方太集团旗下高端厨柜品牌，本次携手共同打造微电影，旨在让更多人能暂时放下忙碌的工作，让爱回归。旨在让更多人能暂时放下忙碌的工作。</p>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="#javascript:;">
                                        <div class="time">
                                            <p>25</p>
                                            <span>09</span>
                                        </div>
                                        <div class="box">
                                            <p class="title">让爱回归-方太柏橱微电影小记</p>
                                            <p class="content">BORCCI柏厨，是方太集团旗下高端厨柜品牌，本次携手共同打造微电影，旨在让更多人能暂时放下忙碌的工作，让爱回归。旨在让更多人能暂时放下忙碌的工作。</p>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="#javascript:;">
                                        <div class="time">
                                            <p>25</p>
                                            <span>09</span>
                                        </div>
                                        <div class="box">
                                            <p class="title">让爱回归-方太柏橱微电影小记</p>
                                            <p class="content">BORCCI柏厨，是方太集团旗下高端厨柜品牌，本次携手共同打造微电影，旨在让更多人能暂时放下忙碌的工作，让爱回归。旨在让更多人能暂时放下忙碌的工作。</p>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="#javascript:;">
                                        <div class="time">
                                            <p>25</p>
                                            <span>09</span>
                                        </div>
                                        <div class="box">
                                            <p class="title">让爱回归-方太柏橱微电影小记</p>
                                            <p class="content">BORCCI柏厨，是方太集团旗下高端厨柜品牌，本次携手共同打造微电影，旨在让更多人能暂时放下忙碌的工作，让爱回归。旨在让更多人能暂时放下忙碌的工作。</p>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="hd">
                            <ul></ul>
                        </div>
                    </div>
                </div>
            </div>
            
            <div id="footer" class="clf">
    <a href="#javascript:;" class="footerlogo l">
        <img src="__INDEXIMG__/footerlogo.png" alt="">
    </a>
    <ul class="l clf">
        <li>
            <p>关于我们</p>
            <a href="#javascript:;"><span>关于我们</span></a>
            <a href="#javascript:;"><span>形象展示</span></a>
            <a href="#javascript:;"><span>实例展示</span></a>
            <a href="#javascript:;"><span>SLOG展示</span></a>
        </li>
        <li>
            <p>项目类别</p>
            <a href="#javascript:;"><span>宣传片</span></a>
            <a href="#javascript:;"><span>广告片</span></a>
            <a href="#javascript:;"><span>产品片</span></a>
            <a href="#javascript:;"><span>微电影</span></a>
            <a href="#javascript:;"><span>建筑动画</span></a>
            <a href="#javascript:;"><span>MG动画</span></a>
        </li>
        <li>
            <p>新闻资讯</p>
            <a href="#javascript:;"><span>最新动态</span></a>
            <a href="#javascript:;"><span>行业新闻</span></a>
        </li>
        <li>
            <p>关注微信公众号</p>
            <img src="__INDEXIMG__/footerwx.jpg" alt="">
        </li>
    </ul>
    <div class="content">
        <p class="title">联系我们</p>
        <p>电话：057156976551</p>
        <p>地址：浙江省杭州市拱墅区莫干山路1165号<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;复地北城中心二楼</p>
        <p>网址：<a href="www.hzdiz.com">www.hzdiz.com</a></p>
        <p class="icon">
            <a href="#javascript:;" class="w"></a>
            <a href="#javascript:;" class="p"></a>
            <a href="#javascript:;" class="d"></a>
        </p>
    </div>
</div>
<p class="stro">Copyright © 2017 顶致数字  版权所有 浙ICP备123456789号-1     技术支持：<a href="http://www.shkj.net/">赛虎科技</a></p>
<script src="__INDEXJS__/jquery-1.9.1.min.js" charset="utf-8"></script>
<script src="__INDEXJS__/jquery.SuperSlide.2.1.1.js" charset="utf-8"></script>

            
            
        </div>
        <div class="video-mask">
            <div class="boxs">
                <i class="video-close"></i>
                <iframe height=750 width=100% src='http://player.youku.com/embed/XMzE4NjAyMDM2MA==' frameborder=0 'allowfullscreen'></iframe>
                <div class="newsdetails">
                    <div class="pw"  style="width: 100%">
                        <h4>Star World银饰品牌TVC广告片</h4>
                        <div class="timeshare">
                            <span>宣传片</span>
                            <span>2017-11-14</span>
                            <div class="share l">
                                <span>分享：</span>
                                <div class="jiathis_style r">
                                    <a href="http://www.jiathis.com/share" class="jiathis jiathis_txt jtico jtico_jiathis" target="_blank"></a>
                                </div>
                                <script type="text/javascript" src="http://v3.jiathis.com/code/jia.js" charset="utf-8"></script>
                            </div>
                        </div>
                        <a href="#javascript:;" class="consultation">在线咨询</a>
                        <div class="contents">
                            <img src="__INDEXIMG__/img.jpg" alt="">
                            此视频为Star World品牌TVC广告片，银饰是用银制成的各种各样的装饰品，银为贵金属之一，银白色，银饰采用各种加工工艺，加工成的银饰品种类繁多，基本分为耳饰、颈饰、手饰、足饰和服饰5个大类。新中国成立后，特别是改革开放以来，传统的银饰，走近千家万户，仍然受到许多人的喜爱，特别是某些少数民族地区的银饰，如苗族的银匠业就极为发达。
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script type="text/javascript">
            $(function(){
                //  导航选中
                $('#leftmenu ul li').eq(0).addClass('select');

            })

            window.onresize=function(){
            	location=location;
            }
            if($(window).width() > 1600){
                jQuery(".picScroll-left").slide({titCell:".hd ul",mainCell:".bd ul",autoPage:true,effect:"left",autoPlay:true,vis:3,trigger:"click"});
            }
            if($(window).width() < 1600){
                jQuery(".picScroll-left").slide({titCell:".hd ul",mainCell:".bd ul",autoPage:true,effect:"left",autoPlay:true,vis:2,trigger:"click"});
            }
            if($(window).width() <= 1000){
                jQuery(".picScroll-left").slide({titCell:".hd ul",mainCell:".bd ul",autoPage:true,effect:"left",autoPlay:true,vis:1,trigger:"click"});
            }


            //  视频弹框事件
            $('#maincontent .publicdiv ul li').click(function(){
                $('.video-mask').show();
                $('.video-mask .boxs').show();
            })
            $('.video-mask').click(function(){
                $('.video-mask').hide();
                $('.video-mask .boxs').hide();
            })
            $('.video-mask .boxs').click(function(event){
                event.stopPropagation();
            })
            $('.video-close').click(function(){
                $('.video-mask').hide();
                $('.video-mask .boxs').hide();
            })
        </script>
    </body>
</html>
