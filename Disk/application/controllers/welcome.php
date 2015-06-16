<?php
/**
 * Description of index
 * @author Administrator
 */
class welcome extends MpController {


    protected static function generateTemplateMarkup($title, $body)
    {
        return sprintf("
    <html>
    <head>
    <meta charset='utf-8'>
    <title>%s</title>
    <style>body{margin:0;padding:30px;font:12px/1.5 Helvetica,Arial,Verdana,sans-serif;}
    h1{margin:0;font-size:48px;font-weight:normal;line-height:48px;}
    strong{display:inline-block;width:65px;}</style></head>
    <body><h1>%s</h1>%s</body>
    </html>
", $title, $title, $body);
    }

    protected function defaultNotFound()
    {
        echo static::generateTemplateMarkup('404 Page Not Found', '<p>你似乎来到了一片未知的领域....</p>');
    }

    protected function defaultError()
    {
        echo self::generateTemplateMarkup('Error', '<p>貌似发生了一个错误！</p>');
    }

    public function doIndex() {
        echo 1;


        //
        static::defaultNotFound();

//        trigger404();

$md =         systemInfo();

print_r($md);

//        $route = $this->router;
//        print_r($route);

        echo 1;
        /*
         *
         *
         * 路由模式
         *
         * 1 ： 验证
         * */

























//        $data=array(
//            'title'=>'测试登陆',
//            're' => '/u',           //登陆之后的地址
//        );
//        $this->view("welcome",$data);
//        $a = exec("dir",$out,$status);
//        print_r($a);
//        print_r($out);
//        print_r($status);


//        exec("dir",$output);
//        print_r($output);

//        system("dir");

//        $output = shell_exec('netstat -an');
//        echo "<pre>$output</pre>";
//
//        exit;
//
//
//        $md = $this->accessRules();
//print_r($md);
//        echo 1;
//        print_r($this->router);
        exit;
//        \Sham::R("/u/home.index");
    }







}
