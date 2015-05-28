<?php
/*用户模型，在哪都能调用
先尝试写到Seter中
 * */
class Log extends MpModel
{
    private $res = array();
    private $sign = array();
    private $log = array();

    public function __construct()
    {
        parent::__construct();
        $this->Seter = \Seter\Seter::getInstance();
    }

    public function L($code='',$msg='')
    {
        $this->log['code'] = $code;        //code
        $this->log['msg'] = $msg;        //code
        $this->systeminfo();
        $this->signer();
        $this->save();
        return true;
    }


    public function save()
    {
        $this->Seter->mdb->selectDb("v1");
        $this->Seter->mdb->insert('dy_log',$this->log);
	}

    public function signer()
    {
        $this->sign['salt'] 		= SALT;				//
        $this->sign['timestamp']    = $this->Seter->request->get['timestamp'];
        $this->sign['deviceid']     = $this->Seter->request->get['deviceid'];
//        $this->sign['openid']       = $this->Seter->request->get['openid'];
        $this->sign['signature']    = $this->Seter->request->get['signature'];
        $this->sign['user']         = $this->Seter->request->get['user'];
        $this->sign['sign'] 		= false;

//        print_r($_SERVER);
        $opendid = md5($this->sign['user'].$this->sign['deviceid']);
        $signature = md5($opendid . $this->sign['timestamp'] . SALT);
        if($signature == $this->sign['signature'])$this->sign['sign'] 		= true;
        $this->log['sign'] = $this->sign;
        return true;
    }

    public function systeminfo()
    {
        $this->log['time']['timebe'] = BTIME;        //log
        $this->log['time']['timecu'] = time();        //log
        !empty($_GET) && $this->log['_GET']   = $_GET;            //log
        !empty($_POST) && $this->log['_POST'] = $_POST;        //log
        $this->log['router'] = WoniuRouter::parseURI();              //获得路由信息
        return true;
    }

}


