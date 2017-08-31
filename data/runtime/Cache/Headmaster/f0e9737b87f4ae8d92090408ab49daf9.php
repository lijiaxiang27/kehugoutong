<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>我的申请</title>
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<script src="/public/simpleboot/headmaster/js/rootfont.js"></script>
    <link rel="stylesheet" href="/public/simpleboot/headmaster/css/main.css" />
</head>
<body>
<script>
document.body.style.height=document.documentElement.clientHeight+"px";
</script>
	<div class="list-content">
		<div class="list-application">
			<h3>我的申请</h3>
			<ul class="clear">
				<li onclick="location='<?php echo U('Headmaster/User/user_apply',array('st'=>1));?>'" >
					<div class="app-title">
						<img src="/public/simpleboot/headmaster/images/application.png" alt="">
						<span><?php echo ($count["sq"]); ?></span>
					</div>
					<span>申请</span>
				</li>
				<li  onclick="location='<?php echo U('Headmaster/User/user_apply',array('st'=>2));?>'" >
					<div class="app-title">
						<img src="/public/simpleboot/headmaster/images/evaluate.png" alt="">
						<span><?php echo ($count["pj"]); ?></span>
					</div>
					<span>待评价</span>
				</li>
				<li  onclick="location='<?php echo U('Headmaster/User/user_apply',array('st'=>3));?>'" >
					<div class="app-title">
						<img src="/public/simpleboot/headmaster/images/finish.png" alt="">
						<span><?php echo ($count["wc"]); ?></span>
					</div>
					<span>完成</span>
				</li>
			</ul>
		</div>
		<div class="application-list">
			<!--入校支持-->
			<?php if(is_array($supports)): foreach($supports as $key=>$vo): ?><div class="cont clear" onclick="location='<?php echo U('Headmaster/User/apply_detail',array('db'=>'support','id'=>$vo['id']));?>'">

				<h4><?php echo ($vo["title"]); ?></h4>
				<div class="cation clear">
					<span>支持时间：</span><p><?php echo ($vo["start"]); ?>至<?php echo ($vo["end"]); ?></p>
					<span>支持事由：</span><p><?php echo ($vo["content"]); ?></p>
					<span>申请时间：</span><p><?php echo (date("Y-m-d",$vo["time"])); ?></p>
				</div>

				<ul>
					<li>
						<?php if($vo['status'] <= '1' ): ?>审批中
							<?php elseif($vo['status'] == '2'): ?>
							审批通过
							<?php elseif($vo['status'] == '3'): ?>
							完成<?php endif; ?>
					</li>
				</ul>
				<?php if($vo['status'] == '2'): ?><div class="pj">
					<p>待评价</p>
				</div>
					<?php elseif($vo['status'] == '3'): ?>
				<div class="pj ypj">
					<p>已评价</p>
				</div><?php endif; ?>
			</div><?php endforeach; endif; ?>
			<!--家庭教育-->
			<?php if(is_array($lectures)): foreach($lectures as $key=>$vo): ?><div class="cont clear" onclick="location='<?php echo U('Headmaster/User/apply_detail',array('db'=>'lecture','id'=>$vo['id']));?>'">

					<h4><?php echo ($vo["title"]); ?></h4>
					<div class="cation clear">
						<span>支持时间：</span><p><?php echo ($vo["start"]); ?></p>
						<span>支持人数：</span><p><?php echo ($vo["title"]); ?></p>
						<span>申请时间：</span><p><?php echo (date("Y-m-d",$vo["time"])); ?></p>
					</div>

					<ul>
						<li>
							<?php if($vo['status'] <= '1' ): ?>审批中
								<?php elseif($vo['status'] == '2'): ?>
								审批通过
								<?php elseif($vo['status'] == '3'): ?>
								完成<?php endif; ?>
						</li>
					</ul>
					<?php if($vo['status'] == '2'): ?><div class="pj">
							<p>待评价</p>
						</div>
						<?php elseif($vo['status'] == '3'): ?>
						<div class="pj ypj">
							<p>已评价</p>
						</div><?php endif; ?>
				</div><?php endforeach; endif; ?>
			<!--设计申请-->
			<?php if(is_array($designs)): foreach($designs as $key=>$vo): ?><div class="cont clear" onclick="location='<?php echo U('Headmaster/User/apply_detail',array('db'=>'design','id'=>$vo['id']));?>'">

					<h4><?php echo ($vo["title"]); ?></h4>
					<div class="cation clear">
						<span>设计内容：</span><p><?php echo ($vo["content"]); ?></p>
						<span>申请时间：</span><p><?php echo (date("Y-m-d",$vo["time"])); ?></p>
					</div>

					<ul>
						<li>
							<?php if($vo['status'] <= '1' ): ?>审批中
								<?php elseif($vo['status'] == '2'): ?>
								审批通过
								<?php elseif($vo['status'] == '3'): ?>
								完成<?php endif; ?>
						</li>
					</ul>
					<?php if($vo['status'] == '2'): ?><div class="pj">
							<p>待评价</p>
						</div>
						<?php elseif($vo['status'] == '3'): ?>
						<div class="pj ypj">
							<p>已评价</p>
						</div><?php endif; ?>
				</div><?php endforeach; endif; ?>
			<!--其他申请-->
			<?php if(is_array($otherapps)): foreach($otherapps as $key=>$vo): ?><div class="cont clear" onclick="location='<?php echo U('Headmaster/User/apply_detail',array('db'=>'other_app','id'=>$vo['id']));?>'">

					<h4>其它申请</h4>
					<div class="cation clear">
						<span>支持时间：</span><p><?php echo ($vo["starttime"]); ?>至<?php echo ($vo["endtime"]); ?></p>
						<span>支持事由：</span><p><?php echo ($vo["content"]); ?></p>
						<span>申请时间：</span><p><?php echo (date("Y-m-d",$vo["time"])); ?></p>
					</div>

					<ul>
						<li>
							<?php if($vo['status'] <= '1' ): ?>审批中
								<?php elseif($vo['status'] == '2'): ?>
								审批通过
								<?php elseif($vo['status'] == '3'): ?>
								完成<?php endif; ?>
						</li>
					</ul>
					<?php if($vo['status'] == '2'): ?><div class="pj">
							<p>待评价</p>
						</div>
						<?php elseif($vo['status'] == '3'): ?>
						<div class="pj ypj">
							<p>已评价</p>
						</div><?php endif; ?>
				</div><?php endforeach; endif; ?>

		</div>
	</div>	
</body>
</html>