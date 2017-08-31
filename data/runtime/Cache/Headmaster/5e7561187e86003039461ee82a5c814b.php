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
	<!--五星评论的css-->
	<link rel="stylesheet" href="/public/simpleboot/headmaster/css/star-rating-svg.css">
	<style>
		.my-rating-left{
			float:left;
			font-size:0.3rem;
			color:#888;
		}
		.my-rating{
			float:left;
		}
		.my-rating-box{
			margin-top:0.4rem;
		}
		.my-rating-box:after{
			display:block;
			content:'';
			visibility: hidden;
			height: 0;
			clear: both;
		}
		.my-rating-box textarea{
			float:left;
			resize: none;
			border: 1px solid gray;
			margin-left:0.6rem;
			width:4.5rem;
		}
		.c_m_r_header{
			text-align: left;
			padding:0.4rem;
		}
		.c_m_r_header h3{
			padding-bottom: 0.3rem;
			border-bottom:1px solid #ddd;
		}
		.c_m_r_header p{
			margin-top:0.2rem;
		}
		.c_m_r_header > p > span:nth-child(1){  display:inline-block;  width:2rem;  }
		.my-rating{  margin-left:0.6rem;  }
		.c_m_r_block{
			height:0.2rem;
			border-top:1px solid rgb(230,230,230);
			border-bottom:1px solid rgb(230,230,230);
			background: rgb(245,245,245);
		}
		.c_m_r_text{  padding:0.4rem;  }
		.c_m_r_text h3{
			text-align: left;
			border-bottom:1px solid #ddd;
			font-size: 0.3rem;
			padding-bottom:0.3rem;
		}
		.c_m_r_text > h4{
			font-size: 0.3rem;
			font-weight: 400;
			padding-top:0.2rem;
			padding-bottom:0.2rem;
		}
		.open-rating-btn{
			display: block;
			width: 30%;
			text-align: center;
			border-radius: 0.1rem;
			margin: 0 auto;
			padding: 0.24rem 0;
			font-size: 0.3rem;
			color: white;
			margin-top: 0.3rem;
			background: rgb(23,176,90);
		}
	</style>
</head>
<body>
<script>
document.body.style.height=document.documentElement.clientHeight+"px";
</script>
	<div class="list-content">

		<div class="details">
			<h3>申请详情</h3>
			<ul>
				<?php if(!empty($title)): ?><li class="clear"><span>申请标题：</span><p><?php echo ($title); ?></p></li><?php endif; ?>
				<?php if(!empty($province)): ?><li class="clear"><span>地址：</span><p><?php echo ($province); ?>-<?php echo ($city); ?>-<?php echo ($county); ?></p></li><?php endif; ?>
				<?php if(!empty($end)): ?><li class="clear"><span>起始时间：</span><p><?php echo ($start); ?>~<?php echo ($end); ?></p></li><?php endif; ?>
				<?php if(!empty($person)): ?><li class="clear"><span>申请人：</span><p><?php echo ($person); ?></p></li><?php endif; ?>
				<?php if(!empty($mobile)): ?><li class="clear"><span>联系电话：</span><p><?php echo ($mobile); ?></p></li><?php endif; ?>
				<?php if(!empty($continue)): ?><li class="clear"><span>支持天数：</span><p><?php echo ($continue); ?></p></li><?php endif; ?>
				<?php if(!empty($num)): ?><li class="clear"><span>参会人数：</span><p><?php echo ($num); ?></p></li><?php endif; ?>
				<?php if(!empty($content)): ?><li class="clear"><span>支持详情：</span><p><?php echo ($content); ?></p></li><?php endif; ?>
				<?php if(!empty($demand)): ?><li class="clear"><span>设计要求：</span><p><?php echo ($demand); ?></p></li><?php endif; ?>
				<?php if(!empty($is_send)): ?><li class="clear"><span>是否发送附件：</span><p><?php if($is_send == 1): ?>已发送<?php else: ?>未发送<?php endif; ?></p></li><?php endif; ?>
				<?php if(!empty($time)): ?><li class="clear"><span>申请时间：</span><p><?php echo (date("Y-m-d",$time)); ?></p></li><?php endif; ?>
				<?php if(!empty($passtime)): ?><li class="clear"><span>审批时间：</span><p><?php echo (date("Y-m-d",$passtime)); ?></p></li><?php endif; ?>
				<?php if(!empty($solvetime)): ?><li class="clear"><span>解决时间：</span><p><?php echo (date("Y-m-d",$solvetime)); ?></p></li><?php endif; ?>
				<?php if(!empty($judge_time)): ?><li class="clear"><span>评价时间：</span><p><?php echo (date("Y-m-d",$judge_time)); ?></p></li><?php endif; ?>
			</ul>

		</div>
		<?php if($status > 1): ?><div class="c_m_r_block"></div>
			<div class="c_m_r_text">
				<h3>评价</h3>
				<?php if(is_array($send_users)): $i = 0; $__LIST__ = $send_users;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><h4><?php echo ($vo["user_nicename"]); ?></h4>
					<div class="my-rating-box">
						<span class="my-rating-left">满意程度</span>
						<div class="my-rating"></div>
					</div>
					<div class="my-rating-box">
						<span class="my-rating-left">评价内容</span>
						<textarea name="" id="" cols="30" rows="10"></textarea>
					</div><?php endforeach; endif; else: echo "" ;endif; ?>
			</div>
			<button class="open-rating-btn">发布评论</button><?php endif; ?>
	</div>
<!--五星评论的js-->
<script src="/public/simpleboot/headmaster/js/star-rating-svg.js"></script>
<script>
	var star_width = 0;
	var star_arr = [];
	window.onload = function(){
		var width = document.body.clientWidth;
		console.log(width);
		if(width >= 320){
			star_width = 20;
		}
		if(width >= 375) {
			star_width = 22;
		}
		if(width >= 414) {
			star_width = 24;
		}
		//初始化五星评论
		$(".my-rating").starRating({
			starSize: star_width,
			disableAfterRate: false,
			useFullStars: true,
			callback: function(currentRating, $el){
				console.log(currentRating);
				star_arr[0] = currentRating;
			}
		});
	};
</script>
<script>
	var tip=['','1.0','2.0','3.0','4.0','5.0'];
	var tip2=['','差','一般','中等','良','优秀'];
	$('.pf').on('mousedown','.glyphicon',function(){
		if($(this).hasClass('glyphicon-star')){
			var score = 0;
			$(this).parent().attr('data-rh-score' ,score);
			$(this).addClass('glyphicon-star-empty').removeClass('glyphicon-star').siblings('.glyphicon').addClass('glyphicon-star-empty').removeClass('glyphicon-star');
			$(this).nextAll('.tip').text(tip[0]);
			$(this).nextAll('.tip2').text(tip2[0]);
		}else{
			var score = $(this).index();
			$(this).parent().attr('data-rh-score' ,score);
			$(this).addClass('glyphicon-star').removeClass('glyphicon-star-empty').prevAll('.glyphicon').addClass('glyphicon-star').removeClass('glyphicon-star-empty');
			$(this).nextAll('.tip').text(tip[score]);
			$(this).nextAll('.tip2').text(tip2[score]);
		}
	});
	function pingjia(){
		var score=[];
		score[0] = $('.pf li:eq(0)').attr('data-rh-score');
		score[1] = $('.pf li:eq(1)').attr('data-rh-score');
		score[2] = $('.pf li:eq(2)').attr('data-rh-score');
		var id = $("[name='id']").val();
		var db = $("[name='db']").val();
		$.ajax({
			url: "<?php echo U('Headmaster/User/pingjia');?>",
			type: 'post',
			dataType:'html',
			data: {"score":score,"id":id,"db":db},
			success: function() {
				location.href = location.href;
			}
		});

	}
</script>
</body>
</html>