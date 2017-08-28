<?php
/**
 * Created by PhpStorm.
 * User: tester
 * Date: 17/7/19
 * Time: 14:42
 */

namespace Manager\Controller;


use Common\Controller\AdminbaseController;

class SchoolController extends AdminbaseController
{
    public function _initialize() {
        parent::_initialize();
    }
//    校区列表
    public function index(){
        $uid=sp_get_current_admin_id();
        $role_id = M('role_user')->field('role_id')->where(array('user_id'=>$uid))->find();
        switch ($role_id['role_id']){
            case '5':
                $role = 'pid_qy';
                break;
            case '6':
                $role = 'pid_gj';
                break;
            case '7';
                $role = 'pid_sc';
                break;
            case '8';
                $role = 'pid_zx';
                break;
            case '3';
                $role = 'pid_jg';
                break;
            default:
                $role = 'pid_gj';
                break;
        }
        $schools = M('users')->field('id,master_name,user_nicename,user_login')->order('id desc')->where(array($role=>$uid))->select();
        $this->assign('schools', $schools);
        $this->display();
    }
//    新增校区
    public function add_school(){

        $this->display();
    }
}