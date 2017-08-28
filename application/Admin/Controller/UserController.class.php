<?php
namespace Admin\Controller;

use Common\Controller\AdminbaseController;

class UserController extends AdminbaseController{

	protected $users_model,$role_model;

	public function _initialize() {
		parent::_initialize();
		$this->users_model = D("Common/Users");
		$this->role_model = D("Common/Role");
	}

	// 管理员列表
	public function index(){
		$where = array("user_type"=>1);
		/**搜索条件**/
		$user_login = I('request.user_login');
		$user_nicename = trim(I('request.user_nicename'));
		if($user_login){
			$where['user_login'] = array('like',"%$user_login%");
		}
		
		if($user_nicename){
			$where['user_nicename'] = array('like',"%$user_nicename%");;
		}
		
		$count=$this->users_model->where($where)->count();
		$page = $this->page($count, 20);
        $users = $this->users_model->alias('a')->join('__ROLE_USER__ as b on a.id=b.user_id')
            ->where($where)
            ->order("create_time DESC")
            ->limit($page->firstRow, $page->listRows)
            ->select();
		$roles_src=$this->role_model->select();
		$roles=array();
		foreach ($roles_src as $r){
			$roleid=$r['id'];
			$roles["$roleid"]=$r;
		}
		$this->assign("page", $page->show('Admin'));
		$this->assign("roles",$roles);
		$this->assign("users",$users);
		$this->display();
	}
    // 校长列表
    public function index_xz(){
        $role_id = I("get.id");



        $where = array("user_type"=>1);
        /**搜索条件**/
        $user_login = I('request.user_login');
        $user_nicename = trim(I('request.user_nicename'));
        if($user_login){
            $where['user_login'] = array('like',"%$user_login%");
        }

        if($user_nicename){
            $where['user_nicename'] = array('like',"%$user_nicename%");;
        }

        $count=$this->users_model->where($where)->count();
        $page = $this->page($count, 20);
        $ids = D("role_user")->where(array("role_id"=>$role_id))->field("user_id")->select();
        $str = "";
        foreach ($ids as $key=>$value) {
            foreach($value as $k=>$v) {
                $str .= $v . ",";
            }
        }
        $str = rtrim($str, ",");
        $where['id'] = array('in', $str);
        $users = $this->users_model
            ->where($where)
            ->order("create_time DESC")
            ->limit($page->firstRow, $page->listRows)
            ->select();

        $userid= sp_get_current_admin_id();
        $current_user_role = M('role_user')->where(array('user_id'=>$userid))->field('role_id')->find();
        $str1='';
        if ($current_user_role['role_id'] == 5) {
            $yyjl_ids = M('users')->where(array('pid'=>$userid))->field('id')->select();
            foreach ($yyjl_ids as $k=>$v) {
                $str1 .= $v['id'] . ",";
            }
            $str1 = rtrim($str1, ",");
            $where['pid'] = array('in', "$str1");
            $count=$this->users_model->where($where)->count();
            $page = $this->page($count, 20);
            $users = M('users')->where($where)
                ->order("create_time DESC")
                ->limit($page->firstRow, $page->listRows)
                ->select();
        } elseif ($current_user_role['role_id'] == 3) {
            $where['pid'] = $userid;
            $count=$this->users_model->where($where)->count();
            $page = $this->page($count, 20);
            $users = M('users')->where($where)
                ->order("create_time DESC")
                ->limit($page->firstRow, $page->listRows)
                ->select();
        } else {
            //$count=$this->users_model->where($where)->count();
            $count = M('role_user')->where(array('role_id'=>$role_id ))->count();
            $page = $this->page($count, 20);
            $ids = D("role_user")->where(array("role_id"=>$role_id))->field("user_id")->select();
            $str = "";
            foreach ($ids as $key=>$value) {
                foreach($value as $k=>$v) {
                    $str .= $v . ",";
                }
            }
            $str = rtrim($str, ",");
            $where['id'] = array('in', $str);
            $users = $this->users_model
                ->where($where)
                ->order("create_time DESC")
                ->limit($page->firstRow, $page->listRows)
                ->select();
        }

        $this->assign("page", $page->show('Admin'));
        $this->assign("users",$users);
        $this->display();
    }
    //教管经理列表
    public function index_jg(){
        $role_id = I("get.id");
        $where = array("user_type"=>1);
        /**搜索条件**/
        $user_login = I('request.user_login');
        $user_nicename = trim(I('request.user_nicename'));
        if($user_login){
            $where['user_login'] = array('like',"%$user_login%");
        }

        if($user_nicename){
            $where['user_nicename'] = array('like',"%$user_nicename%");;
        }

        $userid= sp_get_current_admin_id();
        $current_user_role = M('role_user')->where(array('user_id'=>$userid))->field('role_id')->find();
        if ($current_user_role['role_id'] == 5) {
            $where['pid'] = $userid;
            $count=$this->users_model->where($where)->count();
            $page = $this->page($count, 20);
            $users = M('users')->where($where)
                ->order("create_time DESC")
                ->limit($page->firstRow, $page->listRows)
                ->select();
        } else {

            //$count=$this->users_model->where($where)->count();
            $count = M('role_user')->where(array('role_id'=>$role_id ))->count();
            $page = $this->page($count, 20);
            $ids = D("role_user")->where(array("role_id"=>$role_id))->field("user_id")->select();
            $str = "";
            foreach ($ids as $key=>$value) {
                foreach($value as $k=>$v) {
                    $str .= $v . ",";
                }
            }
            $str = rtrim($str, ",");
            $where['id'] = array('in', $str);
            $users = $this->users_model
                ->where($where)
                ->order("create_time DESC")
                ->limit($page->firstRow, $page->listRows)
                ->select();
            $roles_src=$this->role_model->select();
            $roles=array();
            foreach ($roles_src as $r){
                $roleid=$r['id'];
                $roles["$roleid"]=$r;
            }
        }
        $this->assign("page", $page->show('Admin'));
        $this->assign("roles",$roles);
        $this->assign("users",$users);
        $this->display();
    }
    //咨询经理列表
    public function index_zx(){
        $role_id = I("get.id");
        $where = array("user_type"=>1);
        /**搜索条件**/
        $user_login = I('request.user_login');
        $user_nicename = trim(I('request.user_nicename'));
        if($user_login){
            $where['user_login'] = array('like',"%$user_login%");
        }

        if($user_nicename){
            $where['user_nicename'] = array('like',"%$user_nicename%");;
        }

        $userid= sp_get_current_admin_id();
        $current_user_role = M('role_user')->where(array('user_id'=>$userid))->field('role_id')->find();
        if ($current_user_role['role_id'] == 5) {
            $where['pid'] = $userid;
            $count=$this->users_model->where($where)->count();
            $page = $this->page($count, 20);
            $users = M('users')->where($where)
                ->order("create_time DESC")
                ->limit($page->firstRow, $page->listRows)
                ->select();
        } else {

            //$count=$this->users_model->where($where)->count();
            $count = M('role_user')->where(array('role_id'=>$role_id ))->count();
            $page = $this->page($count, 20);
            $ids = D("role_user")->where(array("role_id"=>$role_id))->field("user_id")->select();
            $str = "";
            foreach ($ids as $key=>$value) {
                foreach($value as $k=>$v) {
                    $str .= $v . ",";
                }
            }
            $str = rtrim($str, ",");
            $where['id'] = array('in', $str);
            $users = $this->users_model
                ->where($where)
                ->order("create_time DESC")
                ->limit($page->firstRow, $page->listRows)
                ->select();
            $roles_src=$this->role_model->select();
            $roles=array();
            foreach ($roles_src as $r){
                $roleid=$r['id'];
                $roles["$roleid"]=$r;
            }
        }
        $this->assign("page", $page->show('Admin'));
        $this->assign("roles",$roles);
        $this->assign("users",$users);
        $this->display();
    }
    //市场经理列表
    public function index_sc(){
        $role_id = I("get.id");
        $where = array("user_type"=>1);
        /**搜索条件**/
        $user_login = I('request.user_login');
        $user_nicename = trim(I('request.user_nicename'));
        if($user_login){
            $where['user_login'] = array('like',"%$user_login%");
        }

        if($user_nicename){
            $where['user_nicename'] = array('like',"%$user_nicename%");;
        }

        $userid= sp_get_current_admin_id();
        $current_user_role = M('role_user')->where(array('user_id'=>$userid))->field('role_id')->find();
        if ($current_user_role['role_id'] == 5) {
            $where['pid'] = $userid;
            $count=$this->users_model->where($where)->count();
            $page = $this->page($count, 20);
            $users = M('users')->where($where)
                ->order("create_time DESC")
                ->limit($page->firstRow, $page->listRows)
                ->select();
        } else {

            //$count=$this->users_model->where($where)->count();
            $count = M('role_user')->where(array('role_id'=>$role_id ))->count();
            $page = $this->page($count, 20);
            $ids = D("role_user")->where(array("role_id"=>$role_id))->field("user_id")->select();
            $str = "";
            foreach ($ids as $key=>$value) {
                foreach($value as $k=>$v) {
                    $str .= $v . ",";
                }
            }
            $str = rtrim($str, ",");
            $where['id'] = array('in', $str);
            $users = $this->users_model
                ->where($where)
                ->order("create_time DESC")
                ->limit($page->firstRow, $page->listRows)
                ->select();
            $roles_src=$this->role_model->select();
            $roles=array();
            foreach ($roles_src as $r){
                $roleid=$r['id'];
                $roles["$roleid"]=$r;
            }
        }
        $this->assign("page", $page->show('Admin'));
        $this->assign("roles",$roles);
        $this->assign("users",$users);
        $this->display();
    }
    //高级经理列表
    public function index_gj(){
        $role_id = I("get.id");
        $where = array("user_type"=>1);
        /**搜索条件**/
        $user_login = I('request.user_login');
        $user_nicename = trim(I('request.user_nicename'));
        if($user_login){
            $where['user_login'] = array('like',"%$user_login%");
        }

        if($user_nicename){
            $where['user_nicename'] = array('like',"%$user_nicename%");;
        }

        $userid= sp_get_current_admin_id();
        $current_user_role = M('role_user')->where(array('user_id'=>$userid))->field('role_id')->find();
        if ($current_user_role['role_id'] == 5) {
            $where['pid'] = $userid;
            $count=$this->users_model->where($where)->count();
            $page = $this->page($count, 20);
            $users = M('users')->where($where)
                ->order("create_time DESC")
                ->limit($page->firstRow, $page->listRows)
                ->select();
        } else {

            //$count=$this->users_model->where($where)->count();
            $count = M('role_user')->where(array('role_id'=>$role_id ))->count();
            $page = $this->page($count, 20);
            $ids = D("role_user")->where(array("role_id"=>$role_id))->field("user_id")->select();
            $str = "";
            foreach ($ids as $key=>$value) {
                foreach($value as $k=>$v) {
                    $str .= $v . ",";
                }
            }
            $str = rtrim($str, ",");
            $where['id'] = array('in', $str);
            $users = $this->users_model
                ->where($where)
                ->order("create_time DESC")
                ->limit($page->firstRow, $page->listRows)
                ->select();
            $roles_src=$this->role_model->select();
            $roles=array();
            foreach ($roles_src as $r){
                $roleid=$r['id'];
                $roles["$roleid"]=$r;
            }
        }
        $this->assign("page", $page->show('Admin'));
        $this->assign("roles",$roles);
        $this->assign("users",$users);
        $this->display();
    }
    //区域经理列表
    public function index_qy(){
        $role_id = I("get.id");
        $where = array("user_type"=>1);
        /**搜索条件**/
        $user_login = I('request.user_login');
        $user_nicename = trim(I('request.user_nicename'));
        if($user_login){
            $where['user_login'] = array('like',"%$user_login%");
        }

        if($user_nicename){
            $where['user_nicename'] = array('like',"%$user_nicename%");;
        }

        $userid= sp_get_current_admin_id();
        $current_user_role = M('role_user')->where(array('user_id'=>$userid))->field('role_id')->find();
        if ($current_user_role['role_id'] == 5) {
            $where['pid'] = $userid;
            $count=$this->users_model->where($where)->count();
            $page = $this->page($count, 20);
            $users = M('users')->where($where)
                ->order("create_time DESC")
                ->limit($page->firstRow, $page->listRows)
                ->select();
        } else {

            //$count=$this->users_model->where($where)->count();
            $count = M('role_user')->where(array('role_id'=>$role_id ))->count();
            $page = $this->page($count, 20);
            $ids = D("role_user")->where(array("role_id"=>$role_id))->field("user_id")->select();
            $str = "";
            foreach ($ids as $key=>$value) {
                foreach($value as $k=>$v) {
                    $str .= $v . ",";
                }
            }
            $str = rtrim($str, ",");
            $where['id'] = array('in', $str);
            $users = $this->users_model
                ->where($where)
                ->order("create_time DESC")
                ->limit($page->firstRow, $page->listRows)
                ->select();
            $roles_src=$this->role_model->select();
            $roles=array();
            foreach ($roles_src as $r){
                $roleid=$r['id'];
                $roles["$roleid"]=$r;
            }
        }
        $this->assign("page", $page->show('Admin'));
        $this->assign("roles",$roles);
        $this->assign("users",$users);
        $this->display();
    }
	// 管理员添加
	public function add(){
		$roles=$this->role_model->where(array('status' => 1))->order("id DESC")->select();
		$this->assign("roles",$roles);
		$this->display();
	}
    // 教管经理添加
    public function add_jg(){
        $roles=$this->role_model->where(array('status' => 1))->order("id DESC")->select();
        //区域经理
        $qyjls = $this->get_qyjl();
        $this->assign('qyjls', $qyjls);
        $this->assign("roles",$roles);
        $this->display();
    }
    // 咨询经理添加
    public function add_zx(){
        $roles=$this->role_model->where(array('status' => 1))->order("id DESC")->select();
        //区域经理
        $qyjls = $this->get_qyjl();
        $this->assign('qyjls', $qyjls);
        $this->assign("roles",$roles);
        $this->display();
    }
    // 市场经理添加
    public function add_sc(){
        $roles=$this->role_model->where(array('status' => 1))->order("id DESC")->select();
        //区域经理
        $qyjls = $this->get_qyjl();
        $this->assign('qyjls', $qyjls);
        $this->assign("roles",$roles);
        $this->display();
    }
    // 高级经理添加
    public function add_gj(){
        $roles=$this->role_model->where(array('status' => 1))->order("id DESC")->select();
        //区域经理
        $qyjls = $this->get_qyjl();
        $this->assign('qyjls', $qyjls);
        $this->assign("roles",$roles);
        $this->display();
    }
    // 区域经理添加
    public function add_qy(){
        $roles=$this->role_model->where(array('status' => 1))->order("id DESC")->select();
        $this->assign("roles",$roles);
        $this->display();
    }
    // 校区校长添加
    public function add_xz(){
        //高级运营经理列表
        $gj = $this->get_gjjl();
        //学管经理列表
        $jg = $this->get_jgjl();
        //咨询经理列表
        $zx = $this->get_zxjl();
        //市场经理列表
        $sc = $this->get_scjl();

        $this->assign('gjjls', $gj);
        $this->assign('jgjls', $jg);
        $this->assign('zxjls', $zx);
        $this->assign('scjls', $sc);
        //角色列表
        $roles=$this->role_model->where(array('status' => 1))->order("id DESC")->select();
        $this->assign("roles",$roles);
        $this->display();
    }

	// 管理员添加提交
	public function add_post(){
		if(IS_POST){
			if(!empty($_POST['role_id']) && is_array($_POST['role_id'])){
				$role_ids=$_POST['role_id'];
				unset($_POST['role_id']);
				if ($this->users_model->create()!==false) {
					$result=$this->users_model->add();
					if ($result!==false) {
						$role_user_model=M("RoleUser");
						foreach ($role_ids as $role_id){
							if(sp_get_current_admin_id() != 1 && $role_id == 1){
								$this->error("为了网站的安全，非网站创建者不可创建超级管理员！");
							}
							$role_user_model->add(array("role_id"=>$role_id,"user_id"=>$result));
						}
						$this->success("添加成功！", U("user/index"));
					} else {
						$this->error("添加失败！");
					}
				} else {
					$this->error($this->users_model->getError());
				}
			}else{
				$this->error("请为此用户指定角色！");
			}

		}
	}

	// 管理员编辑
	public function edit(){
	    $id = I('get.id',0,'intval');
		$roles=$this->role_model->where(array('status' => 1))->order("id DESC")->select();
		$this->assign("roles",$roles);
		$role_user_model=M("RoleUser");
		$role_ids=$role_user_model->where(array("user_id"=>$id))->getField("role_id",true);
		$this->assign("role_ids",$role_ids);

		$user=$this->users_model->where(array("id"=>$id))->find();
		$this->assign($user);
		$this->display();
	}
    // 教管经理编辑
    public function edit_jg(){
        $id = I('get.id',0,'intval');
        $roles=$this->role_model->where(array('status' => 1))->order("id DESC")->select();
        $this->assign("roles",$roles);
        $role_user_model=M("RoleUser");
        $role_ids=$role_user_model->where(array("user_id"=>$id))->getField("role_id",true);
        $this->assign("role_ids",$role_ids);
        //区域经理
        $qyjls = $this->get_qyjl();
        $this->assign('qyjls', $qyjls);

        $user=$this->users_model->where(array("id"=>$id))->find();
        $this->assign($user);
        $this->display();
    }
    // 咨询经理编辑
    public function edit_zx(){
        $id = I('get.id',0,'intval');
        $roles=$this->role_model->where(array('status' => 1))->order("id DESC")->select();
        $this->assign("roles",$roles);
        $role_user_model=M("RoleUser");
        $role_ids=$role_user_model->where(array("user_id"=>$id))->getField("role_id",true);
        $this->assign("role_ids",$role_ids);
        //区域经理
        $qyjls = $this->get_qyjl();
        $this->assign('qyjls', $qyjls);

        $user=$this->users_model->where(array("id"=>$id))->find();
        $this->assign($user);
        $this->display();
    }
    // 市场经理编辑
    public function edit_sc(){
        $id = I('get.id',0,'intval');
        $roles=$this->role_model->where(array('status' => 1))->order("id DESC")->select();
        $this->assign("roles",$roles);
        $role_user_model=M("RoleUser");
        $role_ids=$role_user_model->where(array("user_id"=>$id))->getField("role_id",true);
        $this->assign("role_ids",$role_ids);
        //区域经理
        $qyjls = $this->get_qyjl();
        $this->assign('qyjls', $qyjls);

        $user=$this->users_model->where(array("id"=>$id))->find();
        $this->assign($user);
        $this->display();
    }
    // 高级经理编辑
    public function edit_gj(){
        $id = I('get.id',0,'intval');
        $roles=$this->role_model->where(array('status' => 1))->order("id DESC")->select();
        $this->assign("roles",$roles);
        $role_user_model=M("RoleUser");
        $role_ids=$role_user_model->where(array("user_id"=>$id))->getField("role_id",true);
        $this->assign("role_ids",$role_ids);
        //区域经理
        $qyjls = $this->get_qyjl();
        $this->assign('qyjls', $qyjls);

        $user=$this->users_model->where(array("id"=>$id))->find();
        $this->assign($user);
        $this->display();
    }
    // 区域经理编辑
    public function edit_qy(){
        $id = I('get.id',0,'intval');
        $roles=$this->role_model->where(array('status' => 1))->order("id DESC")->select();
        $this->assign("roles",$roles);
        $role_user_model=M("RoleUser");
        $role_ids=$role_user_model->where(array("user_id"=>$id))->getField("role_id",true);
        $this->assign("role_ids",$role_ids);

        $user=$this->users_model->where(array("id"=>$id))->find();
        $this->assign($user);
        $this->display();
    }
    // 校区编辑
    public function edit_xz(){
        $id = I('get.id',0,'intval');
        $roles=$this->role_model->where(array('status' => 1))->order("id DESC")->select();
        $this->assign("roles",$roles);
        $role_user_model=M("RoleUser");
        $role_ids=$role_user_model->where(array("user_id"=>$id))->getField("role_id",true);
        $this->assign("role_ids",$role_ids);

        //高级运营经理列表
        $gj = $this->get_gjjl();
        //学管经理列表
        $jg = $this->get_jgjl();
        //咨询经理列表
        $zx = $this->get_zxjl();
        //市场经理列表
        $sc = $this->get_scjl();

        $this->assign('gjjls', $gj);
        $this->assign('jgjls', $jg);
        $this->assign('zxjls', $zx);
        $this->assign('scjls', $sc);

        $user=$this->users_model->where(array("id"=>$id))->find();
        $this->assign($user);
        $this->display();
    }

	// 管理员编辑提交
	public function edit_post(){
		if (IS_POST) {
			if(!empty($_POST['role_id']) && is_array($_POST['role_id'])){
				if(empty($_POST['user_pass'])){
					unset($_POST['user_pass']);
				}
				$role_ids = I('post.role_id/a');
				unset($_POST['role_id']);
				if ($this->users_model->create()!==false) {
					$result=$this->users_model->save();
					if ($result!==false) {
						$uid = I('post.id',0,'intval');
						$role_user_model=M("RoleUser");
						$role_user_model->where(array("user_id"=>$uid))->delete();
						foreach ($role_ids as $role_id){
							if(sp_get_current_admin_id() != 1 && $role_id == 1){
								$this->error("为了网站的安全，非网站创建者不可创建超级管理员！");
							}
							$role_user_model->add(array("role_id"=>$role_id,"user_id"=>$uid));
						}
						$this->success("保存成功！");
					} else {
						$this->error("保存失败！");
					}
				} else {
					$this->error($this->users_model->getError());
				}
			}else{
				$this->error("请为此用户指定角色！");
			}

		}
	}

	// 管理员删除
	public function delete(){
	    $id = I('get.id',0,'intval');
		if($id==1){
			$this->error("最高管理员不能删除！");
		}

		if ($this->users_model->delete($id)!==false) {
			M("RoleUser")->where(array("user_id"=>$id))->delete();
			$this->success("删除成功！");
		} else {
			$this->error("删除失败！");
		}
	}

	// 管理员个人信息修改
	public function userinfo(){
		$id=sp_get_current_admin_id();
		$user=$this->users_model->where(array("id"=>$id))->find();
		$this->assign($user);
		$this->display();
	}

	// 管理员个人信息修改提交
	public function userinfo_post(){
		if (IS_POST) {
			$_POST['id']=sp_get_current_admin_id();
			$create_result=$this->users_model
			->field("id,user_nicename,sex,birthday,user_url,signature")
			->create();
			if ($create_result!==false) {
				if ($this->users_model->save()!==false) {
					$this->success("保存成功！");
				} else {
					$this->error("保存失败！");
				}
			} else {
				$this->error($this->users_model->getError());
			}
		}
	}

	// 停用管理员
    public function ban(){
        $id = I('get.id',0,'intval');
    	if (!empty($id)) {
    		$result = $this->users_model->where(array("id"=>$id,"user_type"=>1))->setField('user_status','0');
    		if ($result!==false) {
    			$this->success("管理员停用成功！", U("user/index"));
    		} else {
    			$this->error('管理员停用失败！');
    		}
    	} else {
    		$this->error('数据传入失败！');
    	}
    }

    // 启用管理员
    public function cancelban(){
    	$id = I('get.id',0,'intval');
    	if (!empty($id)) {
    		$result = $this->users_model->where(array("id"=>$id,"user_type"=>1))->setField('user_status','1');
    		if ($result!==false) {
    			$this->success("管理员启用成功！", U("user/index"));
    		} else {
    			$this->error('管理员启用失败！');
    		}
    	} else {
    		$this->error('数据传入失败！');
    	}
    }
    
    //获取区域经理
    public function get_qyjl(){
        $qyjls = M('role_user as a')->join('cmf_users as b on a.user_id = b.id')
            ->field("a.user_id,b.user_nicename")
            ->where(array('role_id'=>5))
            ->select();
        return $qyjls;
    }
    //获取高级经理
    public function get_gjjl(){
        $yyjls = M('role_user as a')->join('cmf_users as b on a.user_id = b.id')
            ->field("a.user_id,b.user_nicename")
            ->where(array('role_id'=>6))
            ->select();
        return $yyjls;
    }
    //获取教管经理
    public function get_jgjl(){
        $yyjls = M('role_user as a')->join('cmf_users as b on a.user_id = b.id')
            ->field("a.user_id,b.user_nicename")
            ->where(array('role_id'=>3))
            ->select();
        return $yyjls;
    }
    //获取咨询经理
    public function get_zxjl(){
        $yyjls = M('role_user as a')->join('cmf_users as b on a.user_id = b.id')
            ->field("a.user_id,b.user_nicename")
            ->where(array('role_id'=>8))
            ->select();
        return $yyjls;
    }
    //获取市场经理
    public function get_scjl(){
        $yyjls = M('role_user as a')->join('cmf_users as b on a.user_id = b.id')
            ->field("a.user_id,b.user_nicename")
            ->where(array('role_id'=>7))
            ->select();
        return $yyjls;
    }

     /**
    *9	管理资料
    *8	咨询经理
    *7	市场经理
    *6	高级运营经理
    *5	区域经理
    *4	校长
    *3	教管经理
    *2	总部
    *1	超级管理员
    */
    public function framework(){
        $arr[] = [];
        $data = M('users')->alias('a')->join('__ROLE_USER__ as b on a.id=b.user_id')->field('a.id,a.user_nicename,a.pid_gj,a.pid_jg,a.pid_zx,a.pid_sc,b.role_id')->select();
        foreach ($data as $k=>$v){
            if($v['role_id'] == 2) {
                $root[] = $v;
            }
            if ($v['role_id'] == 5) {
                $qy[] = $v;
            }
            if (in_array($v['role_id'],array(3,6,7,8))){
                $jl[] = $v;
            }
            if ($v['role_id'] == 4) {
                $xz[] = $v;
            }
        }
        foreach($qy as $m=>$n){
            foreach ($jl as $mm=>$nn){
                if ($nn['pid_gj'] == $n['id']){
                    $arr[$n['id']][] = $nn;
                }
            }
        }

        foreach ($arr as $kk=>$vv){
            foreach($vv as $kkk=>$vvv) {
                foreach ($xz as $kkkk => $vvvv) {
                    if ($vvvv['pid_gj'] == $vvv['id']) {
                        $arr[$kk][$kkk]['son'][] = $vvvv;

                    }
                    if ($vvvv['pid_jg'] == $vvv['id']) {
                        $arr[$kk][$kkk]['son'][] = $vvvv;

                    }
                    if ($vvvv['pid_zx'] == $vvv['id']) {
                        $arr[$kk][$kkk]['son'][] = $vvvv;

                    }
                    if ($vvvv['pid_sc'] == $vvv['id']) {
                        $arr[$kk][$kkk]['son'][] = $vvvv;

                    }

                }
            }
        }
        foreach ($arr as $k=>$v){
            if ($k == 0){
                unset($arr[$k]);
            }
        }
        $this->assign('arr',$arr);
        $this->display();
    }


}