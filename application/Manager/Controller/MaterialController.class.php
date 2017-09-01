<?php
/**
 * 资料更新
 */

namespace Manager\Controller;


use Common\Controller\AdminbaseController;

class MaterialController extends AdminbaseController
{
    public function _initialize()
    {
        parent::_initialize();
    }
//    资料更新首页
    public function index(){
        $type_id = I('get.type',0);
        if ($type_id){
            $data = M('material as a')->join('cmf_doctype as b on a.doctype = b.id')
                ->where(array('typeid'=>$type_id))->field('a.id,a.title,a.content,a.pwd,a.time,b.icon')
                ->order('time desc')
                ->select();
            $this->assign('tag','one');
            if ($type_id == 1){
                $this->assign('yy_data', $data);
            } elseif ($type_id == 2){
                $this->assign('sc_data', $data);
            } elseif ($type_id == 3){
                $this->assign('px_data', $data);
            } elseif ($type_id == 4){
                $this->assign('qt_data', $data);
            }
        } else {
            //        运营资料
            $yy_data = M('material as a')->join('cmf_doctype as b on a.doctype = b.id')
                ->where(array('typeid'=>1))->field('a.id,a.title,a.content,a.pwd,a.time,b.icon')
                ->limit(2)
                ->order('time desc')
                ->select();
            //      市场方案
            $sc_data = M('material as a')->join('cmf_doctype as b on a.doctype = b.id')
                ->where(array('typeid'=>2))->field('a.id,a.title,a.content,a.pwd,a.time,b.icon')
                ->limit(2)
                ->order('time desc')
                ->select();
            //        培训资料
            $px_data = M('material as a')->join('cmf_doctype as b on a.doctype = b.id')
                ->where(array('typeid'=>3))->field('a.id,a.title,a.content,a.pwd,a.time,b.icon')
                ->limit(2)
                ->order('time desc')
                ->select();
            //        其他资料
            $qt_data = M('material as a')->join('cmf_doctype as b on a.doctype = b.id')
                ->where(array('typeid'=>4))->field('a.id,a.title,a.content,a.pwd,a.time,b.icon')
                ->limit(2)
                ->order('time desc')
                ->select();
            $this->assign('yy_data', $yy_data);
            $this->assign('sc_data', $sc_data);
            $this->assign('px_data', $px_data);
            $this->assign('qt_data', $qt_data);
            $this->assign('tag','all');
        }

        $this->display();
    }

    /**
     * Effect :  show view 资料添加
     *@assign :   array $file_type = 全部文件类型
     */
    public function add_material(){
        //获取信息
        $file_type = $this -> _get_file_type();
            $this -> assign('file_type',$file_type);
        $this->  display();
    }

    /**
     * Effect : 资料添加动作
     * return : json
     */
    public function add_material_post(){
        $data = I('post.');
        $data['time'] = time();
        if(M('material') -> add($data)){
            $msg['code'] = 200;
            $msg['info'] = '添加成功';
            $this -> ajaxReturn($msg);
        }else{
            $msg['code'] = 400;
            $msg['info'] = '添加失败';
            $this -> ajaxReturn($msg);
        }

    }

    /**
     * Effect  : show view 资料更新
     * $assign : array 原数据
     */
    public function edit_material(){
        $id   = I('get.id');
        $file_type = $this -> _get_file_type();
        $data = M('material') -> where('id = '.$id) -> find();

        $this -> assign('file_type',$file_type);
        $this -> assign('data',$data);
        $this -> display();
    }

    /**
     * Effect : 资料修改动作
     * @return  json
     */
    public function edit_material_post(){
        $data = I('post.');
        if (!isset($data['id'])&&empty($data['id'])){
            $msg['code'] = 404;
            $msg['info'] = '未提交当前文件ID';
            $this -> ajaxReturn($msg);
        }
        if(M('material') -> save($data)){
            $msg['code'] = 200;
            $msg['info'] = '修改成功';
            $this -> ajaxReturn($msg);
        }else{
            $msg['code'] = 400;
            $msg['info'] = '修改失败';
            $this -> ajaxReturn($msg);
        }

    }

    /**
     * Effect : 资料删除动作
     * @return  Json
     */
    public function delete_material(){
        $id = I('get.id');
        if(M('material') -> delete($id)){
            $msg['code'] = 200;
            $msg['info'] = '删除成功';
            $this -> ajaxReturn($msg);
        }else{
            $msg['code'] = 400;
            $msg['info'] = '删除失败';
            $this -> ajaxReturn($msg);
        }

    }

    /**
     * Effect  : 获取全部文件类型
     * @return : array
     */
    private function _get_file_type()
    {
        return M('doctype') -> field('icon',true) ->  select();
    }


}
