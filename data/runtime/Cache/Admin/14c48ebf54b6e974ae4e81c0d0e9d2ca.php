<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<!-- Set render engine for 360 browser -->
	<meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- HTML5 shim for IE8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <![endif]-->

	<link href="/public/simpleboot/themes/<?php echo C('SP_ADMIN_STYLE');?>/theme.min.css" rel="stylesheet">
    <link href="/public/simpleboot/css/simplebootadmin.css" rel="stylesheet">
    <link href="/public/js/artDialog/skins/default.css" rel="stylesheet" />
    <link href="/public/simpleboot/font-awesome/4.4.0/css/font-awesome.min.css"  rel="stylesheet" type="text/css">
    <style>
		form .input-order{margin-bottom: 0px;padding:3px;width:40px;}
		.table-actions{margin-top: 5px; margin-bottom: 5px;padding:0px;}
		.table-list{margin-bottom: 0px;}
	</style>
	<!--[if IE 7]>
	<link rel="stylesheet" href="/public/simpleboot/font-awesome/4.4.0/css/font-awesome-ie7.min.css">
	<![endif]-->
	<script type="text/javascript">
	//全局变量
	var GV = {
	    ROOT: "/",
	    WEB_ROOT: "/",
	    JS_ROOT: "public/js/",
	    APP:'<?php echo (MODULE_NAME); ?>'/*当前应用名*/
	};
	</script>
    <script src="/public/js/jquery.js"></script>
    <script src="/public/js/wind.js"></script>
    <script src="/public/simpleboot/bootstrap/js/bootstrap.min.js"></script>
    <script>
    	$(function(){
    		$("[data-toggle='tooltip']").tooltip();
    	});
    </script>
<?php if(APP_DEBUG): ?><style>
		#think_page_trace_open{
			z-index:9999;
		}
	</style><?php endif; ?>
</head>
<body>
	<div class="wrap">
		<ul class="nav nav-tabs">
			<!--<li><a href="<?php echo U('support/index');?>">入校支持申请列表</a></li>-->
			<li class="active"><a href="#">详情</a></li>
		</ul>
        <form method="post" class="form-horizontal js-ajax-form" action="<?php echo U('complain/edit_post');?>">
			<fieldset>
				<div class="control-group">
				<label class="control-label">问题标题</label>
				<div class="controls">
					<input type="text" name="user_nicename" value="<?php echo ($title); ?>" readonly="true">
				</div>
			</div>
				<div class="control-group">
					<label class="control-label">运营经理</label>
					<div class="controls">
						<input type="text" name="titile" value="<?php echo ($yyjl); ?>" readonly="true">
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">申请校区</label>
					<div class="controls">
						<input type="text" name="province" value="<?php echo ($user_nicename); ?>" readonly="true">
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">问题描述</label>
					<div class="controls">
						<textarea name="" id="" cols="10" rows="5" readonly="true"><?php echo ($descript); ?></textarea>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">期望解决方案</label>
					<div class="controls">
						<textarea name="" id="" cols="10" rows="5" readonly="true"><?php echo ($solution); ?></textarea>
					</div>
				</div>
				<?php if(!empty($files)): ?><div class="control-group">
					<label class="control-label">附件</label>
					<?php if(is_array($files)): foreach($files as $key=>$vo): ?><div class="controls">
						<a href="javascript:;" class="down" data="<?php echo ($vo["id"]); ?>"><?php echo ($vo["name"]); ?></a>
					</div><?php endforeach; endif; ?>
				</div><?php endif; ?>
				<div class="control-group">
					<label class="control-label">评价</label>
					<div class="controls">
						<?php if($judge != '' ): ?><input type="text" name="continue" value="处理结果-<?php echo ($tips[0]); ?>-<?php echo ($tip2s[0]); ?>" readonly="true">
							<input type="text" name="continue" value="处理速度-<?php echo ($tips[1]); ?>-<?php echo ($tip2s[1]); ?>" readonly="true">
							<input type="text" name="continue" value="服务态度-<?php echo ($tips[2]); ?>-<?php echo ($tip2s[2]); ?>" readonly="true">
							<?php else: ?>
							待评价<?php endif; ?>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">提交时间</label>
					<div class="controls">
						<input type="text" name="continue" value="<?php echo (date('Y-m-d H:i:s',$time)); ?>" readonly="true">
					</div>
				</div>
			</fieldset>
			<div class="form-actions">
                <input type="hidden" name="id" value="<?php echo ($id); ?>" />
				<?php if($status > 1): ?><a class="btn" href="javascript:void(0)">已解决</a>
					<?php else: ?>
					<button type="submit" class="btn btn-primary js-ajax-submit">已解决</button><?php endif; ?>
				<a class="btn" href="javascript:history.back(-1);"><?php echo L('BACK');?></a>
			</div>
        </form>
	</div>
	<script src="/public/js/common.js"></script>
	<script>
		$(function(){
			$('.down').on('click', function(){
				var id = $(this).attr('data');
				window.location.href = '/index.php/Admin/Complain/download/id/' + id;
			});
		});
	</script>
</body>
</html>