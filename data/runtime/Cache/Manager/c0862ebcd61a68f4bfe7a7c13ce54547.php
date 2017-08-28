<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>活动管理详情</title>
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <script src="/public/simpleboot/headmaster/js/rootfont.js"></script>
<script src="/public/simpleboot/headmaster/js/clipboard.min.js"></script>
<script src="/public/simpleboot/headmaster/js/jquery-1.10.1.min.js"></script>
<link rel="stylesheet" href="/public/simpleboot/headmaster/css/main.css" />
<link rel="stylesheet" href="/public/simpleboot/headmaster/css/manager.css">
<link rel="stylesheet" href="/public/simpleboot/manager/css/manager-v2.0.css">
    <style type="text/css">
        .bdsharebuttonbox a { width: 0.9rem!important; height: 0.9rem!important; margin: 0 auto 10px!important; float: none!important; padding: 0!important; display: block; }
        .bdsharebuttonbox a img { width: 0.9rem; height: 0.9rem; }
        .bdsharebuttonbox .bds_tsina { background: url(/public/simpleboot/manager/images/weibo.png) no-repeat center center/0.65rem 0.65rem;border-radius: 50%;border:1px solid #ccc; }
        .bdsharebuttonbox .bds_qzone { background: url(/public/simpleboot/manager/images/QQ_zone.png) no-repeat center center/0.65rem 0.65rem;border-radius: 50%;border:1px solid #ccc; }
        .bdsharebuttonbox .bds_tweixin { background: url(/public/simpleboot/manager/images/wechat.png) no-repeat center center/0.65rem 0.65rem;border-radius: 50%;border:1px solid #ccc; }
        .bdsharebuttonbox .bds_tcp { background: url(/public/simpleboot/manager/images/link.png) no-repeat center center/0.65rem 0.65rem;border-radius: 50%;border:1px solid #ccc; }
        .bdsharebuttonbox .bds_weixin { background: url(/public/simpleboot/manager/images/pengyouquan.png) no-repeat center center/0.65rem 0.65rem;border-radius: 50%;border:1px solid #ccc; }
        .bdsharebuttonbox .bds_sqq { background: url(/public/simpleboot/manager/images/QQ.png) no-repeat center center/0.65rem 0.65rem;border-radius: 50%;border:1px solid #ccc;}

    </style>
</head>
<body>
<script>
    document.body.style.height=document.documentElement.clientHeight+"px";
</script>
<div class="list-content" style="height:100%;">
    <div class="list-om" style="position:relative;height:100%;">
        <ul class="detail-nav-bar">
            <li>
                <span><?php echo ($count); ?></span>
                <span>报名</span>
            </li>
            <li>
                <span><?php echo ($data["pv"]); ?></span>
                <span>浏览</span>
            </li>
            <li>
                <span><?php echo ($data["share"]); ?></span>
                <span>分享</span>
            </li>
        </ul>
        <div class="activity-management-detail"></div>
        <ul class="activity-config">
            <li>
                <!--跳转到add-activity页面-->
                <a href="add-activity.html">
                    <img src="/public/simpleboot/manager/images/write.png" alt="">
                    <span>内容修改</span>
                </a>
            </li>
            <li>
                <a href="#1" id="share-activity">
                    <img src="/public/simpleboot/manager/images/share1.png" alt="">
                    <span>分享活动</span>
                </a>
            </li>
            <li>
                <a href="<?php echo leuu('active/enter_list',array('id'=>$data['id']));?>">
                    <!--跳转到报名管理-->
                    <img src="/public/simpleboot/manager/images/people.png" alt="">
                    <span>报名管理</span>
                </a>
            </li>
        </ul>
        <div class="activity-management-detail"></div>
        <div class="create-another-activity" onclick="location='<?php echo leuu('Active/act_add');?>'">
            <!--跳转到add-activity页面-->
            <p>再发一个 <a href="#"><img src="/public/simpleboot/manager/images/arrow.png" alt="跳转到add-activity页面"></a></p>
        </div>
        <div class="activity-management-detail"></div>
        <div class="mask-bg">
        </div>
        <div class="share-box bdsharebuttonbox">
            <h3>通过以下方式邀请朋友参加活动</h3>
            <ul class="share-box-lists">
                <li onclick="share_plus(<?php echo ($data["id"]); ?>)">
                    <a href="#" class="bds_weixin"  style="background-position: 0.1rem 0.1rem;">
                        <!--<img src="/public/simpleboot/manager/images/pengyouquan.png" alt=""><br><span>朋友圈</span>-->
                        <span>朋友圈</span>
                    </a>
                </li>
                <li  onclick="share_plus(<?php echo ($data["id"]); ?>)">
                    <a href="#" class="bds_tweixin"  style="background-position: 0.1rem 0.1rem;">
                        <!--<img src="/public/simpleboot/manager/images/wechat.png" alt=""><br><span>微信</span>-->
                        <span>微信</span>
                    </a>
                </li>
                <li  onclick="share_plus(<?php echo ($data["id"]); ?>)">
                    <a href="#" class="bds_sqq"  style="background-position: 0.1rem 0.1rem;">
                        <!--<img src="/public/simpleboot/manager/images/QQ.png" alt=""><br><span>QQ</span>-->
                        <span>QQ</span>
                    </a>
                </li>
                <li onclick="share_plus(<?php echo ($data["id"]); ?>)">
                    <a href="#" class="bds_tcp" id="copyUrl" style="background-position: 0.1rem 0.1rem;">
                        <!--<img src="/public/simpleboot/manager/images/link.png" alt=""><br><span>复制链接</span>-->
                        <span>复制链接</span>
                    </a>
                </li>
                <li onclick="share_plus(<?php echo ($data["id"]); ?>)">
                    <a href="#" class="bds_tsina"  style="background-position: 0.1rem 0.1rem;">
                        <!--<img src="/public/simpleboot/manager/images/weibo.png" alt=""><br><span>微博</span>-->
                        <span>微博</span>
                    </a>
                </li>

                <li onclick="share_plus(<?php echo ($data["id"]); ?>)">
                    <a href="#" class="bds_qzone"  style="background-position: 0.1rem 0.1rem;">
                        <!--<img src="/public/simpleboot/manager/images/QQ_zone.png" alt=""><br><span>QQ空间</span>-->
                        <span>QQ空间</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
<p class="copy-suc">复制成功！</p>
<script src="http://res.wx.qq.com/open/js/jweixin-1.2.0.js"></script>
<script>
    var num = 0;
    var shareActivity = $('#share-activity');//分享活动按钮
    var mask_bg = $('.mask-bg');//黑色遮罩层
    var share_box = $('.share-box');//分享容器
    var copyUrl = $('#copyUrl');//分享链接按钮
    var copy_suc = $('.copy-suc');//复制成功弹出框


    mask_bg.click(function(){
        $(this).fadeOut(400);
        share_box.animate({
            bottom: "-50%"
        },400);

    });
    shareActivity.click(function(){
        mask_bg.fadeIn(400);
        share_box.animate({bottom: "2%"},400);

    });


//    copyUrl.click(function()
//        copy_suc.css({
//            'opacity':1,
//            'top':'40%',
//            'z-index':'99',
//            'display':'block'
//        });
//        setTimeout(function(),1200);
//        num++;
//    })
</script>
<script>
    function share_plus(id){
        $.ajax({
            type:'post',
            url : "<?php echo leuu('Api/share_plus');?>",
            data :{
                'id':id
            },
            dataType :'json',
            success : function(){
            }
        });
    }


</script>
<!--onMenuShareTimeline
onMenuShareAppMessage
onMenuShareQQ
onMenuShareWeibo
onMenuShareQZone-->
<script>
	wx.config({
        debug: true,
        appId: "<?php echo ($str['appId']); ?>",
        timestamp: <?php echo ($str['timestamp']); ?>,
        nonceStr: "<?php echo ($str['nonceStr']); ?>",
        signature: "<?php echo ($str['signature']); ?>",
        jsApiList: [<?php echo ($jsApiList); ?>]
    });
	wx.ready(function(){
	    wx.hideOptionMenu();
		wx.hideMenuItems({
		  menuList: [
			'menuItem:readMode', // 阅读模式
			'menuItem:share:timeline', // 分享到朋友圈
			'menuItem:copyUrl' // 复制链接
		  ],
		  success: function (res) {
			alert('已隐藏“阅读模式”，“分享到朋友圈”，“复制链接”等按钮');
		  },
		  fail: function (res) {
			alert(JSON.stringify(res));
		  }
		});
		
	// config信息验证后会执行ready方法，所有接口调用都必须在config接口获得结果之后，config是一个客户端的异步操作，所以如果需要在页面加载时就调用相关接口，则须把相关接口放在ready函数中调用来确保正确执行。对于用户触发时才调用的接口，则可以直接调用，不需要放在ready函数中。
	});
	
</script>


</body>
</html>