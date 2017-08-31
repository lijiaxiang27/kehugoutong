<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>登陆</title>
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<script src="/public/simpleboot/headmaster/js/rootfont.js"></script>
    <link rel="stylesheet" href="/public/simpleboot/headmaster/css/main.css" />
</head>
<body>
<style>
	#login_btn_wraper{
		text-align: center;
	}
	#login_btn_wraper .tips_success{
		color:#fff;
	}
	#login_btn_wraper .tips_error{
		color:#DFC05D;
	}
	#login_btn_wraper button:focus{outline:none;}
</style>
<script>
	if (window.parent !== window.self) {
		document.write = '';
		window.parent.location.href = window.self.location.href;
		setTimeout(function () {
			document.body.innerHTML = '';
		}, 0);
	}
</script>
<script>
document.body.style.height=document.documentElement.clientHeight+"px";
</script>
<div class="log">
	<div class="log-banner"><img src="/public/simpleboot/headmaster/images/log-1.png" alt=""></div>
	<div class="log-content">
		<form method="post" name="login" action="<?php echo U('public/dologin');?>" autoComplete="off" class="js-ajax-form">
			<div class="log-info clear">
				<div class="log-img"><img src="/public/simpleboot/headmaster/images/log-2.png" alt=""></div>
				<div class="log-input"><input type="text" name="username" pattern="^[1][3587][0-9]{9}$" aria-required="true" autocomplete="off" placeholder="请填写手机号码" value="<?php echo cookie('admin_username');?>"></div>
			</div>
			<div class="log-info clear">
				<div class="log-img"><img src="/public/simpleboot/headmaster/images/log-3.png" alt=""></div>
				<div class="log-input"><input type="password" name="password" aria-required="true" autocomplete="off" placeholder="请输入您的密码"></div>
			</div>
			<div class="log-info clear">
				<div class="log-img"><img style="width:43.8%" src="/public/simpleboot/headmaster/images/log-4.png" alt=""></div>
				<div class="log-input">
					<input type="text" name="verify" aria-required="true" autocomplete="off" placeholder="请输入算式结果">
					<div class="code">
                        <img class="verify_img" src="/index.php?g=api&m=checkcode&a=verify" onclick="this.src='/index.php?g=api&m=checkcode&a=verify&time='+Math.random();" style="cursor: pointer;" title="点击获取">
						<!--<?php echo sp_verifycode_img('length=4&font_size=26&width=188&height=60&use_noise=0&use_curve=0','style="cursor: pointer;" title="点击获取"');?>-->
					</div>
				</div>
			</div>
			<div id="login_btn_wraper">
			<button type="submit" name="submit" class="sub js-ajax-submit" data-loadingmsg="<?php echo L('LOADING');?>"><?php echo L('LOGIN');?></button>
			</div>
				<!--<div class="sub">登录</div>-->
		</form>
		<p  onclick="showBg();">没有账户？</p>	
	</div>
	<div id="hidebg"></div>
	<div id="hidebox" >
		<div class="close" onClick="hide();">×</div>
		<div class="explain">
			<h3>关于客户沟通平台账户说明</h3>
			<p>
				本服务平台针对凹凸个性教育加盟学校投资人及校长使用。校长如需申请，请致电专属运营经理。
			</p>
			<a onClick="hide();" href="javascript:void(0);">知道了</a>
		</div>
	</div>
</div>

<script>
	 function showBg()  //显示隐藏层和弹出层
    {
        var hideobj=document.getElementById("hidebg");
        hidebg.style.display="block";  //显示隐藏层
        hidebg.style.height=document.body.clientHeight+"px";  //设置隐藏层的高度为当前页面高度
        document.getElementById("hidebox").style.display="block";  //显示弹出层

    }
    function hide()  //去除隐藏层和弹出层
    {
        document.getElementById("hidebg").style.display="none";
        document.getElementById("hidebox").style.display="none";
    }
</script>
<script>
	var GV = {
		ROOT: "/",
		WEB_ROOT: "/",
		JS_ROOT: "public/js/"
	};
</script>
<script src="/public/js/wind.js"></script>
<script src="/public/js/jquery.js"></script>
<script type="text/javascript" src="/public/js/common.js"></script>
<script>
	;(function(){
		document.getElementById('js-admin-name').focus();
	})();
</script>
</body>
</html>