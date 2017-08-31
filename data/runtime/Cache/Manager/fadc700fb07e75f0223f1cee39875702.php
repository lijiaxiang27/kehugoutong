<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>活动列表</title>
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
        <div class="activity-lists-box">
            <?php if(is_array($acts)): $i = 0; $__LIST__ = $acts;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="activity-list-preview" onclick="location='<?php echo leuu('Active/act_manage_detail',array('id'=>$vo['id']));?>'">
                 <h3><?php echo ($vo["title"]); ?></h3>
                 <span class="activity-list-time">时间：<?php echo (date("m月d日",strtotime($vo["starttime"]))); ?>—<?php echo (date("m月d日",strtotime($vo["endtime"]))); ?></span>
                 <span class="activity-list-address">地点：<?php echo ($vo["area"]); ?></span>
                 <p>
                     <span class="enrollment"><?php echo ($vo["count"]); ?></span>/<span><?php if($vo['num'] == 0): ?>不限人数<?php else: echo ($vo["num"]); endif; ?></span>
                     <span class="activity-state"><?php if($vo['status'] == 0 ): ?>报名结束<?php elseif($vo['status'] == 1 ): ?>已报满<?php else: ?>报名中<?php endif; ?></span>
                 </p>
             </div><?php endforeach; endif; else: echo "" ;endif; ?>

        </div>

    </div>
</div>
<script>
    var spans = document.getElementsByClassName('activity-state');
    for(var i = 0,len = spans.length;i < len;i++){
        if(spans[i].innerHTML == "报名中"){
            spans[i].style.color = "rgb(0,196,109)"
        }
        if(spans[i].innerHTML == "报名结束"){
            spans[i].style.color = "rgb(248,180,44)"
        }
        if(spans[i].innerHTML == "已报满"){
            spans[i].style.color = "rgb(248,180,44)"
        }
    }
</script>
</body>
</html>