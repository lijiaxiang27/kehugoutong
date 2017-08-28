<?php
/**
 * 后台首页
 */
namespace Admin\Controller;

use Common\Controller\AdminbaseController;

class DesignController extends AdminbaseController {
	protected $design_model;
	public function _initialize() {
		parent::_initialize();
        $this->design_model = M('design');
	}
	//设计申请列表
    public function index() {
        $designs = M('design as a')->join('cmf_users as b on a.userid = b.id')->field('a.*,b.user_nicename')->order('time desc')->select();
        $this->assign('designs', $designs);
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
                array('title','require','入校名称不能为空！',1,'regex',3),
                array('person','require','联系人不能为空！',1,'regex',3),
                array('mobile','require','联系电话不能为空！',1,'regex',3),
                array('content','require','申请内容不能为空！',1,'regex',3),
                array('demand','require','设计要求不能为空！',1,'regex',3),
                array('is_send','require','文案是否发送不能为空！',1,'regex',3),
            );
            if ($this->design_model->validate($rules)->create($post)!==false) {
                if ($this->design_model->add()!==false) {
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
                    'info' => $this->design_model->getError(),
                );
                $this->ajaxReturn($rs);
            }
        }
    }

    //查看设计申请
    public function edit() {
        $id = I('get.id');
        $design = $this->design_model->where(array('id'=>$id))->find();
        if ($design['status'] == 0) {
            $post['status'] = 1;
            $this->design_model->where(array('id'=>$id))->save($post);
        }
        $user_nicename = M('users')->where(array('id'=>$design['userid']))->field('user_nicename')->find();
        //评价
        $arr = unserialize($design['judge']);
        $tip=array('','1.0','2.0','3.0','4.0','5.0');
        $tip2=array('','差','一般','中等','良','优秀');
        foreach($arr as $k=>$v){
            $tips[$k] = $tip[$v];
            $tip2s1[$k] = $tip2[$v];
        }
        $this->assign('tips', $tips);
        $this->assign('tip2s', $tip2s1);
        $this->assign($design);
        $this->assign($user_nicename);
        $this->display();
    }
    //编辑提交
    public function edit_post() {
        if (IS_POST) {
            $post['id'] = I('post.id');
            $post['status'] = 2;
            $post['passtime'] = time();
            if ($this->design_model->create($post)!==false) {
                if ($this->design_model->save()!==false) {
                    $this->success("审核通过！", U("Lecture/index"));
                } else {
                    $this->error("审核失败！");
                }
            } else {
                $this->error($this->design_model->getError());
            }
        }

    }
    //删除
    public function delete() {
        $id = I('get.id');
        if ($this->design_model->delete($id)!==false) {
            $this->success("删除成功！");
        } else {
            $this->error("删除失败！");
        }
    }
}

