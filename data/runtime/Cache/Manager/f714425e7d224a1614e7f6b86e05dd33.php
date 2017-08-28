<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!--campus_management-->
    <title>校区管理</title>
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <script src="/public/simpleboot/headmaster/js/rootfont.js"></script>
<script src="/public/simpleboot/headmaster/js/clipboard.min.js"></script>
<script src="/public/simpleboot/headmaster/js/jquery-1.10.1.min.js"></script>
<link rel="stylesheet" href="/public/simpleboot/headmaster/css/main.css" />
<link rel="stylesheet" href="/public/simpleboot/headmaster/css/manager.css">
<link rel="stylesheet" href="/public/simpleboot/manager/css/manager-v2.0.css">
    <link rel="stylesheet" href="/public/simpleboot/manager/css/campus.css">
</head>
<body>
<script>
    document.body.style.height=document.documentElement.clientHeight+"px";
</script>
<div class="list-content" style="height:100%;">
    <div class="list-om" style="position:relative;height:100%;">
        <div class="add-new-campus" onclick="location='<?php echo leuu('school/add_school');?>'">
            <a href="#"><img src="/public/simpleboot/manager/images/add-list.png" alt=""></a><span>新增校区</span>
        </div>
        <div class="area-div"></div>
        <div class="campus-lists-box">
            <?php if(is_array($schools)): $i = 0; $__LIST__ = $schools;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="campus-list">
                  <h3><?php echo ($vo["user_nicename"]); ?></h3>
                  <p><span><?php echo ($vo["master_name"]); ?></span>&nbsp; |&nbsp; <span><?php echo ($vo["user_login"]); ?></span></p>
             </div><?php endforeach; endif; else: echo "" ;endif; ?>
        </div>
    </div>
</div>

</body>
</html>