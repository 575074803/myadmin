<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:30:"./template/index\newslist.html";i:1516268142;s:28:"./template/index\header.html";i:1516268257;s:28:"./template/index\footer.html";i:1516262626;}*/ ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>顶致新闻列表页</title>
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
            <div class="newslist">
                <div class="pw-top">
                    <h4>新闻资讯</h4>
                    <i class="line"></i>
                    <p>第一时间为为您公布顶尖行业动态</p>
                    <div class="abox">
                        <a href="#javascript:;">最新动态</a>
                        <a href="#javascript:;">行业新闻</a>
                    </div>
                </div>
                <div class="content">
                    <ul class="newscontent">
                        <li>
                            <a href="newsdetails.php" class="clf">
                                <div class="time l">
                                    <p>25</p>
                                    <span>09</span>
                                </div>
                                <div class="txtbox">
                                    <h6>让爱回归-方太柏橱微电影小记</h6>
                                    <p>BORCCI柏厨，是方太集团旗下高端厨柜品牌，本次携手共同打造微电影，旨在让更多人能暂时放下忙碌的工作，让爱回归。BORCCI柏厨，是方太集团旗下高端厨柜品牌本次携手共同打造微电影，旨在让更多人能暂时放下忙碌的工作，让爱回归。</p>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="newsdetails.php" class="clf">
                                <div class="time l">
                                    <p>25</p>
                                    <span>09</span>
                                </div>
                                <div class="txtbox">
                                    <h6>让爱回归-方太柏橱微电影小记</h6>
                                    <p>BORCCI柏厨，是方太集团旗下高端厨柜品牌，本次携手共同打造微电影，旨在让更多人能暂时放下忙碌的工作，让爱回归。BORCCI柏厨，是方太集团旗下高端厨柜品牌本次携手共同打造微电影，旨在让更多人能暂时放下忙碌的工作，让爱回归。</p>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="newsdetails.php" class="clf">
                                <div class="time l">
                                    <p>25</p>
                                    <span>09</span>
                                </div>
                                <div class="txtbox">
                                    <h6>让爱回归-方太柏橱微电影小记</h6>
                                    <p>BORCCI柏厨，是方太集团旗下高端厨柜品牌，本次携手共同打造微电影，旨在让更多人能暂时放下忙碌的工作，让爱回归。BORCCI柏厨，是方太集团旗下高端厨柜品牌本次携手共同打造微电影，旨在让更多人能暂时放下忙碌的工作，让爱回归。</p>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="newsdetails.php" class="clf">
                                <div class="time l">
                                    <p>25</p>
                                    <span>09</span>
                                </div>
                                <div class="txtbox">
                                    <h6>让爱回归-方太柏橱微电影小记</h6>
                                    <p>BORCCI柏厨，是方太集团旗下高端厨柜品牌，本次携手共同打造微电影，旨在让更多人能暂时放下忙碌的工作，让爱回归。BORCCI柏厨，是方太集团旗下高端厨柜品牌本次携手共同打造微电影，旨在让更多人能暂时放下忙碌的工作，让爱回归。</p>
                                </div>
                            </a>
                        </li>
                    </ul>
                    <div class="pw-numnav">
                        <a href="#javascript:;" class="btn">上一页</a>
                        <a href="#javascript:;">1</a>
                        <a href="#javascript:;">2</a>
                        <a href="#javascript:;" class="btn">下一页</a>
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
        <script type="text/javascript">
            $(function(){
                //  导航选中
                //$('#leftmenu ul li').eq(4).addClass('select');

            })
        </script>

    </body>
</html>
