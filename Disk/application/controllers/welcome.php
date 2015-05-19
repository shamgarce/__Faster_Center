<?php
/**
 * Description of index
 * @author Administrator
 */
class Welcome extends MpController {

    public function doIndex($name = '') {

        $this->Seter = new \Seter\Seter();
//var_dump($this->Seter->set);
        echo $this->Seter->set->ver();




//        echo $this->Set->ver();
//        var_dump($this->Seter);



        exit;
        $this->helper('config');
        $this->view("welcome", array('msg' => $name, 'ver' => $this->config('myconfig', 'app')));
    }

}
