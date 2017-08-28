<?php
/**
 * 最新活动
 */
namespace Headmaster\Controller;

use Common\Controller\AdminbaseController;

class ActController extends AdminbaseController {
	public function _initialize() {
		parent::_initialize();
	}
    //活动详情页
    public function detail() {
        $id = I('get.id');
        //pv加1
        D('act')->where(array('id'=>$id))->setInc('pv');
        $userid = sp_get_current_admin_id();
        $act = M('act')->where(array('id'=>$id))->find();
        $rs = M('act_user')->where(array('act_id'=>$act['id'],'userid'=>$userid))->find();
		$nowtime = time();
        if ($nowtime > strtotime($act['endtime'] . " 23:59:59")) {
            $act['isover'] = 1;
        } else {
            $act['isover'] = 0;
        }
        if ($rs) {
            $act['isbm'] = 1;
        } else {
            $act['isbm'] = 0;
        }
        $enter = M('act_user')->where(array('act_id'=>$id))->select();
        $already_bm = 0;
        foreach($enter as $k=>$v){
            $already_bm += $v['num'];
        }
        if ($already_bm >= $act['num']) {
            $act['isfull'] = 1;
        } else {
            $act['isfull'] = 0;
        }
        $this->assign('enter', $already_bm);
        $this->assign('act', $act);
        $this->display();
    }
    //报名
    public function attend() {
        $where = I('post.');
        $count_arr = M('act_user')->where(array('act_id'=>$where['act_id']))->select();
        $count = $where['num'];
        foreach ($count_arr as $key => $value) {
            $count += $value['num'];
        }
        $sum = M('act')->where(array('id'=>$where['act_id']))->field('num')->find();
        if ($count < $sum['num']) {
            $where['userid'] = sp_get_current_admin_id();
            $rs = M('act_user')->where($where)->find();
            if ($rs) {
                $msg = array(
                    'code' => 0,
                    'info' => '不能重复报名!',
                );
            } else {
                $where['time'] = time();
                if (M('act_user')->create($where)!==false) {
                    if (M('act_user')->add($where)!==false) {
                        $msg = array(
                            'code' => 1,
                            'info' => '报名成功!',
                        );
                    } else {
                        $msg = array(
                            'code' => 0,
                            'info' => '报名失败!',
                        );
                    }
                } else {
                    $msg = array(
                        'code' => 0,
                        'info' => M('act_user')->getError(),
                    );
                }
            }
        } else {
            $remain = $sum['num'] - $count + $where['num'];
            if ($remain == 0) {
                $info = "人数已满！";
            } else {
                $info = "当前最多可保".$remain."人！";
            }
            $msg = array(
                'code' => 0,
                'info' => $info,
            );
        }
        $this->ajaxReturn($msg);
    }

}

