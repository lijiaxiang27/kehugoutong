<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!--campus_management-->
    <title>校区管理</title>
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <script src="/public/simpleboot/headmaster/js/rootfont.js"></script>
<script src="/public/simpleboot/headmaster/js/clipboard.min.js"></script>
<script src="/public/simpleboot/headmaster/js/jquery-1.10.1.min.js"></script>
<link rel="stylesheet" href="/public/simpleboot/headmaster/css/main.css" />
<link rel="stylesheet" href="/public/simpleboot/headmaster/css/manager.css">
<link rel="stylesheet" href="/public/simpleboot/manager/css/manager-v2.0.css">
    <link rel="stylesheet" href="/public/simpleboot/manager/css/campus.css">
    <style>
        .edit_campus,.delete_campus{
            float:right;
            color:white;
            background:rgb(23,176,90);
            padding:0.12rem 0.2rem;
            margin-left:0.2rem;
            border-radius:3px;
        }
        .campus-lists-box .campus-list {
            padding: 0.2rem 0 0.05rem;
            border-bottom: 1px solid #ccc;
            color: #666;
        }
    </style>
</head>
<body>
<script>
    document.body.style.height=document.documentElement.clientHeight+"px";
</script>
<div class="list-content" style="height:100%;">
    <div class="list-om" style="position:relative;height:100%;">
        <div class="add-new-campus" onclick="location='<?php echo leuu('school/add_school');?>'">
            <a href="#"><img src="/public/simpleboot/manager/images/add-list.png" alt=""></a><span>新增校区</span>
        </div>
        <div class="area-div"></div>
        <div class="campus-lists-box">
            <?php if(is_array($schools)): $i = 0; $__LIST__ = $schools;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="campus-list">
                  <h3><?php echo ($vo["user_nicename"]); ?></h3>
                  <p class="clear">
                      <span><?php echo ($vo["master_name"]); ?></span>&nbsp; |&nbsp; <span><?php echo ($vo["user_login"]); ?></span>
                      <span class="edit_campus" onclick="location='<?php echo leuu('school/save_school',array('id'=>$vo['id']));?>'">编辑</span>
                      <span class="delete_campus" s_id="<?php echo ($vo["id"]); ?>">删除</span>
                  </p>
             </div><?php endforeach; endif; else: echo "" ;endif; ?>
        </div>

    </div>
</div>
<script>
    var delete_campus = $('.delete_campus');
    $.each(delete_campus,function(i,e){
        console.log(i);
        delete_campus.eq(i).click(function(){
            var del_id = $(this).attr('s_id');
            var del = $(this);
            var br = confirm('是否删除该校区？');
            if(br){
                $.ajax({
                    url:"<?php echo U('School/del_school');?>",
                    type:'get',
                    dataType:'json',
                    data:{'id':del_id},
                    success:function(msg){
                        if(msg.code==200){
                            alert(msg.info);
                            del.parent().parent().remove();
                        }else{
                            alert(msg.info);
                        }
                    }

                })

            }
        })
    })
</script>
</body>
</html>