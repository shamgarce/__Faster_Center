<?php
/**
 * Description of index
 * @author Administrator
 */
class login extends MpController {

    public function doIndex() {
        Sham::R('/manage');
       // $this->helper('config');
        //$this->view("login", array('msg' => $name, 'ver' => $this->config('myconfig', 'app')));
    }
    public function doLogout()
    {
        Sham::R('/login.index');
    }
}
