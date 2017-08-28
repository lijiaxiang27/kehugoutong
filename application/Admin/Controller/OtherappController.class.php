<?php
/**
 * 其他申请
 */
namespace Admin\Controller;

use Common\Controller\AdminbaseController;

class OtherappController extends AdminbaseController {
	protected $otherapp_model;
	public function _initialize() {
		parent::_initialize();
        $this->otherapp_model = M('OtherApp');
	}
	//其它申请列表
    public function index() {
        $otherapps = M('other_app as a')->join('cmf_users as b on a.userid = b.id')->field('a.*,b.user_nicename')->order('time desc')->select();
        $this->assign('otherapps', $otherapps);
        $this->display();
    }

    //申请设计
    public function add() {
        if (IS_POST){
            $post = I('post.');
            $post['userid'] = sp_get_current_admin_id();
            $post['time'] = time();
            $post['status'] = 0;
            $rules = array(
                array('starttime','require','开始时间不能为空！',1,'regex',3),
                array('endtime','require','结束时间不能为空！',1,'regex',3),
                array('content','require','申请内容不能为空！',1,'regex',3),
            );
            if ($this->otherapp_model->validate($rules)->create($post)!==false) {
                if ($this->otherapp_model->add()!==false) {
                    $rs = array(
                        'code' => 1,
                        'info' => U('Headmaster/Public/success'),
                    );
                    $this->ajaxReturn($rs);
                } else {
                    $rs = array(
                        'code' => 0,
                        'info' => "提交失败!",
                    );
                    $this->ajaxReturn($rs);
                }
            } else {
                $rs = array(
                    'code' => 0,
                    'info' => $this->otherapp_model->getError(),
                );
                $this->ajaxReturn($rs);
            }
        }
    }

    //查看设计申请
    public function edit() {
        $id = I('get.id');
        $otherapp = $this->otherapp_model->where(array('id'=>$id))->find();
        if ($otherapp['status'] == 0) {
            $post['status'] = 1;
            $this->otherapp_model->where(array('id'=>$id))->save($post);
        }
        $user_nicename = M('users')->where(array('id'=>$otherapp['userid']))->field('user_nicename')->find();
        //评价
        $arr = unserialize($otherapp['judge']);
        $tip=array('','1.0','2.0','3.0','4.0','5.0');
        $tip2=array('','差','一般','中等','良','优秀');
        foreach($arr as $k=>$v){
            $tips[$k] = $tip[$v];
            $tip2s1[$k] = $tip2[$v];
        }
        $this->assign('tips', $tips);
        $this->assign('tip2s', $tip2s1);
        $this->assign($otherapp);
        $this->assign($user_nicename);
        $this->display();
    }
    //编辑提交
    public function edit_post() {
        if (IS_POST) {
            $post['id'] = I('post.id');
            $post['status'] = 2;
            $post['passtime'] = time();
            if ($this->otherapp_model->create($post)!==false) {
                if ($this->otherapp_model->save()!==false) {
                    $this->success("审核通过！", U("otherapp/index"));
                } else {
                    $this->error("审核失败！");
                }
            } else {
                $this->error($this->otherapp_model->getError());
            }
        }

    }
    //删除
    public function delete() {
        $id = I('get.id');
        if ($this->otherapp_model->delete($id)!==false) {
            $this->success("删除成功！");
        } else {
            $this->error("删除失败！");
        }
    }
}

