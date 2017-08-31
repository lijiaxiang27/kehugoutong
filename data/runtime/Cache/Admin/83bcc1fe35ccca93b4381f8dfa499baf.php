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
	<div class="wrap js-check-wrap">
		<ul class="nav nav-tabs">
			<li class="active"><a href="<?php echo U('Complain/index');?>">投诉列表</a></li>
		</ul>

		<table class="table table-hover table-bordered">
			<thead>
				<tr>
					<th width="50">ID</th>
					<th>问题标题</th>
					<th>运营经理</th>
					<th>申请校区</th>
					<th>提交时间</th>
					<th>状态</th>
					<th width="120"><?php echo L('ACTIONS');?></th>
				</tr>
			</thead>
			<tbody>
				<?php $user_statuses=array("0"=>L('USER_STATUS_BLOCKED'),"1"=>L('USER_STATUS_ACTIVATED'),"2"=>L('USER_STATUS_UNVERIFIED')); ?>
				<?php if(is_array($complains)): foreach($complains as $key=>$vo): ?><tr>
					<td><?php echo ($vo["id"]); ?></td>
					<td><?php echo ($vo["title"]); ?></td>
					<td><?php echo ($vo["yyjl"]); ?></td>
					<td><?php echo ($vo["user_nicename"]); ?></td>
					<td><?php echo (date("Y-m-d H:i:s",$vo["time"])); ?></td>
					<td>
						<?php if($vo['status'] == '0' ): ?><span style="color: #d41e24">未读</span>
							<?php elseif($vo['status'] == '1'): ?>
							处理中
							<?php elseif($vo['status'] == '2'): ?>
						待评价
						<?php elseif($vo['status'] == '3'): ?>
							<span style="color: #0071ce">完成</span><?php endif; ?>
					</td>
					<td>

							<a href='<?php echo U("Complain/edit",array("id"=>$vo["id"]));?>'>查看详情</a> |

							<a class="js-ajax-delete" href="<?php echo U('Complain/delete',array('id'=>$vo['id']));?>"><?php echo L('DELETE');?></a>

					</td>
				</tr><?php endforeach; endif; ?>
			</tbody>
		</table>
		<div class="pagination"><?php echo ($page); ?></div>
	</div>
	<script src="/public/js/common.js"></script>
</body>
</html>