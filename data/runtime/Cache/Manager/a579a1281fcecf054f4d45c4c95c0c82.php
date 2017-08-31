<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!--application-management-->
    <title>报名列表</title>
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
<div class="list-content" style="height:100%;">
    <div class="list-om" style="position:relative;height:100%;">
        <?php if(empty($lists)): ?><h3 style="text-align: center;padding-top: 20%">暂时无人报名...</h3><?php endif; ?>
        <?php if(is_array($lists)): $i = 0; $__LIST__ = $lists;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="application-management-list">
            <div class="application-management-left">
                <h3>
                    <span class="application-management-list-name"><?php echo ($vo["master_name"]); ?></span>
                    <span class="application-management-list-tel"><?php echo ($vo["user_login"]); ?></span>
                </h3>
                <p><?php echo ($vo["user_nicename"]); ?></p>
            </div>
                <p class="application-management-right"><?php echo (date("Y/m/d H:i",$vo["time"])); ?></p>
        </div><?php endforeach; endif; else: echo "" ;endif; ?>



    </div>
</div>

</body>
</html>