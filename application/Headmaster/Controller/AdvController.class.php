<?php
/**
 * 建议
 */
namespace Headmaster\Controller;

use Common\Controller\AdminbaseController;

class AdvController extends AdminbaseController {
	public function _initialize() {
		parent::_initialize();
	}
	//建议表单页面
    public function index() {
       	$this->display();
    }
    //单个投诉建议详情
    public function adv_detail() {
        $id = I('get.id');
        $adv = M('adv')->where(array('id'=>$id))->find();
        $files = M('adv_file')->where(array('adv_id'=>$id))->select();
        foreach($files as $k=>&$v) {
            $v['size'] = $this->sizecount($v['size']);
        }
        $this->assign('adv', $adv);
        $this->assign('files', $files);
        $this->display();
    }
    //提交成功
    public function csuccess() {
        $time = time();
        $this->assign('time', $time);
        $this->display();
    }
    //附件大小单位转换
    function sizecount($filesize) {
        if($filesize >= 1073741824) {
            $filesize = round($filesize / 1073741824 * 100) / 100 . ' gb';
        } elseif($filesize >= 1048576) {
            $filesize = round($filesize / 1048576 * 100) / 100 . ' mb';
        } elseif($filesize >= 1024) {
            $filesize = round($filesize / 1024 * 100) / 100 . ' kb';
        } else {
            $filesize = $filesize . ' bytes';
        }
        return $filesize;
    }
    //评价
    public function pingjia() {
        $data= I('post.');
        $post['status'] = 3;
        $post['id'] = $data['id'];
        $post['judge_time'] = time();
        $post['judge'] = serialize($data['score']);
        M('adv')->create($post);
        $res = M('adv')->save();
    }
}

