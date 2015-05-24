<?php
/**
 * Description of index
 * @author Administrator
 */
class welcome extends MpController {

    public function doIndex() {
        //welcome
        $this->Seter = \Seter\Seter::getInstance();
        echo 'welcome';
    }
}
