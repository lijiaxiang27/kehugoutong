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
			<li><a href="<?php echo U('user/index_qy',array('id'=>5));?>"><?php echo L('ADMIN_USER_INDEX');?></a></li>
			<li><a href="<?php echo U('user/add_qy',array('id'=>5));?>"><?php echo L('ADMIN_USER_ADD');?></a></li>
			<li class="active"><a>编辑管理员</a></li>
		</ul>
		<form method="post" class="form-horizontal js-ajax-form" action="<?php echo U('User/edit_post');?>">
			<fieldset>
				<div class="control-group">
					<label class="control-label">所属区域</label>
					<div class="controls">
						<input type="text" name="user_area" value="<?php echo ($user_area); ?>">
					</div>
				</div>
                <div class="control-group">
                    <label class="control-label">姓名</label>
                    <div class="controls">
                        <input type="text" name="user_nicename" value="<?php echo ($user_nicename); ?>">
                    </div>
                </div>
				<div class="control-group">
					<label class="control-label">(手机号)登录账号</label>
					<div class="controls">
						<input type="text" name="user_login" value="<?php echo ($user_login); ?>">
					</div>
				</div>
				<div class="control-group">
					<label class="control-label"><?php echo L('PASSWORD');?></label>
					<div class="controls">
						<input type="password" name="password" value="" placeholder="******">
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">微信号</label>
					<div class="controls">
						<input type="text" name="user_wx" value="<?php echo ($user_wx); ?>">
					</div>
				</div>
				<div class="control-group">
					<label class="control-label"><?php echo L('EMAIL');?></label>
					<div class="controls">
						<input type="text" name="user_email" value="<?php echo ($user_email); ?>">
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">头像</label>
					<div class="controls">
						<div style="text-align: left;">
							<input type="hidden" name="avatar" id="thumb" value="<?php echo ($avatar); ?>">
							<a href="javascript:upload_one_headimage('图片上传','#thumb');">
								<?php if(empty($avatar)): ?><img src="/admin/themes/simplebootx/Public/assets/images/default-thumbnail.png" id="thumb-preview" width="135" style="cursor: hand"/>
									<?php else: ?>
									<img src="<?php echo sp_get_image_preview_url($avatar);?>" id="thumb-preview" width="135" style="cursor: hand"/><?php endif; ?>
							</a>
							<input type="button" class="btn btn-small" onclick="$('#thumb-preview').attr('src','/admin/themes/simplebootx/Public/assets/images/default-thumbnail.png');$('#thumb').val('');return false;" value="取消图片">
						</div>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="input-gender"><?php echo L('GENDER');?></label>
					<div class="controls">
						<select name="sex" id="input-gender">
							<?php $sexs=array("0"=>L('GENDER_SECRECY'),"1"=>L('MALE'),"2"=>L('FEMALE')); ?>
							<?php if(is_array($sexs)): foreach($sexs as $key=>$vo): $sexselected=$key==$sex?"selected":""; ?>
								<option value="<?php echo ($key); ?>"<?php echo ($sexselected); ?>><?php echo ($vo); ?></option><?php endforeach; endif; ?>
						</select>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="input-signature">个人介绍</label>
					<div class="controls">
						<textarea id="input-signature" placeholder="个人介绍" name="signature"><?php echo ($signature); ?></textarea>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="input-signature">擅长业务</label>
					<div class="controls">
						<textarea  placeholder="擅长业务(请用'|'号隔开)" name="skill"><?php echo ($skill); ?></textarea>
					</div>
				</div>

				<div class="control-group">
					<label class="control-label"><?php echo L('ROLE');?></label>
					<div class="controls">
						<?php if(is_array($roles)): foreach($roles as $key=>$vo): ?><label class="checkbox inline">
							<?php $role_id_checked=in_array($vo['id'],$role_ids)?"checked":""; ?>
							<input value="<?php echo ($vo["id"]); ?>" type="checkbox" name="role_id[]" <?php echo ($role_id_checked); ?> <?php if(sp_get_current_admin_id() != 1 && $vo['id'] == 1): ?>disabled="true"<?php endif; ?>><?php echo ($vo["name"]); ?>
						</label><?php endforeach; endif; ?>
					</div>
				</div>
			</fieldset>
			<div class="form-actions">
				<input type="hidden" name="id" value="<?php echo ($id); ?>" />
				<button type="submit" class="btn btn-primary js-ajax-submit"><?php echo L('SAVE');?></button>
				<a class="btn" href="javascript:history.back(-1);"><?php echo L('BACK');?></a>
			</div>
		</form>
	</div>
	<script src="/public/js/common.js"></script>
</body>
</html>