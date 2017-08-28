<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>申请处理</title>
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <script src="/public/simpleboot/headmaster/js/rootfont.js"></script>
<script src="/public/simpleboot/headmaster/js/clipboard.min.js"></script>
<script src="/public/simpleboot/headmaster/js/jquery-1.10.1.min.js"></script>
<link rel="stylesheet" href="/public/simpleboot/headmaster/css/main.css" />
<link rel="stylesheet" href="/public/simpleboot/headmaster/css/manager.css">
<link rel="stylesheet" href="/public/simpleboot/manager/css/manager-v2.0.css">
</head>
<body>
<script>
    document.body.style.height=document.documentElement.clientHeight+"px";
</script>
<div class="list-content">
    <div class="list-om">
         <div class="application-list">
             <h3>申请列表</h3>
             <div class="header">
                 <div class="header-box option-left" >
                     <a href="<?php echo leuu('manager/index/index',array('status'=>'1'));?>" class="application-option ">
                         <img src="/public/simpleboot/manager/images/hourglass1.png" alt="">
                     </a>
                     <span>待审批</span>
                 </div>
                 <div class="header-box option-right">
                     <a href="<?php echo leuu('manager/index/index',array('status'=>'2'));?>" class="application-option ">
                         <img src="/public/simpleboot/manager/images/check.png" alt="">
                     </a>
                     <span>已处理</span>
                 </div>
             </div>
         </div>
         <div class="application-lists">
             <!--设计申请-->
             <?php if(is_array($designs)): $i = 0; $__LIST__ = $designs;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="application-lists-detail">
                      <img src='<?php echo sp_get_user_avatar_url($vo["avatar"]);?>' alt="头像">
                      <div class="detail-center" onclick="location='<?php echo leuu('index/application_detail',array('id'=>$vo['id'],'type'=>'design'));?>'">
                          <p class="detail-event"><?php echo ($vo["user_nicename"]); ?>的设计申请需要你处理</p>
                          <p class="detail-schoolName">校区名称：<?php echo ($vo["user_nicename"]); ?></p>
                          <p class="detail-type">申请类型：设计申请</p>
                          <?php if($vo['status'] <= 1 ): ?><span class="approval-result" style="color:rgb(248,180,44) ">待审批</span>
                              <?php elseif($vo['status'] <= 3 ): ?>
                              <span class="approval-result" style="color:rgb(0,196,109) ">已处理</span>
                              <?php elseif($vo['status'] == 4 ): ?>
                              <span class="approval-result" style="color:rgb(255,45,67) ">已拒绝</span><?php endif; ?>
                      </div>
                      <span class="detail-time"><?php echo (date("Y/m/d",$vo["time"])); ?></span>
              </div><?php endforeach; endif; else: echo "" ;endif; ?>
             <!--入校支持-->
             <?php if(is_array($supports)): $i = 0; $__LIST__ = $supports;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="application-lists-detail">
                     <img src='<?php echo sp_get_user_avatar_url($vo["avatar"]);?>' alt="头像">
                     <div class="detail-center" onclick="location='<?php echo leuu('index/application_detail',array('id'=>$vo['id'],'type'=>'support'));?>'">
                         <p class="detail-event"><?php echo ($vo["user_nicename"]); ?>的入校支持需要你处理</p>
                         <p class="detail-schoolName">校区名称：<?php echo ($vo["user_nicename"]); ?></p>
                         <p class="detail-type">申请类型：入校支持</p>
                         <?php if($vo['status'] <= 1 ): ?><span class="approval-result" style="color:rgb(248,180,44) ">待审批</span>
                             <?php elseif($vo['status'] <= 3 ): ?>
                             <span class="approval-result" style="color:rgb(0,196,109) ">已处理</span>
                             <?php elseif($vo['status'] == 4 ): ?>
                             <span class="approval-result" style="color:rgb(255,45,67) ">已拒绝</span><?php endif; ?>
                     </div>
                     <span class="detail-time"><?php echo (date("Y/m/d",$vo["time"])); ?></span>
                 </div><?php endforeach; endif; else: echo "" ;endif; ?>
             <!--家庭讲座-->
             <?php if(is_array($lectures)): $i = 0; $__LIST__ = $lectures;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="application-lists-detail">
                     <img src='<?php echo sp_get_user_avatar_url($vo["avatar"]);?>' alt="头像">
                     <div class="detail-center" onclick="location='<?php echo leuu('index/application_detail',array('id'=>$vo['id'],'type'=>'lecture'));?>'">
                         <p class="detail-event"><?php echo ($vo["user_nicename"]); ?>的家庭讲座需要你处理</p>
                         <p class="detail-schoolName">校区名称：<?php echo ($vo["user_nicename"]); ?></p>
                         <p class="detail-type">申请类型：家庭讲座</p>
                         <?php if($vo['status'] <= 1 ): ?><span class="approval-result" style="color:rgb(248,180,44) ">待审批</span>
                             <?php elseif($vo['status'] <= 3 ): ?>
                             <span class="approval-result" style="color:rgb(0,196,109) ">已处理</span>
                             <?php elseif($vo['status'] == 4 ): ?>
                             <span class="approval-result" style="color:rgb(255,45,67) ">已拒绝</span><?php endif; ?>
                     </div>
                     <span class="detail-time"><?php echo (date("Y/m/d",$vo["time"])); ?></span>
                 </div><?php endforeach; endif; else: echo "" ;endif; ?>
             <!--其他申请-->
             <?php if(is_array($others)): $i = 0; $__LIST__ = $others;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="application-lists-detail">
                     <img src='<?php echo sp_get_user_avatar_url($vo["avatar"]);?>' alt="头像">
                     <div class="detail-center"  onclick="location='<?php echo leuu('index/application_detail',array('id'=>$vo['id'],'type'=>'other_app'));?>'">
                         <p class="detail-event"><?php echo ($vo["user_nicename"]); ?>的其它需要你处理</p>
                         <p class="detail-schoolName">校区名称：<?php echo ($vo["user_nicename"]); ?></p>
                         <p class="detail-type">申请类型：其它申请</p>
                         <?php if($vo['status'] <= 1 ): ?><span class="approval-result" style="color:rgb(248,180,44) ">待审批</span>
                             <?php elseif($vo['status'] <= 3 ): ?>
                             <span class="approval-result" style="color:rgb(0,196,109) ">已处理</span>
                             <?php elseif($vo['status'] == 4 ): ?>
                             <span class="approval-result" style="color:rgb(255,45,67) ">已拒绝</span><?php endif; ?>

                     </div>
                     <span class="detail-time"><?php echo (date("Y/m/d",$vo["time"])); ?></span>
                 </div><?php endforeach; endif; else: echo "" ;endif; ?>

         </div>
         <!--footer-->
        <footer>
    <ul class="footer-nav">
        <li>
            <a href="<?php echo leuu('index/index');?>">
                <img src="/public/simpleboot/manager/images/clock.png" alt="">
                <p>申请处理</p>
            </a>
        </li>
        <li>
            <a href="<?php echo leuu('Active/index');?>">
                <img src="/public/simpleboot/manager/images/activity-manager.png" alt="">
                <p>活动管理</p>
            </a>
        </li>
        <li>
            <a href="">
                <img src="/public/simpleboot/manager/images/data.png" alt="">
                <p>资料更新</p>
            </a>
        </li>
        <li>
            <a href="<?php echo leuu('School/index');?>">
                <img src="/public/simpleboot/manager/images/school.png" alt="">
                <p>校区管理</p>
            </a>
        </li>
        <li>
            <a href="<?php echo leuu('User/index');?>">
                <img src="/public/simpleboot/manager/images/user-center1.png" alt="">
                <p>个人中心</p>
            </a>
        </li>
    </ul>
</footer>

    </div>
</div>
</body>
</html>