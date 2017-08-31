<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>投诉与建议</title>
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <script src="/public/simpleboot/headmaster/js/rootfont.js"></script>
<script src="/public/simpleboot/headmaster/js/clipboard.min.js"></script>
<script src="/public/simpleboot/headmaster/js/jquery-1.10.1.min.js"></script>
<link rel="stylesheet" href="/public/simpleboot/headmaster/css/main.css" />
<link rel="stylesheet" href="/public/simpleboot/headmaster/css/manager.css">
<link rel="stylesheet" href="/public/simpleboot/manager/css/manager-v2.0.css">
    <style>
        .c_and_s_box ul .c_and_s{
            padding:0.5rem;
            float:left;
            width:49.5%;
        }
        .c_and_s_box ul{
            padding:0.5rem 0;
        }
        .c_and_s_box ul .c_and_s a{
            color:black;
            display:block;
            position:relative;

        }
        .c_and_s_box ul .c_and_s > a > img {
            width:0.7rem;
        }
        .activity-management-list-left{
            border-right:1px solid #ddd;
        }
        .c_and_s_box ul .c_and_s > a > p {
            margin-top:0.2rem;
            font-size:0.32rem;
        }
        .c_and_s_box ul:after{
            content:'';
            height:0;
            display:block;
            clear: both;
            visibility: hidden;
        }
        .c_and_s_box ul .c_and_s > a > span{
            display:inline-block;
            width:0.55rem;
            height:0.4rem;
            line-height: 0.4rem;
            border-radius:0.2rem;
            background: red;
            color:white;
            position:absolute;
            top:-0.1rem;
            right:0.5rem;
        }
        .area-div{
            height: 0.24rem;
            background: #f3f3f3;
            border-top: 1px solid #ddd;
            border-bottom: 1px solid #ddd;
        }
        .c_and_s_lists{
            background:white;
            padding:0.2rem 0.5rem;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        .c_and_s_list{
            padding:0.3rem 0.05rem;
            border-bottom: 1px solid #ddd;

        }
        .c_and_s_list:nth-last-child(1){
            border-bottom:none;
        }
        .c_and_s_list h3{
            text-align:left;
            font-weight:400;
            vertical-align: middle;
            line-height: 0.32rem;
            margin-bottom:0.2rem;
        }
        .c_and_s_list h3 img{
            width:0.30rem;
            vertical-align:top;
            margin-right:0.2rem;

        }
        .c_and_s_list p > span:nth-child(1){
            color:#666;
            vertical-align: top;
            display:inline-block;
            width:1.2rem;
        }
        .c_and_s_list p > span:nth-child(2){
            color:#666;
            display:inline-block;
            width:5rem;
        }
    </style>
</head>
<body>
<script>
    document.body.style.height=document.documentElement.clientHeight+"px";
</script>
<div class="list-content">
    <div class="list-om">
        <!--类名简写：c_and_s = complaints_and_suggestions-->
        <div class="c_and_s_box">
            <ul>
                <li class="c_and_s activity-management-list-left">
                    <a href="<?php echo leuu('Manager/Complain/index',array('status'=>1));?>">
                        <img src="/public/simpleboot/manager/images/wait_application.png" alt="">
                        <p>待处理</p>
                        <?php if($num == 0 ): elseif($num > 0): ?><span><?php echo ($num); ?></span><?php endif; ?>
                    </a>
                </li>
                <li class="c_and_s">
                    <a href="<?php echo leuu('Manager/Complain/index',array('status'=>2));?>">
                        <img src="/public/simpleboot/manager/images/success.png" alt="">
                        <p>已完成</p>
                    </a>
                </li>
            </ul>
        </div>
        <div class="area-div"></div>
        <div class="c_and_s_lists">
            <?php if(is_array($arr)): $i = 0; $__LIST__ = $arr;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="c_and_s_list" onclick="location='<?php echo leuu('Manager/Complain/detail',array('id'=>$vo['id']));?>'">
               <?php $length = count($vo);if($length>8)$type='投诉';else $type='建议'; ?>
               <h3>
                   <?php if($length > 8): ?><img class="c_and_s_img" src="/public/simpleboot/manager/images/su.png" alt=""><?php echo (sp_get_school_name($vo["userid"])); echo ($type); ?>
                       <?php else: ?>
                       <img class="c_and_s_img" src="/public/simpleboot/manager/images/su.png" alt=""><?php echo (sp_get_school_name($vo["userid"])); echo ($type); endif; ?>
               </h3>
               <p>
                   <span class="c_and_s_time"><?php echo ($type); ?>时间:</span>
                   <span><?php echo (date("Y-m-d H:i:s",$time)); ?></span>
               </p>
               <p>
                   <span><?php echo ($type); ?>人:</span>
                   <span><?php echo (sp_get_master_name($vo["userid"])); ?></span>
               </p>
               <p>
                   <span><?php echo ($type); ?>内容:</span>
                   <span><?php echo ($vo["content"]); echo ($vo["descript"]); ?></span>
               </p>
               <p>
                   <span></span>
                   <span class="c_and_s_color">
                       <?php if($vo['status'] <= 1 ): ?>待处理
                            <?php elseif($vo['status'] == 2 ): ?>
                        待评价
                            <?php elseif($vo['status'] == 3): ?>
                        已完成<?php endif; ?>
                   </span>
               </p>
            </div><?php endforeach; endif; else: echo "" ;endif; ?>

        </div>
    </div>
</div>
<script>

    var lists = $('.c_and_s_list');
    var spans = $('.c_and_s_time');
    var imgs = $('.c_and_s_img');
    var colors = $('.c_and_s_color');
//根据建议时间or投诉时间 判断列表类型改变样式和图片路径
    $.each(spans,function(i,n){
        n.innerHTML == '建议时间:' ? imgs.eq(i).attr('src',"/public/simpleboot/manager/images/su2.png") : false;
        if(colors.eq(i).html() == '待处理'){
            colors.eq(i).css('color','rgb(0,186,109)');
        } else if(colors.eq(i).html() == '待评价'){
            colors.eq(i).css('color','rgb(0,186,109)');
        } else {
            colors.eq(i).css('color','rgb(245,166,35)');
        }


    })
</script>
</body>
</html>