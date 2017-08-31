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
		<div class="handling-list">
			<h3>处理进度</h3>
			<ul>
				<li class="clear">
					<p><img src="/public/simpleboot/headmaster/images/cljd-01.png" alt=""></p>
					<div class="handling-title">
						<h4>您的问题已经提交成功</h4>
						<span><?php echo (date("Y-m-d",$complain["time"])); ?></span>
						<div></div>
					</div>
				</li>
				<li class="clear">
					<p><img src="/public/simpleboot/headmaster/images/cljd-01.png" alt=""></p>
					<div class="handling-title">
						<h4>客服服务经理已经收到您的问题<br>您的问题正在处理中</h4>
						<span><?php echo (date("Y-m-d",$complain["time"])); ?></span>
						<div></div>
					</div>
				</li>
                <?php if($complain['status'] <= 1 ): ?><li class="clear">
					<p><img class="invisible" src="/public/simpleboot/headmaster/images/cljd-02.png" alt=""></p>
					<div class="handling-title">
						<h4>您的问题已经解决</h4>
						<span></span>
						<div ></div>
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
                    <?php elseif($complain['status'] > 1): ?>
                    <li class="clear">
                        <p><img  src="/public/simpleboot/headmaster/images/cljd-02.png" alt=""></p>
                        <div class="handling-titlegrey">
                            <h4>您的问题已经解决</h4>
                            <span><?php echo (date("Y-m-d",$complain["solvetime"])); ?></span>
                            <div style="border:1px solid #17b05a;background: #17b05a;width: 0.1rem;height: 0.1rem;border-radius: 0.05rem;position: absolute;top:-0.05rem;left: -0.05rem;"></div>
                        </div>
                    </li>
                    <li class="clear">
                        <p><img  src="/public/simpleboot/headmaster/images/cljd-03.png" alt=""></p>
                        <div class="handling-titlegrey">
                            <h4>请您对我们的服务做出评价</h4>
                            <span><?php echo (date("Y-m-d",$complain["solvetime"])); ?></span>
                            <div style="border:1px solid #17b05a;background: #17b05a;width: 0.1rem;height: 0.1rem;border-radius: 0.05rem;position: absolute;top:-0.05rem;left: -0.05rem;"></div>
                        </div>
                    </li><?php endif; ?>
			</ul>
		</div>
		<div class="details">
			<h3>问题详情</h3>
			<ul>
				<!--<li class="clear"><span>投诉人：</span><p>李先生</p></li>-->
				<!--<li class="clear"><span>联系电话：</span><p>18310992288</p></li>-->
				<!--<li class="clear"><span>合同开始日期：</span><p>2016-03-11</p></li>-->
				<!--<li class="clear"><span>合同结束日期：</span><p>2016-03-11</p></li>-->
				<!--<li class="clear"><span>合同形式：</span><p>直盟授权</p></li>-->
				<li class="clear"><span>问题描述：</span><p><?php echo ($complain["descript"]); ?></p></li>
				<li class="clear"><span>期望解决方案：</span><p><?php echo ($complain["solution"]); ?></p></li>
				<li class="clear"><span>附件： </span><p><?php if(empty($files)): ?>无<?php endif; ?></p></li>
			</ul>
			<?php if(!empty($files)): ?><div class="details-fj">
				<ul>
					<?php if(is_array($files)): foreach($files as $key=>$vo): ?><li class="clear">
						<figure><img src="/public/simpleboot/headmaster/images/fj-02.png" alt=""></figure>
						<div class="details-title">
							<h4><?php echo ($vo["name"]); ?></h4>
							<span><?php echo ($vo["size"]); ?></span>
						</div>
					</li><?php endforeach; endif; ?>
				</ul>
			</div><?php endif; ?>
		</div>
		<?php if($complain['status'] > 1): ?><div class="evaluate clear">
			<h3>评价</h3>
			<form action="">
				<input type="hidden" name="id" value="<?php echo ($complain["id"]); ?>">
				<?php if($complain['status'] < 3 ): ?><ul class="pf">
					<li class="clear" data-rh-score="3">
						<span class="title" id="star1">处理结果</span>
						<span class="glyphicon glyphicon-star-empty"></span>
						<span class="glyphicon glyphicon-star-empty"></span>
						<span class="glyphicon glyphicon-star-empty"></span>
						<span class="glyphicon glyphicon-star-empty"></span>
						<span class="glyphicon glyphicon-star-empty"></span>
						<span class="tip"></span>
						<span class="tip2"></span>
					</li>
					<li class="clear" data-rh-score="4">
						<span class="title" id="star2">处理速度</span>
						<span class="glyphicon glyphicon-star-empty"></span>
						<span class="glyphicon glyphicon-star-empty"></span>
						<span class="glyphicon glyphicon-star-empty"></span>
						<span class="glyphicon glyphicon-star-empty"></span>
						<span class="glyphicon glyphicon-star-empty"></span>
						<span class="tip"></span>
						<span class="tip2"></span>
					</li>
					<li class="clear" data-rh-score="5">
						<span class="title" id="star3">服务态度</span>
						<span class="glyphicon glyphicon-star-empty"></span>
						<span class="glyphicon glyphicon-star-empty"></span>
						<span class="glyphicon glyphicon-star-empty"></span>
						<span class="glyphicon glyphicon-star-empty"></span>
						<span class="glyphicon glyphicon-star-empty"></span>
						<span class="tip"></span>
						<span class="tip2"></span>
					</li>
				</ul>
					<input type="text" readonly onclick="pingjia()" value="发布">
					<?php else: ?>
					<?php $arr = unserialize($complain['judge']); $tip=array('','1.0','2.0','3.0','4.0','5.0'); $tip2=array('','差','一般','中等','良','优秀'); foreach($arr as $k=>$v){ $tips[$k] = $tip[$v]; $tip2s1[$k] = $tip2[$v]; $arr1[] = 5-$v; } ?>
					<ul class="pf">
						<li class="clear" data-rh-score="3">
							<span class="title" id="star1">处理结果</span>
							<?php $__FOR_START_324500765__=0;$__FOR_END_324500765__=$arr['0'];for($i=$__FOR_START_324500765__;$i < $__FOR_END_324500765__;$i+=1){ ?><span style="pointer-events: none" class="glyphicon glyphicon-star"></span><?php } ?>
							<?php $__FOR_START_146661019__=0;$__FOR_END_146661019__=$arr1['0'];for($i=$__FOR_START_146661019__;$i < $__FOR_END_146661019__;$i+=1){ ?><span style="pointer-events: none" class="glyphicon glyphicon-star-empty"></span><?php } ?>
							<span class="tip"><?php echo ($tips[0]); ?></span>
							<span class="tip2"><?php echo ($tip2s1[0]); ?></span>
						</li>
						<li class="clear" data-rh-score="4">
							<span class="title" id="star2">处理速度</span>
							<?php $__FOR_START_1272812782__=0;$__FOR_END_1272812782__=$arr['1'];for($i=$__FOR_START_1272812782__;$i < $__FOR_END_1272812782__;$i+=1){ ?><span style="pointer-events: none" class="glyphicon glyphicon-star"></span><?php } ?>
							<?php $__FOR_START_1461909654__=0;$__FOR_END_1461909654__=$arr1['1'];for($i=$__FOR_START_1461909654__;$i < $__FOR_END_1461909654__;$i+=1){ ?><span style="pointer-events: none" class="glyphicon glyphicon-star-empty"></span><?php } ?>
							<span class="tip"><?php echo ($tips[1]); ?></span>
							<span class="tip2"><?php echo ($tip2s1[1]); ?></span>
						</li>
						<li class="clear" data-rh-score="5">
							<span class="title" id="star3">服务态度</span>
							<?php $__FOR_START_1986472139__=0;$__FOR_END_1986472139__=$arr['2'];for($i=$__FOR_START_1986472139__;$i < $__FOR_END_1986472139__;$i+=1){ ?><span style="pointer-events: none" class="glyphicon glyphicon-star"></span><?php } ?>
							<?php $__FOR_START_162630747__=0;$__FOR_END_162630747__=$arr1['2'];for($i=$__FOR_START_162630747__;$i < $__FOR_END_162630747__;$i+=1){ ?><span style="pointer-events: none" class="glyphicon glyphicon-star-empty"></span><?php } ?>
							<span class="tip"><?php echo ($tips[2]); ?></span>
							<span class="tip2"><?php echo ($tip2s1[2]); ?></span>
						</li>
					</ul><?php endif; ?>
			</form>
		</div><?php endif; ?>
	</div>
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
		$.ajax({
			url: "<?php echo U('Headmaster/complain/pingjia');?>",
			type: 'post',
			dataType:'html',
			data: {"score":score,"id":id},
			success: function() {
				location.href = location.href;
			}
		});

	}
</script>
</body>
</html>