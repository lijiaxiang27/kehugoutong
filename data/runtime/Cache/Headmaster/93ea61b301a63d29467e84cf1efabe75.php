<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?php echo ($term); ?></title>
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<script src="/public/simpleboot/headmaster/js/rootfont.js"></script>
    <link rel="stylesheet" href="/public/simpleboot/headmaster/css/main.css" />
</head>
<body>
<script>
document.body.style.height=document.documentElement.clientHeight+"px";
</script>
	<div class="aotu-life">
		<div class="life-nav">
			<ul class="clear">
				<li><a onclick="location='<?php echo U('index/index');?>'" href="javascript:void(0)">首页</a></li>
				<li>&gt;</li>
				<li><a href="javascript:void(0)"><?php echo ($term); ?></a></li>
			</ul>
		</div>
		<div class="life-content">
			<h2><?php echo ($atlive["post_title"]); ?><br><span>发布时间：<?php echo ($atlive["post_date"]); ?></span></h2>
			<p>
				<?php echo ($atlive["post_content"]); ?>
			</p>
		</div>
	</div>
</body>
</html>