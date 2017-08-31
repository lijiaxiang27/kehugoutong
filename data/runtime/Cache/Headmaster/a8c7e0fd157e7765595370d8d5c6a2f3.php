<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>投诉与建议</title>
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<script src="/public/simpleboot/headmaster/js/rootfont.js"></script>
    <link rel="stylesheet" href="/public/simpleboot/headmaster/css/main.css" />
</head>
<body>
<script>
document.body.style.height=document.documentElement.clientHeight+"px";
</script>
	<div class="list-content">
		<div class="list-complaint">
			<ul class="clear">
				<li><h3>我的投诉</h3></li>
				<li><span onclick="location='<?php echo U('Complain/index');?>'">我要投诉</span></li>
			</ul>
			<?php if(is_array($complains)): foreach($complains as $key=>$vo): ?><section onclick="location='<?php echo U('Complain/complain_detail', array('id'=>$vo['id']));?>'">
				<hgroup><?php echo ($vo["title"]); ?></hgroup>
				<ul class="clear">
					<li><strong>投诉时间：</strong><p><?php echo (date("Y-m-d H:i:s",$vo["time"])); ?></p></li>
					<li><strong>投诉内容：</strong><p><?php echo ($vo["descript"]); ?></p></li>
				</ul>
				<?php if($vo['status'] == 1 ): ?><span class="clz">处理中</span>
					<?php elseif($vo['status'] == 2 ): ?>
				<span class="clz">待评价</span>
					<?php elseif($vo['status'] == 3): ?>
				<span class="ywc">已完成</span><?php endif; ?>
			</section><?php endforeach; endif; ?>
		</div>
		<div class="list-complaint list-proposal">
			<ul class="clear">
				<li><h3>我的建议</h3></li>
				<li onclick="location='<?php echo U('Adv/index');?>'"><span>提建议</span></li>
			</ul>
			<?php if(is_array($advs)): foreach($advs as $key=>$vo): ?><section onclick="location='<?php echo U('Adv/adv_detail', array('id'=>$vo['id']));?>'">
				<!--<hgroup>河北沧州凹凸学习中心入校支持申请</hgroup>-->
				<ul class="clear">
					<li><strong>提交时间：</strong><p><?php echo (date("Y-m-d H:i:s",$vo["time"])); ?></p></li>
					<li><strong>建议内容：</strong><p><?php echo ($vo["content"]); ?></p></li>
				</ul>
				<?php if($vo['status'] == 1 ): ?><span class="clz">处理中</span>
					<?php elseif($vo['status'] == 2 ): ?>
					<span class="clz">待评价</span>
					<?php elseif($vo['status'] == 3): ?>
					<span class="ywc">已完成</span><?php endif; ?>
			</section><?php endforeach; endif; ?>
		</div>
	</div>
</body>
</html>