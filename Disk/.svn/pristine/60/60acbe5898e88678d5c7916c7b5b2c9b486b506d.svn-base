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
            'menu' => $this->menu(),
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
            'title'         =>'用户列表',
            'menu'          => $this->menu(),
            'userlist'      => $this->model->user->getuserlist($flit),
//            'grouplist'     => $this->model->Sysgroup->getgrouplist(1),     //enable = 1的数据
            'groupysid2name'=> $this->model->Sysgroup->groupysid2name(),

        );
        $this->view("home/userlist",$data);
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
                'title'=>'修改用户',
                'groupysid2name'=> $this->model->Sysgroup->groupysid2name(),
            );
            $this->view("home/dialog/useredit",$data);
        }
    }


    public function doGroupadd()
    {
        if(ISPOST){
            //添加
            $this->model->group->load($this->Seter->request->post)->add()->go();
        }
    }
    public function doGroupcflag()
    {
        if(ISPOST){
            //更改flag
            $this->model->group->load($this->Seter->request->post)->cflag()->go();
        }
    }
    public function doGroupdelete()
    {
        if(ISPOST){
            //删除数据
            $this->model->group->load($this->Seter->request->post)->delete()->go();
        }
    }

    //
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

    public function doGroupedit($groupid = 0)
    {

        if(ISPOST){
            $this->model->group->load($this->Seter->request->post)->update()->go();
        }
        $data = array(
            'mt' => \Sham::T() - BTIME,
            'title' => '修改用户组',
            'row'  => $this->model->group->getgrouprow($groupid),
        );
        //print_r($data);
        $this->view("home/dialog/groupedit",$data);
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

