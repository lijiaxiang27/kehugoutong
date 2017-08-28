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
<script type="text/javascript">
	$(function(){
		$('.tree li:has(ul)').addClass('parent_li').find(' > span').attr('title', 'open');
		$('.tree li.parent_li > span').on('click', function (e) {
			var children = $(this).parent('li.parent_li').find(' > ul > li');
			if (children.is(":visible")) {
				children.hide('fast');
				$(this).attr('title', 'close').find(' > i').addClass('icon-plus-sign').removeClass('icon-minus-sign');
			} else {
				children.show('fast');
				$(this).attr('title', 'open').find(' > i').addClass('icon-minus-sign').removeClass('icon-plus-sign');
			}
			e.stopPropagation();
		});
	});
</script>
<style>
	.tree {
		min-height:20px;  padding:19px;  margin-bottom:20px;  background-color:#fbfbfb;-webkit-border-radius:4px;  -moz-border-radius:4px;  border-radius:4px;  -webkit-box-shadow:inset 0 1px 1px rgba(0, 0, 0, 0.05);  -moz-box-shadow:inset 0 1px 1px rgba(0, 0, 0, 0.05);  box-shadow:inset 0 1px 1px rgba(0, 0, 0, 0.05)
	}
	.tree li {list-style-type:none;margin:0;padding:10px 5px 0 5px;position:relative}
	.tree li::before,.tree li::after {content:'';left:-20px;  position:absolute;right:auto}
	.tree li::before {border-left:1px solid #999;bottom:50px;height:100%;top:0;width:1px}
	.tree li::after {border-top:1px solid #999;height:20px;top:25px;width:25px;}
	.tree li span {padding:3px 8px;-moz-border-radius:5px;-webkit-border-radius:5px;border:1px solid #999;border-radius:5px;display:inline-block;text-decoration:none}
	.tree li.parent_li>span {cursor:pointer}
	.tree>ul>li::before, .tree>ul>li::after {border:0}
	.tree li:last-child::before {height:30px}
	.tree li.parent_li>span:hover, .tree li.parent_li>span:hover+ul li span {background:#eee;border:1px solid #94a0b4;color:#000}
	.first li{
		display:none;
	}
</style>
</head>
<body>
<div class="wrap js-check-wrap">
	<ul class="nav nav-tabs">
		<li class="active"><a href="<?php echo U('user/framework');?>">组织架构</a></li>
	</ul>
	<div class="tree well">
		<ul>
			<?php if(is_array($arr)): foreach($arr as $k=>$vo): ?><li>
				<span><i class="icon-folder-open"></i><?php echo (sp_get_school_name($k)); ?></span>
				<ul class="first">
					<?php if(is_array($vo)): foreach($vo as $key=>$vv): ?><li>
						<span>
							<?php if(array_key_exists('son',$vv)){ ?>
							<i class="icon-plus-sign"></i>
							<?php } ?>
							<?php echo ($vv["user_nicename"]); ?></span>
						<ul>
							<!-- 三级菜单开始-->
							<?php if(is_array($vv['son'])): foreach($vv['son'] as $key=>$vvv): ?><li>
								<span>
									<!--<i class="icon-plus-sign"></i> -->
									<?php echo ($vvv["user_nicename"]); ?></span>
							</li><?php endforeach; endif; ?>
							<!-- 三级菜单结束-->
						</ul>
					</li><?php endforeach; endif; ?>
				</ul>
			</li><?php endforeach; endif; ?>

		</ul>
	</div>
</div>
</body>
<!--<body>-->
	<!--<div class="wrap js-check-wrap">-->
		<!--<ul class="nav nav-tabs">-->
			<!--<li class="active"><a href="<?php echo U('user/framework');?>">组织架构</a></li>-->
		<!--</ul>-->

		<!--<table class="table table-hover table-bordered">-->
			<!--<ul>-->
			<!--<?php if(is_array($arr)): foreach($arr as $k=>$vo): ?>-->
				<!--<li><a href='<?php echo U("user/edit_xz",array("id"=>$k));?>'><?php echo (sp_get_school_name($k)); ?></a>-->
					<!--<ul>-->
				<!--<?php if(is_array($vo)): foreach($vo as $key=>$vv): ?>-->
					  <!--<li><a href='<?php echo U("user/edit_jg",array("id"=>$vv["id"]));?>'><?php echo ($vv["user_nicename"]); ?></a></li>-->
						<!--<ul>-->
					<!--<?php if(is_array($vv['son'])): foreach($vv['son'] as $key=>$vvv): ?>-->
						<!--<li><a href='<?php echo U("user/edit_xz",array("id"=>$vvv["id"]));?>'><?php echo ($vvv["user_nicename"]); ?></a></li>-->
					<!--<?php endforeach; endif; ?>-->
						<!--</ul>-->
				<!--<?php endforeach; endif; ?>-->
				<!--</ul>-->
				<!--</li>-->
			<!--<?php endforeach; endif; ?>-->
			<!--</ul>-->
		<!--</table>-->
		<!--<div class="pagination"><?php echo ($page); ?></div>-->
	<!--</div>-->
	<!--<script src="/public/js/common.js"></script>-->
<!--</body>-->
</html>