<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>我的</title>
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<script src="/public/simpleboot/headmaster/js/rootfont.js"></script>
    <link rel="stylesheet" href="/public/simpleboot/headmaster/css/main.css" />
</head>
<body>
<script>
document.body.style.height=document.documentElement.clientHeight+"px";
</script>
	<div class="list-content">
		<div class="my-info">
			<figure><img src='<?php echo sp_get_user_avatar_url("$avatar");?>' alt=""></figure>
			<h3><?php echo ($master_name); ?></h3>
			<p><?php echo ($user_nicename); ?></p>
		</div>
		<div class="campus-info">
			<ul>
				<li class="clear">
					<dl>校区名称</dl>
					<p><?php echo ($user_nicename); ?></p>
				</li>
				<li class="clear">
					<dl>校区地址</dl>
					<p><?php echo ($user_area); ?></p>
				</li>
				<li class="clear">
					<dl>授权期限</dl>
					<p class="clear"><?php echo ($date_limit); ?>到期</p>
					<!--<p class="clear"><?php echo ($date_limit); ?>到期<span>续费</span></p>-->
				</li>
			</ul>
		</div>
		<div class="my-application">
			<ul>
				<li class="clear" onclick="location='<?php echo leuu('Headmaster/User/user_apply');?>'">
					<h4>我的申请</h4>
					<span><?php echo ($apply_count); ?></span>
					<strong><img src="/public/simpleboot/headmaster/images/arrow.png" alt=""></strong>
				</li>
				<li class="clear" onclick="location='<?php echo leuu('Headmaster/User/complain');?>'">
					<h4>投诉与建议</h4>
					<span><?php echo ($complain_count); ?></span>
					<strong><img src="/public/simpleboot/headmaster/images/arrow.png" alt=""></strong>
				</li>
				<li class="clear" onclick="location='<?php echo leuu('Headmaster/User/password');?>'">
					<h4>修改密码</h4>
					<strong><img src="/public/simpleboot/headmaster/images/arrow.png" alt=""></strong>
				</li>
			</ul>
		</div>
		<div style="" class="my-tc">
			<p onclick="location='<?php echo U('admin/public/logout');?>'">退出登录</p>
		</div>
		<br/>
		<br/>
		<br/>
		<br/>
		<br/>
		<br/>
		<br/>
	</div>
<footer>
    <ul class="clear">
        <li onclick="location='<?php echo leuu('Headmaster/Index/index');?>'">
            <figure>
                <?php if($current == 1): ?><img src="/public/simpleboot/headmaster/images/footer-1-2.png" alt="">
                    <?php else: ?>
                    <img src="/public/simpleboot/headmaster/images/footer-01.png" alt=""><?php endif; ?>
            </figure>
            <p>首页</p>
        </li>
        <li onclick="location='<?php echo leuu('Headmaster/Index/support');?>'">
            <figure>
                <?php if($current == 2): ?><img src="/public/simpleboot/headmaster/images/footer-2-2.png" alt="">
                    <?php else: ?>
                    <img src="/public/simpleboot/headmaster/images/footer-02.png" alt=""><?php endif; ?>
            </figure>
            <p>支持</p>
        </li>
        <li onclick="location='<?php echo leuu('Headmaster/Index/buy');?>'">
            <figure>
                <?php if($current == 3): ?><img src="/public/simpleboot/headmaster/images/footer-3-2.png" alt="">
                    <?php else: ?>
                    <img src="/public/simpleboot/headmaster/images/footer-03.png" alt=""><?php endif; ?>
            </figure>
            <p>商城</p>
        </li>
        <li onclick="location='<?php echo leuu('Headmaster/User/usercenter');?>'" >
            <figure>
                <?php if($current == 4): ?><img src="/public/simpleboot/headmaster/images/footer-4-2.png" alt="">
                    <?php else: ?>
                    <img src="/public/simpleboot/headmaster/images/footer-04.png" alt=""><?php endif; ?>
            </figure>
            <p>我的</p>
        </li>
    </ul>
</footer>
</body>
</html>