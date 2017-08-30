<?php
/**
 * Created by PhpStorm.
 * User: tester
 * Date: 17/7/17
 * Time: 09:44
 */

namespace Manager\Controller;


use Common\Controller\AdminbaseController;

class ActiveController extends AdminbaseController
{
    private $model;
    public function _initialize() {
        parent::_initialize();
        $this->model = D('act');
    }
    //活动管理首页
    public function index(){
        $uid=sp_get_current_admin_id();
        $acts = $this->model->where(array('userid'=>$uid))->order('time desc')->select();

        $this->assign('acts', $acts);
        $this->display();
    }
    //活动管理
    public function act_manage(){
        $id = I('get.id');
        if (!empty($id)){
            $act = $this->model->where(array('id'=>$id))->find();
            $this->assign('act', $act);
            $this->display();
        } else {
            $this->redirect("U('index/index')",array(),1,'参数错误!');
        }
    }
    //活动管理列表
    public function act_lists(){
        $uid=sp_get_current_admin_id();
        $acts = $this->model->where(array('userid'=>$uid))->order('time desc')->select();
        $act_user = M('act_user');
        $nowtime = time();
        foreach($acts as $k => &$v){
            $v['count'] = $act_user->where(array('act_id'=>$v['id']))->count();
            $time = strtotime($v['starttime']);
            if ($time < $nowtime) {
                $v['status'] = '0';//报名结束
            } elseif ($v['count'] == $v['num']){
                $v['status'] = '1';//已报满
            } else {
                $v['status'] = '2';//报名中
            }
        }
        $this->assign('acts', $acts);
        $this->display();
    }
    //活动添加
    public function act_add(){
        $this->display();
    }
    //活动添加提交
    public function act_add_post(){
        $post = I('post.');
        $post['status'] = I('get.status', 1, 'intval');
        $post['userid'] = sp_get_current_admin_id();
        $post['time'] = time();
        $model = M('act');
        if ($model->create($post) !== false){
            $result=$model->add($post);
            if ($result){
                $info = array(
                    'code' => 200,
                    'info' => '保存成功！'
                );
            } else {
                $info = array(
                    'code' => 400,
                    'info' => '保存失败！'
                );
            }
        } else {
            $info = array(
                'code' => 500,
                'info' => $model->getError()
            );
        }
        $this->ajaxReturn($info);
    }
    //活动报名分享数据详情页
    public function act_manage_detail(){
        $id = I('get.id');
        $act = $this->model->where(array('id'=>$id))->find();
        $is_enter = M('act_user')->where(array('act_id'=>$id))->count();
		
        $config = [
            'debug'     => C('DEBUG'),
            'app_id'    => C('APP_ID'),
            'secret'    => C('SECRET'),
            'token'     => C('TOKEN'),
            'log' => C('LOG'),
            'oauth' => C('OAUTH'),
            // ..
        ];
        $app = new \EasyWeChat\Foundation\Application($config);
    
        $js = $app->js;
		$aa = $js->config(array('showAllNonBaseMenuItem','hideMenuItems','showMenuItems','onMenuShareTimeline','onMenuShareAppMessage', 'onMenuShareQQ', 'onMenuShareWeibo', 'onMenuShareQZone', 'menuItem:share:appMessage', 'menuItem:share:timeline', 'menuItem:share:qq', 'menuItem:share:weiboApp', 'menuItem:share:QZone'), true, false, false);
		$jsApiList = '';
		foreach($aa['jsApiList'] as $k=>$v){
			$jsApiList .= "'" . $v . "'" . ',';
		}
		$jsApiList = rtrim($jsApiList, ',');
		$this->assign('str', $aa);
		$this->assign('jsApiList', $jsApiList);
		
        $this->assign('data', $act);
        $this->assign('count', $is_enter);
        $this->display();
    }
    //报名列表
    public function enter_list(){
        $id = I('get.id');
        $lists = M('act_user')->alias('a')
                            ->join('__USERS__ as b on a.userid=b.id')
                            ->field('a.time,b.master_name,b.user_nicename,b.user_login')
                            ->where(array('act_id'=>$id))
                            ->order('time desc')
                            ->select();
        $this->assign('lists', $lists);
        $this->display();
    }
    //活动修改页面
    public function act_manage_edit(){
        $id = I('get.id');
        $act_model = M('act')->where(array('id'=>$id))->find();
        $this->assign('act', $act_model);
        $this->display();
    }
}