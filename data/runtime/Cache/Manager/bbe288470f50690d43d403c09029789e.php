<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>活动管理页面</title>
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <script src="/public/simpleboot/headmaster/js/rootfont.js"></script>
<script src="/public/simpleboot/headmaster/js/clipboard.min.js"></script>
<script src="/public/simpleboot/headmaster/js/jquery-1.10.1.min.js"></script>
<link rel="stylesheet" href="/public/simpleboot/headmaster/css/main.css" />
<link rel="stylesheet" href="/public/simpleboot/headmaster/css/manager.css">
<link rel="stylesheet" href="/public/simpleboot/manager/css/manager-v2.0.css">

</head>
<body>
<script>
    document.body.style.height=document.documentElement.clientHeight+"px";
</script>
<div class="list-content">
    <div class="list-om">
        <div class="activity-management">
            <ul>
                <li class="activity-management-list activity-management-list-left">
                    <a href="<?php echo leuu('active/act_add');?>">
                        <img src="/public/simpleboot/manager/images/add-list.png" alt="">
                        <p>新增活动</p>
                    </a>
                </li>
                <li class="activity-management-list">
                    <a href="<?php echo leuu('active/act_lists');?>">
                        <img src="/public/simpleboot/manager/images/config.png" alt="">
                        <p>活动管理</p>
                    </a>
                </li>
            </ul>
        </div>
        <div class="stop-floor"></div>
        <div class="newest-activity-bg">
             <h3>最新活动</h3>
            <?php if(is_array($acts)): $i = 0; $__LIST__ = $acts;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="newest-activity-box">
                 <img src='<?php echo sp_get_image_url($vo["image"]);?>' alt="">
                 <div class="newest-activity-right">
                     <p class="newest-activity-title"><?php echo ($vo["title"]); ?></p>
                     <p class="newest-activity-time">时间：<span><?php echo (date("m月d日",strtotime($vo["starttime"]))); ?>—<?php echo (date("m月d日",strtotime($vo["endtime"]))); ?></span></p>
                     <p class="newest-activity-address">地点：<span><?php echo ($vo["area"]); ?></span></p>
                     <a href="<?php echo leuu('active/act_manage',array('id'=>$vo['id']));?>">管理活动</a>
                 </div>
             </div><?php endforeach; endif; else: echo "" ;endif; ?>

        </div>


        <footer>
    <ul class="footer-nav">
        <li>
            <a href="<?php echo leuu('index/index');?>">
                <img src="/public/simpleboot/manager/images/clock.png" alt="">
                <p>申请处理</p>
            </a>
        </li>
        <li>
            <a href="<?php echo leuu('Active/index');?>">
                <img src="/public/simpleboot/manager/images/activity-manager.png" alt="">
                <p>活动管理</p>
            </a>
        </li>
        <li>
            <a href="">
                <img src="/public/simpleboot/manager/images/data.png" alt="">
                <p>资料更新</p>
            </a>
        </li>
        <li>
            <a href="<?php echo leuu('School/index');?>">
                <img src="/public/simpleboot/manager/images/school.png" alt="">
                <p>校区管理</p>
            </a>
        </li>
        <li>
            <a href="<?php echo leuu('User/index');?>">
                <img src="/public/simpleboot/manager/images/user-center1.png" alt="">
                <p>个人中心</p>
            </a>
        </li>
    </ul>
</footer>

    </div>
</div>
<script>
    /*js保证最新活动下边图片的比例,有小BUG，重绘闪烁*/
    var imgs = $('.newest-activity-box>img');
    for(var i = 0, len = imgs.length; i < len;i++){
        imgs[i].height = imgs[i].clientWidth * 0.75;
    }

    var btns = $('.newest-activity-bg a');

    for(var i = 0,len = btns.length;i < len;i++){
        console.log(i);
        if(btns[i].innerHTML == "管理活动"){
            btns[i].style.backgroundColor = "rgb(0,196,109)";
            btns[i].style.color = "white";
            btns[i].style.border = '1px solid rgb(0,196,109)'
        }
        if(btns[i].innerHTML == "查看详情"){
            btns[i].style.backgroundColor = "#eee";
            btns[i].style.color = "#666";
            btns[i].style.border = '1px solid #ccc'
        }
    }
</script>
</body>
</html>