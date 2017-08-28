<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>凹凸支持服务平台</title>
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
	<div class="banner">
		<div class="swiper-container"style="width: 100%;">  
		    <div class="swiper-wrapper">
                <?php $slides=sp_getslide('banner'); ?>
                <?php if(is_array($slides)): foreach($slides as $key=>$vo): ?><div class="swiper-slide"><img src="<?php echo sp_get_asset_upload_path($vo['slide_pic']);?>"></div><?php endforeach; endif; ?>
		    </div>  
		    <div class="swiper-pagination"></div>
		</div>  
	</div>
	<div class="at-list">
		<h3>资料下载</h3>
		<ul class="clear">
			<li onclick="location='<?php echo leuu('Headmaster/Down/yy_data');?>'">
				<figure><img src="/public/simpleboot/headmaster/images/zlxz-01.png" alt=""></figure>
				<p>运营资料</p>
			</li>
			<li onclick="location='<?php echo leuu('Headmaster/Down/sc_data');?>'">
				<figure><img src="/public/simpleboot/headmaster/images/zlxz-02.png" alt=""></figure>
				<p>市场方案</p>
			</li>
			<li onclick="location='<?php echo leuu('Headmaster/Down/px_data');?>'">
				<figure><img src="/public/simpleboot/headmaster/images/zlxz-03.png" alt=""></figure>
				<p>培训资料</p>
			</li>
			<li onclick="location='<?php echo leuu('Headmaster/Down/qt_data');?>'">
				<figure><img src="/public/simpleboot/headmaster/images/zlxz-04.png" alt=""></figure>
				<p>其他资料</p>
			</li>
		</ul>
	</div>
	<div class="at-list">
		<h3>运营服务</h3>
		<ul class="clear">
			<li onclick="location='<?php echo leuu('Headmaster/Service/support');?>'">
				<figure><img src="/public/simpleboot/headmaster/images/yyfw-01.png" alt=""></figure>
				<p>入校支持</p>
			</li>
			<li onclick="location='<?php echo leuu('Headmaster/Service/home');?>'">
				<figure><img src="/public/simpleboot/headmaster/images/yyfw-02.png" alt=""></figure>
				<p>家庭教育</p>
			</li>
			<li onclick="location='<?php echo leuu('Headmaster/Service/design');?>'">
				<figure><img src="/public/simpleboot/headmaster/images/yyfw-03.png" alt=""></figure>
				<p>设计申请</p>
			</li>
			<li onclick="location='<?php echo leuu('Headmaster/Service/other_apply');?>'">
				<figure><img src="/public/simpleboot/headmaster/images/yyfw-04.png" alt=""></figure>
				<p>其他申请</p>
			</li>
		</ul>
	</div>
	<div class="at-list">
		<h3>产品服务</h3>
		<ul class="clear">
			<li onclick="location='https://h5.youzan.com/v2/tag/k0wpb8hb'">
				<figure><img src="/public/simpleboot/headmaster/images/cpfw-01.png" alt=""></figure>
				<p>市场推广</p>
			</li>
			<li onclick="location='https://h5.youzan.com/v2/goods/2fnygzuutnq81?showsku=true'">
				<figure><img src="/public/simpleboot/headmaster/images/cpfw-02.png" alt=""></figure>
				<p>AotuPad</p>
			</li>
			<li onclick="location='https://h5.youzan.com/v2/tag/6bb5a4ot'">
				<figure><img src="/public/simpleboot/headmaster/images/cpfw-03.png" alt=""></figure>
				<p>标准化软装</p>
			</li>
			<li onclick="location='https://h5.youzan.com/v2/tag/18btab1eg'">
				<figure><img src="/public/simpleboot/headmaster/images/cpfw-04.png" alt=""></figure>
				<p>图书道具</p>
			</li>
		</ul>
	</div>
	<div class="at-yyjl">
		<ul class="clear">
			<li onclick="location='<?php echo leuu('Headmaster/User/managers');?>'" >
				<p>运营经理</p>
				<img src="/public/simpleboot/headmaster/images/yyjl.png" alt="">
			</li>
			<li onclick="location='https://h5.youzan.com/v2/showcase/homepage?alias=39kq57ce'">
				<p>运营服务费</p>
				<img src="/public/simpleboot/headmaster/images/yyfw.png" alt="">
			</li>
			<li onclick="location='<?php echo leuu('Headmaster/User/complain');?>'" >
				<p>投诉建议</p>
				<img src="/public/simpleboot/headmaster/images/tsjy.png" alt="">
			</li>
		</ul>
	</div>
	<div class="at-zxhd">
		<h3>最新活动</h3>
		<ul>
			<?php if(is_array($acts)): foreach($acts as $key=>$vo): ?><li  onclick="location='<?php echo U('Act/detail',array('id'=>$vo['id']));?>'" class="clear">
				<div class="zxhd-img"><img src="<?php echo sp_get_asset_upload_path($vo['image']);?>" alt=""></div>
				<div class="zxhd-cont">
					<h4><?php echo ($vo["title"]); ?></h4>
					<p>时间：<?php echo ($vo["starttime"]); ?>~<?php echo ($vo["endtime"]); ?></p>
					<p>地点：<?php echo ($vo["area"]); ?></p>
					<?php if($vo['isover'] == 0 ): if($vo['isbm'] == 0 ): ?><span>申请参加</span>
								<?php else: ?>
							<span style="background-color: #7b8a8b">您已报名</span><?php endif; ?>
						<?php elseif($vo['isfull'] == 1): ?>
							<span style="background-color: #7b8a8b">人数已满</span>
						<?php else: ?>
							<span style="background-color: #7b8a8b">活动结束</span><?php endif; ?>
				</div>
			</li><?php endforeach; endif; ?>
		</ul>
	</div>
	<div class="atsh">
		<h3>凹凸生活</h3>
		<?php if(is_array($reports)): foreach($reports as $key=>$vo): $smeta=json_decode($vo['smeta'], true); ?>
		<div onclick="location='<?php echo U('Atlive/index',array('id'=>$vo['id']));?>'">
			<div class="atsh-img"><img src="<?php echo sp_get_asset_upload_path($smeta['thumb']);?>" alt=""></div>
			<h4><?php echo ($vo["post_title"]); ?></h4>
			<p>
				<?php echo ($vo["post_excerpt"]); ?>
			</p>
		</div><?php endforeach; endif; ?>
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


<script src="/public/simpleboot/headmaster/js/swiper.js"></script>
<script type="text/javascript">  
    var mySwiper = new Swiper(".swiper-container",{  
        direction:"horizontal",/*横向滑动*/  
        loop:true,/*形成环路（即：可以从最后一张图跳转到第一张图*/  
        pagination:".swiper-pagination",/*分页器*/  
        prevButton:".swiper-button-prev",/*前进按钮*/  
        nextButton:".swiper-button-next",/*后退按钮*/  
        autoplay:5000/*每隔3秒自动播放*/  
    });
	function baoming(id) {
		$.ajax({
			url: "<?php echo U('headmaster/act/attend');?>",
			type: 'post',
			dataType:'html',
			data: {"id":id},
			success: function(msg) {
				var msgs = eval('(' + msg + ')');
				alert(msgs.info);
			}
		});
	}
</script>
</body>
</html>