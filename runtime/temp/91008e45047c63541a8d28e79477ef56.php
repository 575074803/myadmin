<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:27:"./template/index\video.html";i:1516268134;s:28:"./template/index\header.html";i:1516268257;s:28:"./template/index\footer.html";i:1516262626;}*/ ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>顶致视频</title>
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
            <div id="maincontent">
                <div class="publicdiv z-video">
                    <div class="pw-title">
                        <i class="i1"></i>
                    </div>
                    <form class="selectform" action="" method="post" >
                        <label for="">
                            <select class="" name="">
                                <option value="">视频类型</option>
                                <option value="">企业宣传片</option>
                                <option value="">创意品牌广告</option>
                                <option value="">产品展示</option>
                                <option value="">动画/动漫</option>
                                <option value="">微电影</option>
                                <option value="">mv/花絮</option>
                                <option value="">其他</option>
                            </select>
                        </label>
                        <label for="">
                            <select class="" name="">
                                <option value="">行业类型</option>
                                <option value="">服装鞋包</option>
                                <option value="">数码电器</option>
                                <option value="">美容美体</option>
                                <option value="">珠宝钟表</option>
                                <option value="">母婴儿童</option>
                                <option value="">餐饮食品</option>
                                <option value="">房产家居</option>
                                <option value="">汽车机械</option>
                                <option value="">医疗健康</option>
                                <option value="">文化体育</option>
                                <option value="">教育培训</option>
                                <option value="">旅游酒店</option>
                                <option value="">生活服务</option>
                                <option value="">生产制造</option>
                                <option value="">集团贸易</option>
                                <option value="">信息科技</option>
                                <option value="">电子电工</option>
                                <option value="">能源电力</option>
                                <option value="">物流运输</option>
                                <option value="">农林畜牧</option>
                                <option value="">银行金融</option>
                                <option value="">政府机构</option>
                                <option value="">其他行业</option>
                            </select>
                        </label>
                        <label for="">
                            <select class="" name="">
                                <option value="">合作预算</option>
                                <option value="">5000内</option>
                                <option value="">5000-10000</option>
                                <option value="">1万-3万</option>
                                <option value="">3万-5万</option>
                                <option value="">5万-10万</option>
                                <option value="">10万以上</option>
                            </select>
                        </label>
                        <label for="">
                            <select class="" name="">
                                <option value="">成片时间</option>
                                <option value="">不限</option>
                                <option value="">1min内</option>
                                <option value="">1min-3min</option>
                                <option value="">3min-5min</option>
                                <option value="">5min以上</option>
                            </select>
                        </label>
                    </form>
                    <ul class="clf" style="display: block">
                        <li>
                            <a href="#javascript:;">
                                <img src="__INDEXIMG__/img.jpg" alt="">
                                <div class="mask">
                                    <img src="__INDEXIMG__/video.png" alt="">
                                </div>
                            </a>
                            <div class="b-txtbox">
                                <h6>2017表腾品牌发布会</h6>
                                <p>宣传片</p>
                            </div>
                        </li>
                        <li>
                            <a href="#javascript:;">
                                <img src="__INDEXIMG__/img.jpg" alt="">
                                <div class="mask">
                                    <img src="__INDEXIMG__/video.png" alt="">
                                </div>
                            </a>
                            <div class="b-txtbox">
                                <h6>2017表腾品牌发布会</h6>
                                <p>宣传片</p>
                            </div>
                        </li>
                        <li>
                            <a href="#javascript:;">
                                <img src="__INDEXIMG__/img.jpg" alt="">
                                <div class="mask">
                                    <img src="__INDEXIMG__/video.png" alt="">
                                </div>
                            </a>
                            <div class="b-txtbox">
                                <h6>2017表腾品牌发布会</h6>
                                <p>宣传片</p>
                            </div>
                        </li>
                    </ul>
                    <ul class="clf">
                        <li>
                            <a href="#javascript:;">
                                <img src="__INDEXIMG__/img.jpg" alt="">
                                <div class="mask">
                                    <img src="__INDEXIMG__/video.png" alt="">
                                </div>
                            </a>
                            <div class="b-txtbox">
                                <h6>2017表腾品牌发布会</h6>
                                <p>宣传片</p>
                            </div>
                        </li>
                        <li>
                            <a href="#javascript:;">
                                <img src="__INDEXIMG__/img.jpg" alt="">
                                <div class="mask">
                                    <img src="__INDEXIMG__/video.png" alt="">
                                </div>
                            </a>
                            <div class="b-txtbox">
                                <h6>2017表腾品牌发布会</h6>
                                <p>宣传片</p>
                            </div>
                        </li>
                        <li>
                            <a href="#javascript:;">
                                <img src="__INDEXIMG__/img.jpg" alt="">
                                <div class="mask">
                                    <img src="__INDEXIMG__/video.png" alt="">
                                </div>
                            </a>
                            <div class="b-txtbox">
                                <h6>2017表腾品牌发布会</h6>
                                <p>宣传片</p>
                            </div>
                        </li>
                        <li>
                            <a href="#javascript:;">
                                <img src="__INDEXIMG__/img.jpg" alt="">
                                <div class="mask">
                                    <img src="__INDEXIMG__/video.png" alt="">
                                </div>
                            </a>
                            <div class="b-txtbox">
                                <h6>2017表腾品牌发布会</h6>
                                <p>宣传片</p>
                            </div>
                        </li>
                        <li>
                            <a href="#javascript:;">
                                <img src="__INDEXIMG__/img.jpg" alt="">
                                <div class="mask">
                                    <img src="__INDEXIMG__/video.png" alt="">
                                </div>
                            </a>
                            <div class="b-txtbox">
                                <h6>2017表腾品牌发布会</h6>
                                <p>宣传片</p>
                            </div>
                        </li>
                        <li>
                            <a href="#javascript:;">
                                <img src="__INDEXIMG__/img.jpg" alt="">
                                <div class="mask">
                                    <img src="__INDEXIMG__/video.png" alt="">
                                </div>
                            </a>
                            <div class="b-txtbox">
                                <h6>2017表腾品牌发布会</h6>
                                <p>宣传片</p>
                            </div>
                        </li>
                    </ul>
                    <a href="#javascript:;" class="more z-s-morebtn"><span>加载更多</span></a>
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
                //$('#leftmenu ul li').eq(1).addClass('select');

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

                //  加载更多
                var sourcelength = $('.z-video ul').length;
                if( sourcelength < 2){
                    $('.z-video .z-s-morebtn').hide();
                }else{
                    var i = 1;
                    $('.z-video .z-s-morebtn').click(function(){
                        $('.z-video ul').eq(i).show();
                        i++;
                        if(i >= sourcelength){
                            $('.z-video .z-s-morebtn').hide();
                        }
                    })
                }
            })
        </script>

    </body>
</html>
