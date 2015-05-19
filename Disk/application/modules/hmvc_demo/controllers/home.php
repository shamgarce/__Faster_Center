<?php

/**
 * Description of index
 *
 * @author Administrator
 */
class Home extends MpController {

    public function doIndex($name = '') {
        echo 1;

        $this->database('default');
        //$query = $this->db->query('SELECT * FROM dy_user');

        $query = $this->db->get('dy_user');
        foreach ($query->result() as $row)
        {
            //print_r($row);
           // echo $row->title;
        }

        var_dump($query);
        $this->view("welcome", array('msg' => $name, 'ver' => $this->config('myconfig', 'app')));
    }


}

