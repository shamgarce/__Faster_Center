<?php
/**
 * Description of index
 * @author Administrator
 */
class login extends MpController {
    function __construct()
    {
        parent::__construct();
        $this->Seter = new \Seter\Seter();
    }

    public function doIndex() {
        echo $this->Seter->test;

        if(ISPOST){
            $this->model->formuser->load($this->Seter->request->post) && $this->model->formuser->login();
            $this->gojson();
        }else{
            $this->view("login/index",$data);
        }
    }


    public function doLogout()
    {
        Sham::R('/login.index');
    }


    //输出json
    public $isjson = false;
    public $jsoncode = 0;
    public $jsonmsg = '';
    public $jsondata = array();
    public function gojson(){
        $res = array(
            'code'	=> $this->jsoncode,
            'msg'	=> $this->jsonmsg,
            'data'	=> $this->jsondata
        );
        if($this->isjson){
            echo json_encode($res);
            exit;
        }
    }

}
