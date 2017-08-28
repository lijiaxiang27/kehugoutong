<?php
/**
 * 后台首页
 */
namespace Admin\Controller;

use Common\Controller\AdminbaseController;

class LectureController extends AdminbaseController {
	protected $lecture_model;
	public function _initialize() {
		parent::_initialize();
        $this->lecture_model = M('lecture');
	}
	//家庭讲座列表
    public function index() {
        $lectures = M('lecture as a')->join('cmf_users as b on a.userid = b.id')->field('a.*,b.user_nicename')->order('time desc')->select();
        $this->assign('lectures', $lectures);
        $this->display();
    }

    //申请家庭讲座
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
                array('province','require','所在地区不能为空！',1,'regex',3),
                array('start','require','讲座时间不能为空！',1,'regex',3),
                array('num','require','参会人数不能为空！',1,'regex',3),
            );
            if ($this->lecture_model->validate($rules)->create($post)!==false) {
                if ($this->lecture_model->add()!==false) {
                    $url = U('Headmaster/user/user_apply');
                    $rs = array(
                        'code' => 1,
                        'info' => U('Headmaster/Public/success', array('msg'=>'投诉建议','url'=>$url)),
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
                    'info' => $this->lecture_model->getError(),
                );
                $this->ajaxReturn($rs);
            }
        }
    }

    //查看家庭讲座
    public function edit() {
        $id = I('get.id');
        $lecture = $this->lecture_model->where(array('id'=>$id))->find();
        if ($lecture['status'] == 0){
            $post['status'] = 1;
            $this->lecture_model->where(array('id'=>$id))->save($post);
        }
        $user_nicename = M('users')->where(array('id'=>$lecture['userid']))->field('user_nicename')->find();
        //评价
        $arr = unserialize($lecture['judge']);
        $tip=array('','1.0','2.0','3.0','4.0','5.0');
        $tip2=array('','差','一般','中等','良','优秀');
        foreach($arr as $k=>$v){
            $tips[$k] = $tip[$v];
            $tip2s1[$k] = $tip2[$v];
        }
        $this->assign('tips', $tips);
        $this->assign('tip2s', $tip2s1);
        $this->assign($lecture);
        $this->assign($user_nicename);
        $this->display();
    }
    //编辑提交
    public function edit_post() {
        if (IS_POST) {
            $post['id'] = I('post.id');
            $post['status'] = 2;
            $post['passtime'] = time();
            if ($this->lecture_model->create($post)!==false) {
                if ($this->lecture_model->save()!==false) {
                    $this->success("审核通过！", U("Lecture/index"));
                } else {
                    $this->error("审核失败！");
                }
            } else {
                $this->error($this->lecture_model->getError());
            }
        }

    }
    //删除
    public function delete() {
        $id = I('get.id');
        if ($this->lecture_model->delete($id)!==false) {
            $this->success("删除成功！");
        } else {
            $this->error("删除失败！");
        }
    }
}

