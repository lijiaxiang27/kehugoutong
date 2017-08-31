<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>投诉</title>
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<script src="/public/simpleboot/headmaster/js/rootfont.js"></script>
    <link rel="stylesheet" href="/public/simpleboot/headmaster/css/main.css" />
    <link rel="stylesheet" href="/public/simpleboot/headmaster/css/swiper.css" />
    <script src="/public/simpleboot/headmaster/js/jquery-1.10.1.min.js"></script>
</head>
<body>
<script>
document.body.style.height=document.documentElement.clientHeight+"px";
</script>
	<div class="list-content">
		<div class="handling">
			<section>
				您的问题已经接收，我们会为您及时处理，请耐心等待，感谢您的监督！
			</section>
			<p>客户服务部投诉电话：4000915066</p>
			<p>投诉邮箱：complaint@52aotu.com</p>
		</div>
		<div class="handling-list">
			<h3>处理进度</h3>
			<ul>
				<li class="clear">
					<p><img  src="/public/simpleboot/headmaster/images/cljd-01.png" alt=""></p>
					<div class="handling-title">
						<h4>您的问题已经提交成功</h4>
						<span><?php echo (date("Y-m-d",$time)); ?></span>
						<div></div>
					</div>
				</li>
				<li class="clear">
					<p><img class="invisible"  src="/public/simpleboot/headmaster/images/cljd-01.png" alt=""></p>
					<div style="border-left-color: #979797;" class="handling-title">
						<h4>客服服务经理已经收到您的问题<br>您的问题正在处理中</h4>
						<span></span>
						<div style="border:1px solid #979797;background: #D8D8D8;width: 0.1rem;height: 0.1rem;border-radius: 0.05rem;position: absolute;top:-0.05rem;left: -0.05rem;"></div>
					</div>
				</li>
				<li class="clear">
					<p><img class="invisible" src="/public/simpleboot/headmaster/images/cljd-02.png" alt=""></p>
					<div class="handling-title">
						<h4>您的问题已经解决</h4>
						<span></span>
						<div></div>
					</div>
				</li>
				<li class="clear">
					<p><img class="invisible" src="/public/simpleboot/headmaster/images/cljd-03.png" alt=""></p>
					<div class="handling-title">
						<h4>请您对我们的服务做出评价</h4>
						<span></span>
						<div></div>
					</div>
				</li>
			</ul>
		</div>
	</div>
</body>
</html>