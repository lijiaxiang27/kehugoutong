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
//    投诉建议详情页
    public function detail(){

        if(IS_GET){
            $get = I('get.');
            if ($get['type']=='投诉'){
                $db = M('complain');
                $file = M('complain_file') -> where('complain_id = '.$get['id']) -> select();
            }else{
                $db = M('adv');
                $file = M('adv_file') -> where('complain_id = '.$get['id']) -> select();
            }

            $data = $db -> find($get['id']);
            $data['u_name'] = sp_get_master_name($data['userid']);
            $data['s_name'] = sp_get_school_name($data['userid']);
            $data['type']   = $get['type'];
            if ($data['reply']!=''){
                $manager = M('users')-> field('user_nicename') -> where('id='.$data['reuser']) -> find();
                $data['manager']=$manager['user_nicename'];
            }

            $this -> assign('file',$file);
            $this -> assign('data',$data);
            $this -> display();
        }

        if(IS_POST){
            $data = I('post.');
            $data['reply'] = trim($data['reply']);
            $data['reuser'] = sp_get_current_admin_id();
            $data['status'] = 2;
            if ($data['type']=='投诉'){
                $db = M('complain');
            }else{
                $db = M('adv');
            }

            unset($data['type']);
            if($db -> save($data))
            {
                $msg['code'] = 200;
                $msg['info'] = '回复成功';
                $this -> ajaxReturn($msg);
            }else{
                $msg['code'] = 400;
                $msg['info'] = '回复失败';
                $this -> ajaxReturn($msg);
            }

        }

    }
}