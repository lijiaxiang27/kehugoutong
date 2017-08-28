<?php
/**
 * 活动管理
 */
namespace Admin\Controller;

use Common\Controller\AdminbaseController;

class ActController extends AdminbaseController {
	protected $act_model;
	public function _initialize() {
		parent::_initialize();
        $this->act_model = M('act');
	}
	//活动列表
    public function index() {
        $count=$this->act_model->count();

        $page = $this->page($count, 20);
        $acts = M('act as a')->join('cmf_users as b on a.userid=b.id')
                            ->field('a.*,b.user_nicename as username')
                            ->limit($page->firstRow , $page->listRows)
                            ->select();
        foreach ($acts as $k=>$v) {
            $sum = 0;
            $num_every = M('act_user')->where(array('act_id'=>$v['id']))->select();
            foreach ($num_every as $key => $value) {
                $sum += $value['num'];
            }
            $acts[$k]['sum'] = $sum;
        }
        $this->assign('acts', $acts);
        $this->assign("page", $page->show('Admin'));
        $this->display();
    }
    //活动报名人详情
    public function detail(){
        $id = I('get.id');
        $members = M('act_user as a')->join('cmf_users as b on a.userid = b.id')
                                    ->where(array('a.act_id'=>$id))
                                    ->field('b.user_nicename,b.user_login,a.time,a.num,a.comments,b.master_name')
                                    ->select();
        $this->assign('members', $members);
		$this->assign('id', $id);
        $this->display();
    }
    //添加活动
    public function add() {

        $this->display();
    }
    //添加活动提交
    public function add_post() {
        $post = I('post.');
        $post['time'] = time();
        $post['userid'] = sp_get_current_admin_id();
        $post['content'] = htmlspecialchars_decode($post['content']);
        if ($this->act_model->create($post)!==false) {
            if ($this->act_model->add()!==false) {
                $this->success("添加成功！", U("act/index"));
            } else {
                $this->error("添加失败！");
            }
        } else {
            $this->error($this->act_model->getError());
        }
    }
    //编辑活动
    public function edit() {
        $id = I('get.id');
        $act = $this->act_model->where(array('id'=>$id))->find();
        $this->assign('act', $act);
        $this->display();
    }
    //编辑提交
    public function edit_post() {
        if (IS_POST) {
            $post = I('post.');
            $post['content'] = htmlspecialchars_decode($post['content']);
            if ($this->act_model->create($post)!==false) {
                if ($this->act_model->save()!==false) {
                    $this->success("编辑成功！", U("act/index"));
                } else {
                    $this->error("编辑失败！");
                }
            } else {
                $this->error($this->act_model->getError());
            }
        }

    }
    //删除
    public function delete() {
        $id = I('get.id');
        if ($this->act_model->delete($id)!==false) {
            $this->success("删除成功！");
        } else {
            $this->error("删除失败！");
        }
    }
	
	//导出excel
    public function exportExcel($expTitle,$expCellName,$expTableData){
        $xlsTitle = iconv('utf-8', 'gb2312', $expTitle);//文件名称
        $fileName = $_SESSION['account'].date('_YmdHis');//or $xlsTitle 文件名称可根据自己情况设定
        $cellNum = count($expCellName);
        $dataNum = count($expTableData);
        vendor("PHPExcel.PHPExcel");

        $objPHPExcel = new \PHPExcel();
        $cellName = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','AA','AB','AC','AD','AE','AF','AG','AH','AI','AJ','AK','AL','AM','AN','AO','AP','AQ','AR','AS','AT','AU','AV','AW','AX','AY','AZ');

        $objPHPExcel->getActiveSheet(0)->mergeCells('A1:'.$cellName[$cellNum-1].'1');//合并单元格
		$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
        // $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1', $expTitle.'  Export time:'.date('Y-m-d H:i:s'));
        for($i=0;$i<$cellNum;$i++){
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue($cellName[$i].'2', $expCellName[$i][1]);
        }
        // Miscellaneous glyphs, UTF-8
        for($i=0;$i<$dataNum;$i++){
            for($j=0;$j<$cellNum;$j++){
                $objPHPExcel->getActiveSheet(0)->setCellValue($cellName[$j].($i+3), $expTableData[$i][$expCellName[$j][0]]);
            }
        }
        header('pragma:public');
        header('Content-type:application/vnd.ms-excel;charset=utf-8;name="'.$xlsTitle.'.xls"');
        header("Content-Disposition:attachment;filename=$fileName.xls");//attachment新窗口打印inline本窗口打印
        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save('php://output');
        exit;
    }
    /**
     *
     * 导出Excel
     */
    function expUser(){//导出Excel
		$id = I('get.id');
        $xlsName  = "User";
        $xlsCell  = array(
            array('user_nicename','校区'),
			array('master_name','校长'),
            array('user_login','手机'),
			array('num','参会人数'),
			array('comments','备注'),
            array('time','报名时间')
        );
        

        $xlsData  =   M('act_user as a')->join('cmf_users as b on a.userid = b.id')
                                    ->where(array('a.act_id'=>$id))
                                    ->field('b.user_nicename,b.user_login,a.time,a.num,a.comments,b.master_name')
                                    ->select();
        foreach ($xlsData as $k => $v)
        {
            $xlsData[$k]['time']=date("Y-m-d H:i:s", $v['time']);
        }

        $this->exportExcel($xlsName,$xlsCell,$xlsData);

    }
	
}

