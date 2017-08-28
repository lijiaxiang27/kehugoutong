<?php
/**
 * 后台首页
 */
namespace Admin\Controller;

use Common\Controller\AdminbaseController;

class SupportController extends AdminbaseController {
	protected $support_model;
	public function _initialize() {
		parent::_initialize();
        $this->support_model = M('support');
	}
	//入校支持列表
    public function index() {
        $supports = M('support as a')->join('cmf_users as b on a.userid = b.id')->field('a.*,b.user_nicename')->order('time desc')->select();
        $this->assign('supports', $supports);
        $this->display();
    }

    //添加入校支持
    public function add() {
        if (IS_POST){
            $post = I('post.');
            $post['userid'] = sp_get_current_admin_id();
            $post['time'] = time();
            $post['status'] = 0;
            $rules = array(
                array('title','require','入校名称不能为空！',1,'regex',3),
                array('province','require','省份不能为空！',1,'regex',3),
                array('start','require','开始时间不能为空！',1,'regex',3),
                array('end','require','结束时间不能为空！',1,'regex',3),
                array('continue','require','支持天数不能为空！',1,'regex',3),
                array('content','require','支持内容不能为空！',1,'regex',3),
            );
            if ($this->support_model->validate($rules)->create($post)!==false) {
                if ($this->support_model->add()!==false) {
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
                    'info' => $this->support_model->getError(),
                );
                $this->ajaxReturn($rs);
            }
        }
    }

    //查看入校支持
    public function edit() {
        $id = I('get.id');
        $support = $this->support_model->where(array('id'=>$id))->find();
        if ($support['status'] == 0) {
            $post['status'] = 1;
            $this->support_model->where(array('id'=>$id))->save($post);
        }
        $user_nicename = M('users')->where(array('id'=>$support['userid']))->field('user_nicename')->find();
        //评价
        $arr = unserialize($support['judge']);
        $tip=array('','1.0','2.0','3.0','4.0','5.0');
        $tip2=array('','差','一般','中等','良','优秀');
        foreach($arr as $k=>$v){
            $tips[$k] = $tip[$v];
            $tip2s1[$k] = $tip2[$v];
        }
        $this->assign('tips', $tips);
        $this->assign('tip2s', $tip2s1);
        $this->assign($support);
        $this->assign($user_nicename);
        $this->display();
    }
    //审核通过
    public function edit_post() {
        if (IS_POST) {
            $post['id'] = I('post.id');
            $post['status'] = 2;
            $post['passtime'] = time();
            if ($this->support_model->create($post)!==false) {
                if ($this->support_model->save()!==false) {
                    $this->success("审核通过！", U("Support/index"));
                } else {
                    $this->error("审核失败！");
                }
            } else {
                $this->error($this->support_model->getError());
            }
        }

    }
    //删除
    public function delete() {
        $id = I('get.id');
        if ($this->support_model->delete($id)!==false) {
            $this->success("删除成功！");
        } else {
            $this->error("删除失败！");
        }
    }
}

