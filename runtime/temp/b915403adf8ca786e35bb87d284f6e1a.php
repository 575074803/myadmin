<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:29:"./template/index\aboutus.html";i:1516262626;}*/ ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>顶致关于我们</title>
        <link rel="stylesheet" href="__INDEXCSS__/public.css">
        <link rel="stylesheet" href="__INDEXCSS__/main.css">
    </head>
    <body>
        <?php include 'header.php' ?>
        <div id="rightcontent">
            <video src="__INDEXIMG__/home.mp4" width="100%" height="100%" autoplay loop muted >
                您的浏览器不支持html5 video标签，请选择版本更高的浏览器，以达到最佳观看效果！
            </video>
            <div class="aboutus pw">
                <div class="pw-top">
                    <h4>关于我们</h4>
                    <i class="line"></i>
                    <p>综合型影视服务公司/众多企业的视频营销智囊团</p>
                </div>
                <p class="stros">BORCCI柏厨，是方太集团旗下高端厨柜品牌，本次携手共同打造微电影，旨在让更多人能暂时放下忙碌的工作，让爱回归。旨在让更多人能暂时放下忙碌的工作。BORCCI柏厨，是方太集团旗下高端厨柜品牌，本次携手共同打造微电影，旨在让更多人能暂时放下忙碌的工作，让爱回归。旨在让更多人能暂时放下忙碌的工作。BORCCI柏厨，是方太集团旗下高端厨柜品牌。</p>
                <img src="__INDEXIMG__/mapimg.jpg" alt="" class="mapimg">
                <img src="__INDEXIMG__/img.jpg" alt="">
                <div class="picScroll-left">
                    <div class="bd">
                            <ul>
                                <li>
                                    <img src="__INDEXIMG__/friendimg.jpg" alt="">
                                </li>
                                <li>
                                    <img src="__INDEXIMG__/friendimg.jpg" alt="">
                                </li>
                                <li>
                                    <img src="__INDEXIMG__/friendimg.jpg" alt="">
                                </li>
                                <li>
                                    <img src="__INDEXIMG__/friendimg.jpg" alt="">
                                </li>
                                <li>
                                    <img src="__INDEXIMG__/friendimg.jpg" alt="">
                                </li>
                                <li>
                                    <img src="__INDEXIMG__/friendimg.jpg" alt="">
                                </li>
                                <li>
                                    <img src="__INDEXIMG__/friendimg.jpg" alt="">
                                </li>
                            </ul>
                    </div>
                </div>
            </div>
            <?php include 'footer.php' ?>
        </div>
        <script type="text/javascript">

            $(function(){
                //  导航选中
                $('#leftmenu ul li').eq(5).addClass('select');

            })
            window.onresize=function(){
            	location=location;
            }
            if($(window).width() > 1600){
                jQuery(".picScroll-left").slide({mainCell:".bd ul",autoPage:true,effect:"left",autoPlay:true,vis:6,trigger:"click"});
            }
            if($(window).width() < 1600){
                jQuery(".picScroll-left").slide({mainCell:".bd ul",autoPage:true,effect:"left",autoPlay:true,vis:5,trigger:"click"});
            }
            if($(window).width() <= 1000){
                jQuery(".picScroll-left").slide({mainCell:".bd ul",autoPage:true,effect:"left",autoPlay:true,vis:4,trigger:"click"});
            }

        </script>

    </body>
</html>
