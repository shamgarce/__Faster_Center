<?php
/**
 * Description of index
 * @author Administrator
 */
class welcome extends MpController {

    public function doIndex() {
//        $data=array(
//            'title'=>'测试登陆',
//            're' => '/u',           //登陆之后的地址
//        );
        $this->view("welcome",$data);
//        $a = exec("dir",$out,$status);
//        print_r($a);
//        print_r($out);
//        print_r($status);


//        exec("dir",$output);
//        print_r($output);

//        system("dir");

        $output = shell_exec('netstat -an');
        echo "<pre>$output</pre>";

        exit;


        $md = $this->accessRules();
print_r($md);
        echo 1;
//        print_r($this->router);
        exit;
        \Sham::R("/u/home.index");
    }







}
