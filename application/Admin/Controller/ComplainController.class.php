<?php
/**
 * 投诉
 */
namespace Admin\Controller;

use Common\Controller\AdminbaseController;

class ComplainController extends AdminbaseController {
	protected $complain_model;
	public function _initialize() {
		parent::_initialize();
        $this->complain_model = M('complain');
	}
	//投诉建议表
    public function index() {
        $complains = M('complain as a')->join('cmf_users as b on a.userid = b.id')
                                    ->join('cmf_users as c on b.pid_gj = c.id')
                                    ->field('a.*,b.user_nicename,c.user_nicename as yyjl')
                                    ->order('time desc')
                                    ->select();
        $this->assign('complains', $complains);
        $this->display();
    }
    //查看详情
    public function edit() {
        $id = I('get.id');

        $complain = M('complain as a')->join('cmf_users as b on a.userid = b.id')
                                    ->join('cmf_users as c on b.pid_gj = c.id')
                                    ->field('a.*,b.user_nicename,c.user_nicename as yyjl')
                                    ->order('a.time desc')
                                    ->where(array('a.id'=>$id))
                                    ->find();
        if ($complain['status'] == 0) {
            $post['status'] = 1;
            $this->complain_model->where(array('id'=>$id))->save($post);
        }
        $files = M('complain_file')->where(array('complain_id'=>$id))->select();
        //评价
        $arr = unserialize($complain['judge']);
        $tip=array('','1.0','2.0','3.0','4.0','5.0');
        $tip2=array('','差','一般','中等','良','优秀');
        foreach($arr as $k=>$v){
            $tips[$k] = $tip[$v];
            $tip2s1[$k] = $tip2[$v];
        }
        $this->assign('tips', $tips);
        $this->assign('tip2s', $tip2s1);
        $this->assign($complain);
        $this->assign('files', $files);
        $this->display();
    }
    //下载附件
    public function download()
    {
        $id = I('get.id');
        $model = M('complain_file');
        $rst = $model->find($id);
        $file = $rst['file'];
        $filename = $rst['name'];
        header("Content-Type:application/octet-stream");
        header('Content-Disposition:attachment; filename="' . $filename . '"');
        header("Content-Length:" . filesize($file));
        readfile($file);
    }

    //投诉提交
    public function add() {

        if (IS_POST){
            $post = I('post.');
            $post['userid'] = sp_get_current_admin_id();
            $post['time'] = time();
            $post['status'] = 0;
            if ($this->complain_model->create($post)!==false) {
                if ($complain_id = $this->complain_model->add()) {
                    $this->deal_pics($complain_id);
                    $url = U('Headmaster/complain/csuccess');
                    Header("Location: $url");
                    exit;
                } else {
                    echo "<script>alert('提交失败!');window.history.back();</script>";
                    exit;
                }
            } else {
                $this->error($this->complain_model->getError());
            }
        }
    }
    /*
     * 附件上传
     */
    private function deal_pics($complain_id)
    {
        //做判断，至少需要选中一个附件
        $havePics = false;
        foreach ($_FILES['file']['error'] as $v) {
            if ($v === 0){
                $havePics = true;
                break;
            }
        }
        //至少选择一个附件，才做上传处理
        if ($havePics === true) {
            //批量上传多个附件的处理
            $up = new \Think\Upload();
            $up -> rootPath = "./data/upload/complain/";
            $z = $up -> upload(array($_FILES['file']));
            foreach ($z as $k => $v) {
                $nowpic = $up -> rootPath.$v['savepath'].$v['savename'];
                //存入数据库
                $info['complain_id'] = $complain_id;
                $info['file'] = $nowpic;
                $info['name'] = $v['name'];
                $info['size'] = $v['size'];
                M('complain_file') -> add($info);
            }
        }
    }

    //编辑提交
    public function edit_post() {
        if (IS_POST) {
            $post['id'] = I('post.id');
            $post['status'] = 2;
            $post['solvetime'] = time();
            if ($this->complain_model->create($post)!==false) {
                if ($this->complain_model->save()!==false) {
                    $this->success("状态修改成功！", U("Complain/index"));
                } else {
                    $this->error("状态修改失败！");
                }
            } else {
                $this->error($this->complain_model->getError());
            }
        }

    }
    //删除
    public function delete() {
        $id = I('get.id');
        if ($this->complain_model->delete($id)!==false) {
            $this->success("删除成功！");
        } else {
            $this->error("删除失败！");
        }
    }

}

