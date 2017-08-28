<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>活动详情</title>
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<script src="/public/simpleboot/headmaster/js/rootfont.js"></script>
    <link rel="stylesheet" href="/public/simpleboot/headmaster/css/main.css" />
	<script src="/public/simpleboot/headmaster/js/jquery-1.10.1.min.js"></script>
	<style>
		.application_box{
			width:7.5rem;
			background:rgba(30,30,30,0.6);
			height:100%;
			position:fixed;
			left: 50%;
			top: 50%;
			-webkit-transform: translate(-50%, -50%);
			transform: translate(-50%, -50%);
			display:none;
		}
		.application{
			background:white;
			width:90%;
			border-radius: 4px;
			position:fixed;
			left: 50%;
			top: 50%;
			-webkit-transform: translate(-50%, -50%);
			transform: translate(-50%, -50%);
			z-index:2;
			padding:0.3rem;
		}
		.application textarea{
			resize: none;
			-webkit-appearance: none;
			border:1px solid #999;
			border-radius: 2px;
			font-size:0.26rem;
			text-indent: 0.52rem;
		}
		.application input{
			-webkit-appearance: none;
			border:1px solid #999;
			border-radius: 2px;
			height:0.5rem;
			font-size:0.26rem;
			text-indent: 0.52rem;
			width:4.1rem;
			margin-left:0.1rem;
		}
		.application p label{
			display:inline-block;
			width:1rem;
			font-size:0.26rem;
		}
		.app-btn{
			display:block;
			width:40%;
		    background:rgb(23,176,90);
			color:white;
			margin:0 auto;
			padding:0.15rem 0.3rem;
			font-size:0.26rem;
			border-radius:3px;
			margin-top:0.2rem;
		}
	</style>
</head>
<body>
<script>
document.body.style.height=document.documentElement.clientHeight+"px";
</script>
	<div class="activity-list">
		<div class="activity-banner">
			<img src="<?php echo sp_get_asset_upload_path($act['imagein']);?>" alt="">
		</div>
		<div class="activity-content">
			<div class="activity">
				<h2><?php echo ($act["title"]); ?></h2>
				<div class="activity-title-info clear">
					<div class="activity-title-time">
						<img src="/public/simpleboot/headmaster/images/time-img.png" alt="">
						<span><?php echo (date("Y-m-d", $act["time"])); ?></span>
					</div>
					<div class="activity-title-content">全国学校管理中心</div>
				</div>
			</div>
			<div class="activity">
				<ul>
					<li class="clear">
						<dd>活动时间</dd>
						<dd><?php echo ($act["starttime"]); ?>~<?php echo ($act["endtime"]); ?></dd>
					</li>
					<li class="clear">
						<dd>活动地点</dd>
						<dd><?php echo ($act["area"]); ?></dd>
					</li>
					<li class="clear">
						<dd>报名人数</dd>
						<dd><?php echo ((isset($enter) && ($enter !== ""))?($enter):0); ?>人已报名/限额<?php echo ($act["num"]); ?>人</dd>
					</li>
				</ul>
			</div>
			<div class="activity-text">
				<?php echo ($act["content"]); ?>
			</div>
		</div>
		<?php if($act['isover'] == 0 ): if($act['isbm'] == 0): ?><div class="footer"><span  id="application_btn">我要报名</span></div>
					<?php else: ?>
				<div class="footer"><span style="background-color: #7b8a8b" >您已报名</span></div><?php endif; ?>
			<?php elseif($vo['isfull'] == 1): ?>
				<div class="footer"><span style="background-color: #7b8a8b">人数已满</span></div>
			<?php else: ?>
				<div class="footer"><span style="background-color: #7b8a8b">活动结束</span></div><?php endif; ?>
		<div class="application_box">
			<div class="application">
				<p><label for="">人数:</label><input type="number"  placeholder="请输入参加活动的人数..."><br></p>
				<p style="margin-top:0.3rem;"><label for="" style="vertical-align: top;">备注:</label>
					<textarea name="" id="comments" cols="30" rows="10"></textarea></p>
				<button class="bm app-btn">报名</button>
			</div>
		</div>
	</div>

</body>
<script>
	/*function baoming(id) {
		$.ajax({
			url: "<?php echo U('headmaster/act/attend');?>",
			type: 'post',
			dataType:'html',
			data: {"id":id},
			success: function(msg) {
				var msgs = eval('(' + msg + ')');
				alert(msgs.info);
				location.href=location.href;
			}
		});
	}*/
	var mask = $('.application_box');
	var bm = $('.bm');
	var id = <?php echo ($act['id']); ?>;
	bm.click(function () {
        var comments = $('#comments').val();
		var value = $('input[type = number]').val();
		if(value == ''){
		    alert('请填写人数！');
		    return false;
		}
        $.ajax({
            url: "<?php echo U('headmaster/act/attend');?>",
            type: 'post',
            dataType:'html',
            data: {"act_id":id,'num':value,'comments':comments},
            success: function(msg) {
                var msgs = eval('(' + msg + ')');
                alert(msgs.info);
                location.href=location.href;
            }
        });
    });
	$('#application_btn').click(function () {
         mask.fadeIn();

    })
</script>
</html>