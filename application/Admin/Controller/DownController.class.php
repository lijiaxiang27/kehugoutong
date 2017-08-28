<?php
/**
 * 后台首页
 */
namespace Admin\Controller;

use Common\Controller\AdminbaseController;

class DownController extends AdminbaseController {
	protected $down_model;
	public function _initialize() {
		parent::_initialize();
        $this->down_model = M('material');
	}
	//运营资料列表
    public function yy_index() {
        $id = I('get.id');

        $count=$this->down_model->where(array("typeid"=>$id))->count();
        $page = $this->page($count, 20);
        $yy_data = $this->down_model->where(array("typeid"=>$id))->order(array("time"=>"DESC"))->limit($page->firstRow . ',' . $page->listRows)->select();
        $this->assign("page", $page->show('Admin'));
        $this->assign("yy_data", $yy_data);
        $this->assign('id', $id);

        $this->display();
    }
    //市场方案资料列表
    public function sc_index() {
        $id = I('get.id');

        $count=$this->down_model->where(array("typeid"=>$id))->count();
        $page = $this->page($count, 20);
        $yy_data = $this->down_model->where(array("typeid"=>$id))->order(array("time"=>"DESC"))->limit($page->firstRow . ',' . $page->listRows)->select();
        $this->assign("page", $page->show('Admin'));
        $this->assign("yy_data", $yy_data);
        $this->assign('id', $id);

        $this->display();
    }
    //培训资料列表
    public function px_index() {
        $id = I('get.id');

        $count=$this->down_model->where(array("typeid"=>$id))->count();
        $page = $this->page($count, 20);
        $yy_data = $this->down_model->where(array("typeid"=>$id))->order(array("time"=>"DESC"))->limit($page->firstRow . ',' . $page->listRows)->select();
        $this->assign("page", $page->show('Admin'));
        $this->assign("yy_data", $yy_data);
        $this->assign('id', $id);

        $this->display();
    }
    //其他资料列表
    public function qt_index() {
        $id = I('get.id');

        $count=$this->down_model->where(array("typeid"=>$id))->count();
        $page = $this->page($count, 20);
        $yy_data = $this->down_model->where(array("typeid"=>$id))->order(array("time"=>"DESC"))->limit($page->firstRow . ',' . $page->listRows)->select();
        $this->assign("page", $page->show('Admin'));
        $this->assign("yy_data", $yy_data);
        $this->assign('id', $id);

        $this->display();
    }
    //添加资料
    public function add() {
        $id = I('get.id');
        $this->assign('id', $id);

        $doctypes = M('doctype')->select();
        $this->assign('doctypes', $doctypes);
        $this->display();
    }
    //编辑资料
    public function edit() {
        $id = I('get.id');
        $data = $this->down_model->where(array('id'=>$id))->find();
        $this->assign('data', $data);
        $doctypes = M('doctype')->select();
        $this->assign('doctypes', $doctypes);
        $this->display();
    }
    //编辑资料提交
    public function edit_post() {
        $post = I('post.');
        if ($this->down_model->create($post)!==false) {
            if ($this->down_model->save()!==false) {
                switch ($post['typeid']){
                    case 1:
                        $this->success("编辑成功！", U("Down/yy_index",array('id'=>$post['typeid'])));
                        break;
                    case 2:
                        $this->success("编辑成功！", U("Down/sc_index",array('id'=>$post['typeid'])));
                        break;
                    case 3:
                        $this->success("编辑成功！", U("Down/px_index",array('id'=>$post['typeid'])));
                        break;
                    case 4:
                        $this->success("编辑成功！", U("Down/qt_index",array('id'=>$post['typeid'])));
                        break;
                }

            } else {
                $this->error("编辑失败！");
            }
        } else {
            $this->error($this->down_model->getError());
        }
    }
    //添加资料提交
    public function add_post() {
        $post = I('post.');
        $post['time'] = time();
        $post['upid'] = sp_get_current_admin_id();
        if ($this->down_model->create($post)!==false) {
            if ($this->down_model->add()!==false) {
                switch ($post['typeid']){
                    case 1:
                        $this->success("添加成功！", U("Down/yy_index",array('id'=>$post['typeid'])));
                        break;
                    case 2:
                        $this->success("添加成功！", U("Down/sc_index",array('id'=>$post['typeid'])));
                        break;
                    case 3:
                        $this->success("添加成功！", U("Down/px_index",array('id'=>$post['typeid'])));
                        break;
                    case 4:
                        $this->success("添加成功！", U("Down/qt_index",array('id'=>$post['typeid'])));
                        break;
                }

            } else {
                $this->error("添加失败！");
            }
        } else {
            $this->error($this->down_model->getError());
        }
    }
    // 删除资料
    public function delete(){
        $id=I("get.id",0,'intval');
        $post = $this->down_model->where(array('id'=>$id))->field('typeid')->find();
        $result=$this->down_model->where(array("id"=>$id))->delete();
        if($result!==false){
            switch ($post['typeid']){
                case 1:
                    $this->success("删除成功！", U("Down/yy_index",array('id'=>$post['typeid'])));
                    break;
                case 2:
                    $this->success("删除成功！", U("Down/sc_index",array('id'=>$post['typeid'])));
                    break;
                case 3:
                    $this->success("删除成功！", U("Down/px_index",array('id'=>$post['typeid'])));
                    break;
                case 4:
                    $this->success("删除成功！", U("Down/qt_index",array('id'=>$post['typeid'])));
                    break;
            }
        }else{
            $this->error('删除失败！');
        }
    }
}

