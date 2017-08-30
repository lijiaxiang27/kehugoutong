<?php
/**
 * 产品服务
 */
namespace Headmaster\Controller;

use Common\Controller\AdminbaseController;

class ProductController extends AdminbaseController {
	public function _initialize() {
		parent::_initialize();
        $this->userid = sp_get_current_admin_id();
	}
    public function aotupad(){
        //查询运营经理信息
        $yyjl = M('users')->where(array('id'=>$this->userid))->field('pid_gj,pid_jg,pid_zx,pid_sc')->find();
        $gjjl_info = M('users')->field('user_nicename,user_login,pid_gj,pid_jg,pid_zx,pid_sc')->where(array('id'=>$yyjl['pid_gj']))->find();
        $jgjl_info = M('users')->field('user_nicename,user_login,pid_gj,pid_jg,pid_zx,pid_sc')->where(array('id'=>$yyjl['pid_jg']))->find();
        $zxjl_info = M('users')->field('user_nicename,user_login,pid_gj,pid_jg,pid_zx,pid_sc')->where(array('id'=>$yyjl['pid_zx']))->find();
        $scjl_info = M('users')->field('user_nicename,user_login,pid_gj,pid_jg,pid_zx,pid_sc')->where(array('id'=>$yyjl['pid_sc']))->find();


        //查询运营经理职位 名称
        $roleid = M('role_user')->where(array('user_id'=>$yyjl['pid_gj']))->field('role_id')->find();
        $gj_rolename = M('role')->where(array('id'=>$roleid['role_id']))->field('name')->find();

        $roleid = M('role_user')->where(array('user_id'=>$yyjl['pid_jg']))->field('role_id')->find();
        $jg_rolename = M('role')->where(array('id'=>$roleid['role_id']))->field('name')->find();

        $roleid = M('role_user')->where(array('user_id'=>$yyjl['pid_zx']))->field('role_id')->find();
        $zx_rolename = M('role')->where(array('id'=>$roleid['role_id']))->field('name')->find();

        $roleid = M('role_user')->where(array('user_id'=>$yyjl['pid_sc']))->field('role_id')->find();
        $sc_rolename = M('role')->where(array('id'=>$roleid['role_id']))->field('name')->find();

//        dump($gjjl_info);
//        dump($jgjl_info);
//        dump($zxjl_info);
//        dump($scjl_info);
//        dump($gj_rolename);
//        die;
        $this->assign('gjjl', $gjjl_info);
        $this->assign('jgjl', $jgjl_info);
        $this->assign('zxjl', $zxjl_info);
        $this->assign('scjl', $scjl_info);

        $this->assign('gj_rolename', $gj_rolename['name']);
        $this->assign('jg_rolename', $jg_rolename['name']);
        $this->assign('zx_rolename', $zx_rolename['name']);
        $this->assign('sc_rolename', $sc_rolename['name']);
        $this->display();
    }

}

