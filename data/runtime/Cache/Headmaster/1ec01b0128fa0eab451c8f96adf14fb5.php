<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>投诉</title>
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<script src="/public/simpleboot/headmaster/js/rootfont.js"></script>
    <link rel="stylesheet" href="/public/simpleboot/headmaster/css/main.css" />
     <script src="/public/simpleboot/headmaster/js/jquery-1.10.1.min.js"></script>
</head>
<body>
<script>
document.body.style.height=document.documentElement.clientHeight+"px";
</script>
	<div class="list-content">
		<form name="form1" method="post" action="<?php echo U('Admin/Complain/add');?>" enctype="multipart/form-data" >
			<div class="comp-describe">
				<h3>问题标题</h3>
				<input type="text" name="title" id="title" required maxlength="60"  placeholder="标题限制在20个内">
				<h3>问题描述</h3>
				<textarea name="descript" id="descript" required placeholder="请清楚描述您的问题"></textarea>
			</div>
			<div class="comp-describe">
				<h3>期望解决方案</h3>
				<textarea name="solution" id="solution" required placeholder="请清楚描述您的期望"></textarea>
			</div>
			<div class="comp-tijiao">
				<h3>附件</h3>
				<div class="uploader white">
					<input type="text" class="filename" placeholder="请添加您的附件" readonly/>
					<input type="button"  class="button" style="background:url(/public/simpleboot/headmaster/images/file.png) no-repeat center;background-size:100% 0.39rem" />
					<input type="file" name="file[]" size="30"/>
				</div>
				<div id="tags"></div>
				<p onclick="addNewDiv()">继续添加</p>
				<input type="submit" id="btn" style="-webkit-appearance : none ; "  readonly class="comp-btn" value="提交">
			</div>
		</form>	
	</div>
	<script>
				$(function () {
					$("#btn").click(function () {
						var n = trim($('#title').val());
						var p = trim($('#descript').val());
						var c = $('#solution').val();
						if (n == "") {
							alert('请填写问题标题');
							return false;
						}
						if (p == "") {
							alert('请填写问题描述');
							return false;
						}
						if (c == "") {
							alert('请填写期望解决方案');
							return false;
						}
					});
					return false;
				});


		function trim(str) { //删除左右两端的空格
			return str.replace(/(^\s*)|(\s*$)/g, "");
		}


	    var textbox = document.getElementById('startDate')  
	        textbox.onmouseover = function (event) {  
	            this.type = 'date';  
	            this.focus(); 
	    }
	    var textbox2 = document.getElementById('endDate')  
	        textbox2.onmouseover = function (event) {  
	            this.type = 'date';  
	            this.focus(); 
	    } 
	</script>
	<script>
		function addNewDiv(){
	        $("#tags").append('<div class="uploader white">'+'<input type="text" class="filename" placeholder="请添加您的附件" readonly/>'+
					'<input type="button"  class="button" style="background:url(/public/simpleboot/headmaster/images/file.png) no-repeat center;background-size:100% 0.39rem" />'+
					'<input type="file" name="file[]" size="30"/>'+'</div>');
	    }
	</script>
	<script>
		$(function(){
			$("input[type=file]").change(function(){
				$(this).siblings(".filename").val($(this).val());
			});
			$('.comp-tijiao p').click(function(){
				$('.uploader').each(function(){	
					$("input[type=file]").change(function(){
						$(this).siblings(".filename").val($(this).val());
					});
				})
			});
		});
	</script>  
</body>
</html>