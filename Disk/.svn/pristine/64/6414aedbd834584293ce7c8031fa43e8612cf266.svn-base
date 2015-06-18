<?php
/*用户模型，在哪都能调用
先尝试写到Seter中
 * */
class Group extends MpModel
{
    public $args = array();
    public $res = array();

    public function __construct()
    {
        parent::__construct();
        $this->Seter = \Seter\Seter::getInstance();
    }


    public function update()
    {


        if($this->Isnotempty('groupname') && $this->Isnotempty('groupchr')){

            $this->args['groupname']  = \Sham::saddslashes($this->args['groupname']);
            $this->args['groupchr']  = \Sham::saddslashes($this->args['groupchr']);

            $this->args['groupid']  = intval($this->args['groupid']);
            $this->args['sort']     = intval($this->args['sort']);
            $this->args['enable']   = intval($this->args['enable']);

            $this->Seter->table->f_group->where("groupid = ".$this->args['groupid'])->update($this->args);
            $this->res = array(
                'code'=>200,
                'msg' => 'updarte ok',
            );
        }
        return $this;
    }

    public function add()
    {
        if($this->Isnotempty('groupname') && $this->Isnotempty('groupchr')){
            $this->args['groupname'] = \Sham::saddslashes($this->args['groupname']);
            $this->args['groupsort'] = intval($this->args['groupsort']);
            $this->Seter->table->f_group->insert($this->args);
            //添加数据
            $this->res = array(
                'code'=>200,
                'msg' => 'groupadd ok',
            );
        }
        return $this;
    }

    public function cflag()
    {
        $args['groupid'] = intval($this->args['groupid']);
        $args['enable'] = !empty($this->args['enable'])?0:1;
        $this->Seter->table->f_group->where("groupid = ".$args['groupid'])->update($args);

        //更改状态
        $this->res = array(
            'code'=>200,
            'msg' => 'groupcflag ok',
        );
        return $this;
    }

    public function delete()
    {

        $args['groupid'] = intval($this->args['groupid']);
        $this->Seter->table->f_group->where("groupid = ".$args['groupid'])->delete();
        //删除
        $this->res = array(
            'code'=>200,
            'msg' => 'delete ok',
        );
        return $this;
    }

    /*
     * 获取post过来的信息
     * */
    public function load($args)
    {
        $this->args = $args;
        return $this;
    }

    //添加信息
    public function getgrouplist()
    {
        return $this->Seter->table->f_group->order('sort desc')->getall();
    }
    public function getgrouprow($groupid)
    {
        return $this->Seter->table->f_group->where("groupid = $groupid")->getrow();
    }


    //是否空
    public function Isnotempty($key)
    {
        if(empty($this->args[$key])){
            $this->res['code'] = -200;
            $this->res['msg'] = "$key is empty";
            return false;
        }
        return true;
    }

    public function go()
    {
        echo json_encode($this->res);
        exit;
    }

}


