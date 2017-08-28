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
			<li><a href="<?php echo U('act/index');?>">活动列表</a></li>
			<li><a href="<?php echo U('act/add');?>">添加活动</a></li>
			<li class="active"><a>编辑管理员</a></li>
		</ul>
		<form method="post" class="form-horizontal js-ajax-form" action="<?php echo U('act/edit_post');?>">
			<fieldset>
				<div class="control-group">
					<label class="control-label">活动名称</label>
					<div class="controls">
						<input type="text" name="title" value="<?php echo ($act["title"]); ?>">
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">活动内容</label>
					<div class="controls">
						<script type="text/plain" id="content" name="content"><?php echo ($act["content"]); ?></script>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">活动地点</label>
					<div class="controls">
						<input type="text" name="area" value="<?php echo ($act["area"]); ?>">
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">活动开始时间</label>
					<div class="controls">
						<input type="text" class="js-date" name="starttime" value="<?php echo ($act["starttime"]); ?>">
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">活动结束时间</label>
					<div class="controls">
						<input type="text" class="js-date" name="endtime" value="<?php echo ($act["endtime"]); ?>">
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">活动缩略图(255*200)</label>
					<div class="controls">
						<div style="text-align: left;">
							<input type="hidden" name="image" id="thumb" value="<?php echo ($act["image"]); ?>">
							<a href="javascript:upload_one_image('图片上传','#thumb');">
								<?php if(empty($act['image'])): ?><img src="/admin/themes/simplebootx/Public/assets/images/default-thumbnail.png" id="thumb-preview" width="135" style="cursor: hand"/>
									<?php else: ?>
									<img src="<?php echo sp_get_image_preview_url($act['image']);?>" id="thumb-preview" width="135" style="cursor: hand"/><?php endif; ?>

							</a>
							<input type="button" class="btn btn-small" onclick="$('#thumb-preview').attr('src','/admin/themes/simplebootx/Public/assets/images/default-thumbnail.png');$('#thumb').val('');return false;" value="取消图片">
						</div>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">详情页首图(750*220)</label>
					<div class="controls">
						<div style="text-align: left;">
							<input type="hidden" name="imagein" id="thumb1" value="<?php echo ($act["imagein"]); ?>">
							<a href="javascript:upload_one_image('图片上传','#thumb1');">
								<?php if(empty($act['imagein'])): ?><img src="/admin/themes/simplebootx/Public/assets/images/default-thumbnail.png" id="thumb1-preview" width="135" style="cursor: hand"/>
									<?php else: ?>
									<img src="<?php echo sp_get_image_preview_url($act['imagein']);?>" id="thumb1-preview" width="135" style="cursor: hand"/><?php endif; ?>

							</a>
							<input type="button" class="btn btn-small" onclick="$('#thumb1-preview').attr('src','/admin/themes/simplebootx/Public/assets/images/default-thumbnail.png');$('#thumb1').val('');return false;" value="取消图片">
						</div>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">名额限制(默认0代表不限制)</label>
					<div class="controls">
						<input type="text"  name="num" value="<?php echo ($act["num"]); ?>">
					</div>
				</div>
			</fieldset>
			<div class="form-actions">
				<input type="hidden" name="id" value="<?php echo ($act["id"]); ?>" />
				<button type="submit" class="btn btn-primary js-ajax-submit"><?php echo L('SAVE');?></button>
				<a class="btn" href="javascript:history.back(-1);"><?php echo L('BACK');?></a>
			</div>
		</form>
	</div>
	<script src="/public/js/common.js"></script>
	<script type="text/javascript">
		//编辑器路径定义
		var editorURL = GV.WEB_ROOT;
	</script>
	<script type="text/javascript" src="/public/js/ueditor/ueditor.config.js"></script>
	<script type="text/javascript" src="/public/js/ueditor/ueditor.all.min.js"></script>
	<script>
		$(function() {
			Wind.use('ajaxForm', function() {
				//javascript

				//编辑器
				editorcontent = new baidu.editor.ui.Editor();
				editorcontent.render('content');
				try {
					editorcontent.sync();
				} catch (err) {
				}
				//增加编辑器验证规则
				jQuery.validator.addMethod('editorcontent', function () {
					try {
						editorcontent.sync();
					} catch (err) {
					}
					return editorcontent.hasContents();
				});
			});
		});
	</script>
</body>
</html>