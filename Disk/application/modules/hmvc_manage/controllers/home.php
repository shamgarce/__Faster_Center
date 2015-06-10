<?php
use \Seter\Sham;
/**
 * Description of index
 *
 * @author Administrator
 */
class Home extends MpController {
    function __construct()
    {
        parent::__construct();
        $this->Seter = \Seter\Seter::getInstance();
        if (!$this->Seter->user->islogin()) \Sham::R('/login');
    }

    /*
     * 首页
     * */
    public function doIndex($name = '') {
//        mpath
        $data=array(
            'title'=>'仪表盘',
            'menu' => $this->menu()
        );
        $this->view("home/index",$data);
    }

    /*
     * 用户列表
     * */
    public function doUserlist($flit = '0') {
        if(ISPOST){
            $this->model->formuser->load($this->Seter->request->post)->cflag();
        }
        $data=array(
            'title'=>'用户列表',
            'menu' => $this->menu(),
            'userlist' => $this->model->user->getuserlist($flit),
        );
        $this->view("home/userlist",$data);
    }

    public function doGroup()
    {
        $data = array(
            'mt' => \Sham::T() - BTIME,
            'title' => '用户组管理',
            'menu'  => $this->menu(),
            'list'  => $this->model->group->getgrouplist(),
        );
        $this->view("home/group",$data);
    }

    /*
     * Dialog
     * 添加用户
     * */
    public function doUseradd() {

        if(ISPOST){
            $this->model->formuser->load($this->Seter->request->post)->add();
        }
        $data=array(
            'title'=>'添加用户'
        );
        $this->view("home/dialog/useradd",$data);
    }

    /*
     * Dialog
     * 修改用户
     * */
    public function doUseredit($uid = 0)
    {
        if(ISPOST){
            $this->model->formuser->load($this->Seter->request->post)->update();
//            $this->model->formuser->load() && $this->model->formuser->update();
            $this->gojson();
        }else{
            $data=array(
                'user' => $this->Seter->table->f_user->where("uid = $uid")->getrow(),
                'title'=>'修改用户'
            );
            $this->view("home/dialog/useredit",$data);
        }
    }










    /**
     * 建立左侧菜单
     * @return mixed
     *
     */
    public function menu()
    {
        $menu = array(
            'local' => $this->router['mpath'],
            'list'  => array(
                'home.index'    => '仪表盘',
                'home.userlist' => '用户管理',
                'home.group'    => '用户组管理',
            ),
        );

        return $menu;
    }

    /**
     */
    public function doDialog()
    {
        $this->model->user->test();
        $dialog = array();
        $dialog[] = array(
            'title' => '添加用户',
            'uri'   => '/manage/home.useradd',
        );
        $dialog[] = array(
            'title' => '编辑用户',
            'uri'   => '/manage/home.useredit',
        );


        $data['dialog'] = $dialog;
        $this->view("home/dialog",$data);
    }

}

