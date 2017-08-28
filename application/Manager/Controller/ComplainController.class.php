<?php
/**
 * Created by PhpStorm.
 * User: tester
 * Date: 17/7/20
 * Time: 14:04
 */

namespace Manager\Controller;


use Common\Controller\AdminbaseController;

class ComplainController extends AdminbaseController
{
    protected $complain_model;
    public function _initialize()
    {
        parent::_initialize();
        $this->complain_model = D('complain');
        $this->adv_model = D('adv');
    }
//    投诉建议首页
    public function index(){
        $post = I('get.status');
        if ($post == 1){
            $where['status'] = array('elt', 1);
        } elseif($post == 2) {
            $where['status'] = array('gt', 1);
        } else {

        }
        $user_model = A('Index','Controller');
        $sub_ids = $user_model->get_schools();
        $where['userid'] = array('IN', "$sub_ids");
        $complains = $this->complain_model->where($where)->order('id desc')->select();
        $advs = $this->adv_model->where($where)->order('id desc')->select();

        $arr = array_merge($complains, $advs);
        $i = 0;
        foreach($arr as $k => $v){
            if($v['status'] <= 1){
                $i++;
            }
        }
        $this->assign('num', $i);
        $this->assign('arr', $arr);
        $this->display();
    }
}